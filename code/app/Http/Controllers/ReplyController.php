<?php

namespace App\Http\Controllers  ;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Reply;
use App\Notifications\UserReplied;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\View;

class  ReplyController extends Controller
{


    public function destroy(Reply $reply)
    {

        $reply->delete();
        flash()->overlay('Comment deleted successfully.');

        return back();
    }

    public function update(Request $request,Reply $reply)
    {

        $reply->update([
            'body' => $request->body,
        ]);
        $reply->save();


        return back();

    }

    public function store( Request $request,Comment $comment)
    {


        $replies=[];

        $data= json_decode($request->data);

        $reply=Reply::create([
            'body' => $request->body,
            'user_id'=>auth()->user()->id,
            'replyable_id'=>$data->reply_id,
            'replyable_type'=>$data->reply_type,
            'comment_id'=>$comment->id,


        ]);

        $replies[]=$reply;



        if($request->ajax()){


            return response()->json([

                'replybutton'=>View::make('partials.reply-btn',compact('reply'))
                ->with('replyable_id',$data->reply_id)
                ->with('replyable_type',$data->reply_type)
                ->with('comment_id',$comment->id)
                    ->with('replyable_user',$data->reply_user)
                ->render(),


            ]);

        }

        else{
            flash()->overlay('Comment successfully created' );
            return redirect( url()->previous());

        }



    }

    public function show(Request $request,Comment $comment){

        $count=10;
        $offset=$request->offset;


        $replies= $comment->replies()->skip($offset)->take($count)->get();


        return response()->json([
            'data'=>View::make('panels.view.show-replies', compact('replies'))
                ->with('comment',$comment->id)
                ->render()
            ,

            'count'=>count($replies)

        ]);

    }





}
