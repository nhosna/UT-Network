<?php

namespace App\Models;
use Carbon\Carbon;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;


// Posts class instance will refer to posts table in database
    class Post  extends Model
    {
        protected $fillable = [
            'title',
            'body',
            'user_id',
            'vote_type',
            'expires_at',

        ];
        protected $with =['group','user'];

        protected $dates=['expires_at'];

        protected static function boot()
        {
            parent::boot();

            static::creating(function ($post) {
                if(is_null($post->user_id)) {
                    $post->user_id = auth()->user()->id;
                }
            });

            static::deleting(function ($post) {
                $post->comments()->delete();
                $post->votes()->delete();

            });

        }

        public function scopeActive($query){

           return $query ->where('expires_at','>=',Carbon::now('Asia/Tehran'));

        }

        public function scopeArchive($query){

           return $query ->where('expires_at','<',Carbon::now('Asia/Tehran'));

        }

        public function scopeSearch($query){

            $search=request()->search;

            return  $query
                ->where(  'posts.title', 'like',  "%". $search ."%")
                ->orWhere(  'posts.body', 'like', "%".  $search ."%");



        }


        public function scopeAuthor($query){


           return $query-> where('posts.user_id','=',auth()->user()->id);


        }
        public function scopeOrdered($query)
        {
            return $query
                ->orderBy('posts.expires_at','DESC')
                ->orderBy('posts.updated_at', 'DESC');


        }
        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function group()
        {
            return $this->belongsTo(Group::class);
        }



        public function comments()
        {
            return $this->hasMany(Comment::class   );


        }



        public function likers(){

            $likerIDs=$this->votes()->where('value','=',101)->pluck('user_id');
            $likers=User::whereIn('id',$likerIDs);
            return $likers;
        }

        public function files(){
            return $this->hasMany(File::class);


        }
        public function dislikers(){

            $likerIDs=$this->votes()->where('value','=',-1)->pluck('user_id');
            $likers=User::whereIn('id',$likerIDs);
            return $likers;

        }
        public function voters(){

            $voterIds=$this->votes()->pluck('user_id')->all();
            $voters=User::whereIn('id',$voterIds);

            return $voters;


        }


        public function poll()
        {



            return  json_decode( DB::table('polls')->where('post_id','=',$this->id)->pluck('items')->first(),true) ;

//            return $this->hasOne(Poll::class);
        }

        public function votes()
        {
            return $this->hasMany(Vote::class);
        }




        public function hasExpired( )
        {

            if(is_null($this->expires_at))
                return false;

            if($this->expires_at->greaterThan(Carbon::now( 'Asia/Tehran'))){
                    return false;
            }
            return true;



        }
    public function voteResult(){


            switch ($this->vote_type ){


                case('like'):
                    return $this->voteCount();
                case('percent'):
                    return $this->votePercentage();
                case('poll'):
                    return $this->votePollResult();


            }



    }

    public function myVote(){

            return $this->votes()
                ->where('user_id','=',auth()->user()->id)
                ->first ();


    }
    public function voteCountIndex(){
        return count($this->votes);


    }
    public function voteCount()
    {

        $likes=0;
        $dislikes=0;
        $count=0;

        foreach ($this->votes as $vote){
            if($vote->value==101){
                $likes=$likes+1;
            }
            else if($vote->value==-1){
                $dislikes=$dislikes+1;
            }

            $count=$count+1;

        }


        return [$likes ,$dislikes ];

    }


    public function votePercentage(){
        $percent=0;
        $count=0;
        foreach ($this->votes as $vote){
            $percent=$percent+$vote->value;
            $count=$count+1;
        }

        if($count==0)
            return [0,0];

        return [$percent/$count,$count];

    }





    public function votePollResult(){

        $count=0;
        $arr=[];


        foreach ($this->poll()  as $key=>$item){

            $arr[$key]=0;
            $l[]=$key;

        }


         foreach ($this->votes as $vote){
            $arr[$vote->value]=$arr[$vote->value]+1;
            $count=$count+1;
          }

        if($count==0)
            return [0,0];

        foreach ($arr as $k=>$a){
            $arr[$k]=round(($a/$count )*100,1);
        }
        asort($arr );

        return [ $arr  ,$count];


    }



}
