<?php

namespace App\Models;
use App\User;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Group extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','description'
    ];

    public $timestamps = false;

    protected $with =[ ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($group) {

        });

        static::deleting(function ($group) {


            $group->users()->detach();
            $group->posts()->delete();
        });
    }


   public function scopeSearch($query){

        $search=request()->search;

        return  $query   ->where(  'groups.name', 'like',"%".  $search ."%");
//            ->orWhere(  'groups.description', 'like', "%". $search ."%");


    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('groups.name', 'ASC') ;
    }



    public function members(){
        return $this->belongsToMany(User::class)
            ->wherePivot('is_admin', '=',false)
            ->withPivot('is_admin');
    }

    public function admins(){
        return $this->belongsToMany(User::class)
            ->wherePivot('is_admin', '=',true)
            ->withPivot('is_admin');
    }



    public function users()
    {
        return $this->belongsToMany( User::class)
            ->withPivot('is_admin');

    }


    public function posts()
    {
        return $this->hasMany( Post::class);
    }




}
