<?php

namespace App\Http\Controllers ;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Jobs\SendNewPostEmail;
use App\Models\File;
use App\Models\Group;
use App\Models\Poll;
use App\Models\Post;
use App\Notifications\NewPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Facades\Utilities as Util;
use Illuminate\Support\Facades\Notification;

use Carbon\Carbon;

class PostController extends Controller
{


    public function index()
    {


        if(auth()->user()->isSuper()  ) {

            $posts=Post::search()->ordered()->paginate(10);


        }else{

            $posts=Post::author()->search()->ordered()->paginate(10);

        }


        return view('pages.post.index', compact('posts'));






    }
    private function createPoll(PostRequest $request,Post $post){

        //create a poll from request.poll
        //TODO it make sure it allways has pollitem if votetype=poll

        if($request->has('pollitem')){
            $poll=Poll::create([
                'items'=>$request->pollitem,
                'post_id'=>$post->id
            ]);


        }

        //TODO this means poll with no items selected >> throw warning
        else{


        }



    }
    public function store(PostRequest $request,Group $group )
    {


        $gdatetime=Util::toGregorianDateTime($request->datetime);

        $post=Post::create([
            'title'       => $request->title,
            'body'        => $request->body,
            'vote_type' => $request->vote_type,
            'expires_at'=>$gdatetime ,
            'group_id'=>$group->id,

        ]);
        if($request->vote_type==='poll'){
           $this->createPoll($request,$post);

        }
        if($request->has('fileid')){

            File::whereIn('id', $request->fileid)
                ->update(['post_id' => $post->id]);
        }


        $group->posts()->save($post);
//        return response()->json(env('MAIL_SEND'));
//         $this->sendNewPostEmail($post);


        flash()->overlay('Post created successfully.'   );

        return redirect( )->route('post.show',$post);



    }

    public function sendNewPostEmail(Post $post){


        if (env('MAIL_SEND')==='true' ){
            $this->dispatch( new SendNewPostEmail($post)    ) ;

        }

    }
    public function edit(Post $post){


        return view('pages.post.edit',compact('post'));

    }
    public function show(Post $post)
    {

        $post = $post->load(['user','group' ]);




        $comments = $post->comments() ->ordered()->paginate(10);
        if($post->vote_type==='poll'){
            $poll=$post->poll();
            return view('pages.post.show', compact('post'))
                ->with('comments', $comments)
                ->with('poll', $poll);
        }
        else{

            return view('pages.post.show', compact('post'))
                ->with('comments', $comments);


        }


    }
    public function create(Group $group){

        return view('pages.post.create',compact('group'));


    }

    public function update(PostRequest $request, Post $post)
    {

        if($post->vote_type!==$request->vote_type   ){

            $post->votes()->delete();
        }

        if($request->vote_type==='poll' && $request->pollitem!==$post->poll()){

            $id= DB::table("polls")->where('post_id','=',$post->id)->pluck('id')->first();
            DB::table('polls')->delete($id);
            $post->votes()->delete();


            $this->createPoll($request,$post);




        }
        $gdatetime=Util::toGregorianDateTime($request->datetime);


        $post->update([
            'title'       => $request->title,
            'body'        => $request->body,
            'vote_type' => $request->vote_type,
            'expires_at'=>$gdatetime ,

        ]);

        flash()->overlay('Post updated successfully. ');
        return redirect( )->route('post.show',$post);


    }


    public function destroy(Post $post)
    {

        $post->delete();
        flash()->overlay('Post deleted successfully.');

        return back();

    }

    public function voters(Post $post){

        $results=DB::table('votes')
            ->where('post_id','=',$post->id)
            ->join('users','users.id','=','votes.user_id')
            ->select('users.id','users.first_name','users.last_name','votes.*')
            ->orderBy('updated_at','DESC')
            ->paginate(10);





        return view('pages.post.voters',compact('results'))
            ->with('post',$post);

    }

    public function search(Request $request){


        if(auth()->user()->isSuper()  ) {

            $posts=Post::search()->ordered()->paginate(10);


        }else{

            $posts=Post::author()->search()->ordered()->paginate(10);

        }


        $posts->withPath('posts');


        return response()->json([
            'data'=>view('panels.view.index-post', compact('posts'))->render()

        ]);



    }





}
