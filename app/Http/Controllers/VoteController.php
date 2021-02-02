<?php

namespace App\Http\Controllers  ;

use App\Models\Post;
use App\Models\Vote;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\View;

class VoteController extends Controller
{



    public function destroy(Vote $vote)
    {

        $vote->delete();
        flash()->overlay('Vote deleted successfully.');

        return back();
    }

    public function update(Request $request,Vote $vote)
    {
        $vote->update([
            'body' => $request->body,
            'value'=>$request->opinion

        ]);
        $vote->save();


        return back();


    }


    public function store( Request $request,Post $post)
    {



        if($post->hasExpired()===true){
            flash()->overlay('Post has expired.' );

        }
        try {

            $vote=Vote::create([
                'body' => $request->body,
                'value' => $request->opinion,
                'post_id'=>$post->id,
                'type'=>$post->vote_type
            ]);
            $vote->save();

        }
    catch ( QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == 1062){

            flash()->overlay('Duplicate vote' );

        }
        else{

            flash()->overlay('Vote created successfully.' );

        }
    }


        if($request->ajax()) {


            return response()->json([
                'data' => view('panels.view.show-vote', compact('vote'))
                    ->render()
            ]);

        }

        return redirect( url()->previous());


    }
}
