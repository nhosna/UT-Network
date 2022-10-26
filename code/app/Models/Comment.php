<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'body',
        'user_id',
        'post_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($comment) {
            if(is_null($comment->user_id)) {
                $comment->user_id = auth()->user()->id;
            }
        });
    }
    protected $with =[ 'user','post'];

    public function scopeOrdered($query){


     return    $query  ->orderBy('comments.updated_at', 'ASC');


    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function post()
    {
        return $this->belongsTo(Post::class );
    }



    public function replies(){
           return $this->hasMany(Reply::class );


    }



}
