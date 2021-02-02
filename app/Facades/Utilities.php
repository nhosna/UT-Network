<?php
namespace App\Facades;


use App\Facades\Morilog\CalendarUtils;
use App\Facades\Morilog\Jalalian;
use App\Models\Group;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class Utilities
{

    public static function usernameFromEmail($email){
        return explode('@',$email)[0];
    }
    //---------------------------GroupController-------------------


    public static function isMemberOf(User $user,Group $group){

        return DB::table('group_user')->where(['user_id'=>$user->id,'group_id'=>$group->id])->exists();

    }


    public static function isAdminOf(User $user,Group $group){

        return DB::table('group_user')->where(['user_id'=>$user->id,'group_id'=>$group->id,'is_admin'=>true])->exists();

    }


    //---------------------------PostController-------------------



    public static function toGregorianDateTime ($datetime){

        $datetime=date_parse_from_format( 'Y/m/d H:i:s', $datetime) ;

        $gdate=CalendarUtils::toGregorian($datetime['year'], $datetime['month'], $datetime['day']);
        $c=Carbon::create($gdate[0], $gdate[1], $gdate[2], $datetime['hour'], $datetime['minute'], $datetime['second'], 'Asia/Tehran');

        return $c;

    }


}


