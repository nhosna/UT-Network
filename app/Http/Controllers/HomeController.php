<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(Request $request)
    {



        if(auth()->user()->isSuper()  ){

            $posts=Post::
                 active()
                ->select('posts.*')
                ->ordered()
                ->paginate(10);

        }
        else{

            $posts=Post::join ('group_user', function($q)  {
                $q->on('group_user.group_id', '=', 'posts.group_id')
                    ->where('group_user.user_id', '=', auth()->user()->id);
            })
                ->active()
                ->select('posts.*')
                ->ordered()
                ->paginate(10);


        }



        return view('pages.home', compact('posts'));

    }





}
