<?php

namespace App\Http\Controllers ;
use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Group;

use App\Models\Post;
use App\Notifications\NewPost;
use App\User;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class GroupController extends Controller
{

    const ADMIN=1;
    const MEMBER=0;
    public function index(  ){



        if(auth()->user()->isSuper()  ){

            $groups = Group::search()->ordered()  ->paginate(10);


        }
        else{
            $groups=auth()->user()->groups()->search()->ordered()->paginate(10);

        }



        return view('pages.group.index',compact('groups')  );

    }

    public function details(Group $group)
    {

        $request=request() ;



        $members=$group->users()
             ->where(  'first_name', 'like',  $request->input('first') ."%")
             ->Where(  'last_name', 'like',  $request->input('last') ."%")
             ->orderBy('last_name','ASC')
             ->orderBy('first_name','ASC')
            ->paginate(20);




        return view('pages.group.details',compact('group') )
            ->with( 'members',$members );




    }



    public function feed( Group $group ){
        $posts  = $group->posts()
            ->active()
            ->search()
            ->ordered()
            ->paginate(10);
        return view('pages.group.feed',['group'=>$group,'posts'=>$posts]  );

    }


    public function create()
    {
            return view('pages.group.create'   );

    }


    public function store(GroupRequest $request)
    {

            $group = Group::create([
                'name'       => $request->name,
                'description'       => $request->description,

            ]);

            DB::table('group_user')
                ->insert(['user_id' => auth()->user()->id , 'group_id' => $group->id,'is_admin' => true]);


            flash()->overlay('Group created successfully.' );

            return redirect( )->route('group.feed',['group'=>$group->id]);


    }



    public function edit(Group $group)
    {

        $request=request() ;

        $users=DB::table('users')
            ->where(  'users.first_name', 'like',  $request->input('first') ."%")
            ->where(  'users.last_name', 'like',  $request->input('last') ."%")
            ->leftJoin('group_user', function ($join)  use($group){
                $join->on('users.id', '=', 'group_user.user_id')
                    ->where('group_user.group_id', '=', $group->id);
            })
            ->select('users.first_name','users.last_name','users.email','users.id','group_user.is_admin')
            ->orderBy('users.last_name','ASC')
            ->orderBy('users.first_name','ASC')
            ->paginate(20);



        $oldstatus=[];

        if( Session::has('oldstatus')){
            $oldstatus=Session::get('oldstatus');
        }
        $status=[];

        if( Session::has('status')){
            $status=Session::get('status');
        }


        foreach ($users as $user){
            $isadmin=$user->is_admin;
            if(!array_key_exists($user->id,$status)){
                $status[$user->id]=$isadmin;
            }
            $oldstatus[$user->id]=$isadmin;

        }

        Session::put('status',$status);
        Session::put('oldstatus',$oldstatus);


        if($request->has('status')) {
            $reqstat=$request->get('status');

            $status=Session::get('status');

            foreach ($reqstat as $r =>$stat){


                $status[$r]=is_null($stat)?null:intval($stat);
            }
            Session::put('status',$status);




        }

        if($request->ajax()){

               return response()->json('');


        }
        return view('pages.group.edit',compact('group') )
            ->with( 'users',$users );






    }


    public function updateRole($id,$prev,$cur){

        //upgrade to admin
        if( $cur ==self::ADMIN ){

//            if(User::where('id','=',$id)->role==='user') {
                DB::table('users')->where('id', '=', $id)->update(['role' => 'admin']);

//            }

        }

        //downgrade to user if neccessary
        if( $prev ==self::ADMIN){
            $isadmin=DB::table('group_user')->where(['user_id'=>$id,'is_admin'=>true])->exists();
            if($isadmin===false){
                DB::table('users')->where('id','=',$id)->update(['role'=>'user']);



            }




        }

    }

    public function updateMember(Request $request,Group $group){


        $status=Session::get('status');
        $oldstatus=Session::get('oldstatus');

        $added=[];
        $removed=[];
        $updated=[];
        $nowmember=[];
        $nowadmin=[];


        foreach ($oldstatus as $id =>$prev) {
            $cur=is_null($status[$id])?null:intval($status[$id]);
            $prev=is_null($prev)?null:intval($prev);


            if ($prev !== $cur) {


                if (is_null($cur) ) {
                    //delete from group
                    $removed[] = $id;


                } else if (is_null($prev) ) {
                    //insert into group
                    DB::table('group_user')->insertOrIgnore(['group_id' => $group->id, 'user_id' => $id, 'is_admin' => $cur]);
                    $added[] = $id;


                } else {
                    //update status
                    DB::table('group_user')->where(['group_id' => $group->id, 'user_id' => $id])
                        ->update(['is_admin' => $cur]);



                    $updated[] = $id;

                    switch ($cur){

                        case (self::ADMIN):{
                            $nowadmin[]=$id;
                        }
                        case(self::MEMBER):{
                            $nowmember[]=$id;

                        }

                    }
                }

                $this->updateRole($id, $prev, $cur);//cur is 0 or 1 >> change role if necessary

            }


        }


        $group->users()->detach($removed);
        $group->save();


        Session::forget(['status','oldstatus']);


        flash()->overlay('Group updated successfully.' );

        return redirect( )->route('group.detail',$group);


    }
    public function updateGroup( GroupRequest $request,Group $group)
    {

        if($request->has('name') ||$request->has('description')){

            $group->update(
                [
                    'name'=>$request->name,
                 'description'=>$request->description
                ]

            );
            flash()->overlay('Group updated successfully.' );

            return redirect( )->route('group.detail',$group);

        }




    }
    public function destroy(Group $group)
    {


        $group->delete();
        flash()->overlay('Group deleted successfully.');


        return back();


    }



    public function archive(Group $group){

        $posts= $group->posts()->archive()->search()->ordered()->paginate(10);



        return view('pages.group.archive',compact('group') )
            ->with('posts',$posts);



    }


    public function searchfeedpost(Request $request,Group $group)
    {
        $search=$request->search;



        $posts  = $group->posts()
            ->active()
           ->search()
            ->ordered()
            ->paginate(10);

        $posts->withPath('');

        return response()->json([
            'data'=>view('panels.view.show-posts', compact('posts'))->render()

        ]);

    }
    public function searcharchivepost(Request $request,Group $group)
    {

        $search=$request->search;

        $posts  = $group->posts()
            ->archive()
           ->search()
            ->ordered()
            ->paginate(10);


        $posts->withPath('archive');

        return response()->json([
            'data'=>view('panels.view.show-posts', compact('posts'))->render()

        ]);

    }

    public function search(Request $request )
    {

        if(auth()->user()->isSuper()  ) {
            $groups = Group::search()->ordered()    ->paginate(10);


        }else{

            $groups=auth()->user()->groups()->search()->ordered()  ->paginate(10);


        }

        $groups->withPath('groups');
        return response()->json([
            'data' => view('panels.view.index-group', compact('groups'))->render()

        ]);
    }




}
