<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();
Route::get('/', function (){
    return redirect('/home');

});



Route::group([  'namespace' => 'Auth'], function() {

    Route::get('/changepassword', 'ChangePasswordController@showChangePasswordForm')->name('auth.changepassword');
    Route::patch('/changepassword', 'ChangePasswordController@changePassword');

});


Route::group([  'middleware' => [ 'auth'   ]], function() {
    //-------------------------view--------------------

    Route::get('/view','ViewController@view' );
    //-------------------------home--------------------

    Route::get('/home','HomeController@index' )->name('home');


    //-------------------------import csv--------------------

    Route::get('/users/import', 'ImportController@getImport')->name('user.import');
    Route::post('/users/importparse', 'ImportController@parseImport')->name('user.importparse');
    Route::post('/users/importprocess', 'ImportController@processImport')->name('user.importprocess');

    //-------------------------user--------------------

    Route::get('/users/search', 'UserController@search'  )->name('user.search')
        ->middleware('can:viewAny,App\User');


    Route::get('/users', 'UserController@index'  )->name('user.index')
        ->middleware('can:viewAny,App\User');


    Route::get('/users/create', 'UserController@create'  )->name('user.create')
        ->middleware('can:create,App\User');

    Route::get('/users/{user}', 'UserController@show'  )->name('user.show')
        ->middleware('can:view,user');

    Route::get('/users/{user}/edit', 'UserController@edit'  )->name('user.edit')
        ->middleware('can:update,user');


    Route::post('/users', 'UserController@store'  )
        ->middleware('can:create,App\User');


    Route::put('/users/{user}', 'UserController@update'  )
        ->middleware('can:update,user');



    Route::delete('/users/{user}', 'UserController@destroy'  )
        ->middleware('can:delete,user');


    //-------------------------group--------------------

    Route::get('/groups', 'GroupController@index'  ) ->name('group.index')
        ->middleware('can:viewAny,App\Models\Group');

    Route::get('/groups/search', 'GroupController@search'  )->name('group.search')
        ->middleware('can:viewAny,App\Models\Group');


    Route::get('/groups/create', 'GroupController@create'  )  ->name('group.create')
        ->middleware('can:create,App\Models\Group');

    Route::get('/groups/{group}/details', 'GroupController@details'  ) ->name('group.detail')
        ->middleware('can:view,group');


    Route::get('/groups/{group}/edit', 'GroupController@edit'  )  ->name('group.edit')
        ->middleware('can:update,group');;


    Route::get('/groups/{group}/archive', 'GroupController@archive' ) ->name('group.archive')
        ->middleware('can:view,group');



    Route::get('/groups/{group}',  'GroupController@feed'  ) ->name('group.feed')
        ->middleware('can:view,group');



    Route::put('/groups/{group}/group', 'GroupController@updateGroup'  )
        ->middleware('can:update,group');


    Route::put('/groups/{group}/member', 'GroupController@updateMember'  )
        ->middleware('can:update,group');

    Route::delete('/groups/{group}', 'GroupController@destroy'  )
        ->middleware('can:delete,group');


    Route::post('/groups', 'GroupController@store'  )
        ->middleware('can:create,App\Models\Group');

    Route::get('/groups/{group}/searchfeed', 'GroupController@searchfeedpost'  )->name('group.searchfeedpost')
        ->middleware('can:view,group');

    Route::get('/groups/{group}/searcharchive', 'GroupController@searcharchivepost'  )->name('group.searcharchivepost')
        ->middleware('can:view,group');







    //-------------------------post--------------------


    Route::get('/groups/{group}/newpost', 'PostController@create')->name('post.create')
        ->middleware('can:create,group,App\Models\Post');

    Route::get('/posts/search', 'PostController@search'  )->name('post.search')
        ->middleware('can:viewAny,App\Models\Post');


    Route::get('/posts', 'PostController@index'  ) ->name('post.index')
        ->middleware('can:viewAny,App\Models\Post');


    Route::get('/posts/{post}/edit', 'PostController@edit'  )->name('post.edit')
    ->middleware('can:update,post');



    Route::get('/posts/{post}/voters', 'PostController@voters'  )->name('post.voters')
        ->middleware('can:view,post');



    Route::get('/posts/{post}', 'PostController@show'  )  ->name('post.show')
    ->middleware('can:view,post');



    Route::post('/groups/{group}/posts', 'PostController@store'  )->name('post.store')
        ->middleware('can:create,group,App\Models\Post');




    Route::put('/posts/{post}', 'PostController@update'  )
        ->middleware('can:update,post');


    Route::delete('/posts/{post}', 'PostController@destroy'  )
        ->middleware('can:delete,post');




    //-------------------------comment--------------------




    Route::post('/posts/{post}/comment', 'CommentController@store' );



    Route::put('/comments/{comment}', 'CommentController@update'  );

    Route::delete('/comments/{comment}', 'CommentController@destroy'  );



    //-------------------------reply--------------------

    Route::get('/comments/{comment}/replies', 'ReplyController@show'  )->name('reply.show');

    Route::put('/replies/{reply}', 'ReplyController@update'  )->name('reply.update');
    Route::delete('/replies/{reply}', 'ReplyController@destroy'  )->name('reply.destroy');


    Route::post('/comments/{comment}/reply', 'ReplyController@store')->name('reply.store');


    //-------------------------vote--------------------



    Route::put('/votes/{vote}', 'VoteController@update'  )->name('vote.update');

    Route::delete('/votes/{vote}', 'VoteController@destroy'  )->name('vote.destroy');

    Route::post('/posts/{post}/vote', 'VoteController@store' )->name('vote.store');


    //-------------------------file--------------------


    Route::get('/files/{file}', 'FileController@show')->name('file.show');


    Route::post('/files', 'FileController@store')->name('file.store');
//        ->middleware('can:create,App\Models\File');



    Route::delete('/files/{file}', 'FileController@destroy')->name('file.destroy');
//        ->middleware('can:delete,file');



});

