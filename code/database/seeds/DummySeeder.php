<?php

use App\Models\Group;
use App\Models\Poll;
use App\Models\Vote;
use App\User;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Generator as Faker;
use Illuminate\Support\Str;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        factory(Group::class, 20)->create();
        factory(User::class, 50)->create();
        factory(Post::class, 20)->create();
        factory(Comment::class, 20)->create();


        self::addRoles();
        self::addMembers();
        self::addVotes();



    }
    public static function addRoles(){
       static $password;



        User::create(

             [
                  'first_name'           => 'super',
                  'last_name'           =>  'super',
                  'email'          => 'super@super.com',
                  'password'       =>    bcrypt('supersuper'),
                  'remember_token' => Str::random(10),
                  'role'=>'super'

              ]
        );



        User::create(

             [
                  'first_name'           => 'user',
                  'last_name'           =>  'user',
                  'email'          => 'user@user.com',
                  'password'       =>    bcrypt('useruser'),
                  'remember_token' => Str::random(10),
                  'role'=>'user'

              ]
        );

             User::create(

             [
                  'first_name'           => 'admin',
                  'last_name'           =>  'admin',
                  'email'          => 'admin@admin.com',
                  'password'       =>    bcrypt('adminadmin'),
                  'remember_token' => Str::random(10),
                  'role'=>'admin'

              ]
        );



    }
    public static function addVotes(){

        $users=User::all();
        $posts=Post::all();

        $arr=[101,-1];
        $pollitems=['a','b','c','d','e','f','g','h'];

        foreach ($posts as $post){
            if($post->vote_type=='poll'){
                $arrr=[];
                $randd=array_rand($pollitems,rand(2,8));
                foreach ($randd as $r){
                    $arrr[]=$pollitems[$r];
                }

                Poll::create([
                        'post_id'=>$post->id,
                        'items'=>$arrr
                    ]
                );

            }


            foreach ($users as $user){
                $rand1=rand(0,1);
                if($rand1==1){
                    if($post->vote_type==='like'){

                        $val=$arr [array_rand([101,-1],1)];

                    }
                    else if($post->vote_type==='percent'){

                        $val=rand (0,100);
                    }
                    else if($post->vote_type==='poll'){



                        $count=count($arrr);
                        $val=random_int(0,$count-1);

                    }

                    Vote::create([
                        'value'=>$val,
                         'body'=>null,
                            'post_id'=>$post->id,
                            'user_id'=>$user->id,
                            'type'=>$post->vote_type,


                        ]

                    );

                }


            }
        }

    }
    public static function setAdmin(Group $group ,$admin){


        DB::table('group_user')
            ->insertOrIgnore(['user_id' => $admin , 'group_id' => $group->id,'is_admin' => true]);

    }
    public static function setMember(Group $group,$id){
        DB::table('group_user')
            ->updateOrInsert(['user_id'=>$id,'is_admin'=>false,'group_id'=>$group->id ]);

    }

    public static function addMembers(){

        //set members of groups
        $groups=Group::all();
        $users=User::all();

        foreach ($groups as $group){
            foreach ($users as $user){
                $rand1=rand (0,1);
                if($rand1==1){
                    self::setAdmin($group,$user->id);


                }

                $rand2=rand  (0,1);
                if($rand1==0 && $rand2==1){
                    self::setMember($group,$user->id);
                }
            }
        }
    }
}
