<?php

namespace App\Http\Controllers  ;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\View;

class  ViewController extends Controller
{

    public function view(Request $request){



        return response()->json([
            'data'=>View::make($request->view,$request->param)->render(),

        ]);


    }





}
