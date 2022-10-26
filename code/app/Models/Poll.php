<?php

namespace App\Models;
use App\User;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Poll extends Model
{

    protected $guarded = [];
    protected $casts = [
        'items' => 'array',

    ];
    public $timestamps = false;
    public function post()
    {
        return $this->belongsTo(Post::class);
    }




}
