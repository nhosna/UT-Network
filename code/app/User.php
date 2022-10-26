<?php

namespace App;

use App\Facades\Utilities;
use App\Models\Comment;
use App\Models\Group;
use App\Models\GroupUserPivot;
use App\Models\Post;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name','last_name', 'email','password'  ,'role'
    ];

    protected $table='users';

    protected $hidden = [
        'password', 'remember_token',
    ];


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
//            $user->posts()->delete();
//            $user->comments()->delete();
//            $user->votes()->delete();



        });
    }


      public function scopeSearch($query){
        $search=request()->search;
          return $query->where('first_name', 'like', "%$search%")
              ->orWhere('last_name', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%");

    }


    public function scopeSelect($query){

        return $query ->select('users.first_name','users.last_name','users.email','users.id');
    }
   public function scopeOrdered($query){

      return   $query  ->orderBy('last_name','ASC')
            ->orderBy('first_name','ASC');

    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function groups()
    {
        return $this->belongsToMany(Group::class)
            ->withPivot('is_admin');


    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }



    public function getUsername(){

        return Utilities::usernameFromEmail($this->email);


    }


    public function isAdmin(){
        return $this->role==='admin';
    }
    public function isUser() {
        return $this->role==='user';

    }
    public function isSuper() {
        return $this->role==='super';

    }

}
