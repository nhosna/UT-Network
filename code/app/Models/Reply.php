<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = 'replies';

    protected $fillable = [
        'body',
        'user_id',
        'replyable_id',
        'replyable_type',

        'comment_id'
    ];
    protected $with =[ 'user','comment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function comment(){
        return $this->belongsTo(Comment::class);
    }

    public function replyable(){


        if($this->replyable_type=='comment'){


            return Comment::where('id','=',$this->replyable_id)->first();

        }else{
            return Reply::where('id','=',$this->replyable_id)->first();


        }

    }
    public function replies(){

        return $this->hasMany(Reply::class ,'reply_id'  );

    }




}
