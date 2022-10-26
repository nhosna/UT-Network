<?php

use App\Models\Group;
use App\Models\Opinion;
use App\Models\Poll;
use App\Models\Vote;
use App\User;
use App\Models\Post;
use Faker\Generator;
use App\Models\Comment;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Generator $faker) {
    static $password;
    $arr=['user','super','admin'];

    return [
        'first_name'           => $faker->firstName,
        'last_name'           => $faker->lastName,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('password'),
        'remember_token' => Str::random(10),
        'role'=>$arr[array_rand(['user','super','admin'],1)]

    ];
});

$factory->define(Post::class, function (Generator $faker) {
    $arr=['like','percent','poll'];

    return [
        'title'        => $faker->sentence,
        'body'         => $faker->paragraph(30),
        'user_id'      => rand(1, 44),
        'group_id' =>  rand(1, 20),
        'vote_type'=>$arr[array_rand(['like','percent','poll'],1)],
        'expires_at'=>$faker->dateTime,

    ];
});



$factory->define(Comment::class, function (Generator $faker) {
    return [
        'user_id' => rand(1, 44),
        'post_id' => rand(1, 20),
        'body'    => $faker->paragraph(2)
    ];
});
//$factory->define(Vote::class, function (Generator $faker) {
//    return [
//        'user_id' => rand(0, 20),
//        'post_id' => rand(0, 20),
//        'body'    => $faker->paragraph(2)
//    ];
//});



$factory->define(Group::class, function (Generator $faker) {
    return [
        'name' =>$faker->sentence,
        'description'=>$faker->paragraph(3)
    ];
});

