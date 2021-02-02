<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'value',
        'body',
        'user_id',
        'post_id',
        'type'
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

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
