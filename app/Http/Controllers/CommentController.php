<?php

namespace App\Http\Controllers  ;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\View;

class  CommentController extends Controller
{



    public function destroy(Comment $comment)
    {

        $comment->delete();
        flash()->overlay('Comment deleted successfully.');
        return back();
    }

    public function update(Request $request,Comment $comment)
    {

        $comment->update([
            'body' => $request->body,
        ]);

        return back();

    }


    public function store( Request $request,Post $post)
    {


        $comment=Comment::create([
            'body' => $request->body,
            'post_id'=>$post->id
        ]);



        if($request->ajax()){


            return response()->json([
                'data'=>view('panels.view.show-comment', compact('comment'))
                    ->render(),

            ]);

        }else{

            return redirect( url()->previous());

        }



    }





}
