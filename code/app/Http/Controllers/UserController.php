<?php

namespace App\Http\Controllers ;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Notifications\Invitation;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index()
    {
        $users  = User::search()->ordered()->paginate(10);

        return view('pages.user.index', compact('users'));


    }


    public function show(User $user)
    {

        return view('pages.user.show', compact('user'));
    }


    public function destroy(User $user)
    {
        if(auth()->user() === $user) {
            flash()->overlay("You can't delete yourself.");

            return back();

        }

        $user->delete();
        flash()->overlay('User deleted successfully.');

        return redirect( )->route('user.index');

    }


    public function create( )
    {

        return view('pages.user.create'   );

    }
    public function edit( User $user)
    {

        return view('pages.user.edit', compact('user')   );

    }


    public function store( StoreUserRequest $request )
    {


        $user=User::create(
            [
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
                'password'=>$request->password,


            ]

        );



        return view('pages.user.show',compact('user'));


    }
    public function sendInvitation(User $user){

        if (env('MAIL_SEND') ) {

            $user->notify(new Invitation($user));
        }
    }

    public function findRole(User $user){

        $id=$user->id;

        $isadmin=DB::table('group_user')->where(['user_id'=>$id,'is_admin'=>true])->exists();

        return $isadmin===true?'admin':'user';



    }

    public function update(UpdateUserRequest $request,User $user){





        if($request->has('role')){
            $role='super';
        }
        else{
            $role=$this->findRole($user);
        }

       $user->update(
            [
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
                'role'=>$role,


            ]

        );

        flash()->overlay("Profile updated successfully." );

        return redirect( )->route('user.show',$user);


    }




    public function search (Request $request)
    {


        $users  = User::search()->ordered()->paginate(10);

        $users->withPath('users');

            return response()->json([
                'data'=>view('panels.view.index-user', compact('users'))->render(),

            ]);


    }






}
