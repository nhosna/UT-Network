<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'display_name','post_id',
        'file_name',
        'path',
        'extension'
    ];

    protected $table = 'files';
    public function post()
    {
        return $this->belongsTo(Post::class);
    }



}
