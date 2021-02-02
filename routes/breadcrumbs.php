<?php


use App\User;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


/////////---------------------------------------------------------

//Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});
//Home/groups

Breadcrumbs::register('group.index', function ($breadcrumbs  ) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Groups', route('group.index' ));
});
//Home/groups/groupname

Breadcrumbs::register('group.feed', function ($breadcrumbs,$group) {
    $breadcrumbs->parent('group.index');
    $breadcrumbs->push( $group->name, route('group.feed', $group));
});

//Home/groups/groupname/posttitle

Breadcrumbs::register('post.show', function ($breadcrumbs,$group,$post) {
    $breadcrumbs->parent('group.feed',$group);
//    $breadcrumbs->push(Str::limit($post->title,30), route('post.show', $post));
    $breadcrumbs->push( $post->title , route('post.show', $post));
});


//Home/groups/groupname/posttitle/edit

Breadcrumbs::register('post.edit', function ($breadcrumbs,$group,$post) {
    $breadcrumbs->parent('post.show',$group,$post);
    $breadcrumbs->push('Edit', route('post.edit', $post));
});

//Home/groups/groupname/posttitle/voters

Breadcrumbs::register('post.voters', function ($breadcrumbs,$group,$post) {
    $breadcrumbs->parent('post.show',$group,$post);
    $breadcrumbs->push('Voters', route('post.voters', $post));
});


//Home/groups/groupname/archive

Breadcrumbs::register('group.archive', function ($breadcrumbs,$group ) {
    $breadcrumbs->parent('group.feed',$group);
    $breadcrumbs->push('Archive', route('group.archive', $group));
});

//Home/groups/groupname/details

Breadcrumbs::register('group.detail', function ($breadcrumbs,$group ) {
    $breadcrumbs->parent('group.feed',$group);
    $breadcrumbs->push('Group Details', route('group.detail', $group));
});
//Home/groups/groupname/edit
Breadcrumbs::register('group.edit', function ($breadcrumbs,$group ) {

    $breadcrumbs->parent('group.detail',$group);
    $breadcrumbs->push('Edit Group', route('group.edit', $group));
});
//Home/groups/create
Breadcrumbs::register('group.create', function ($breadcrumbs  ) {
    $breadcrumbs->parent('group.index' );
    $breadcrumbs->push('New Group', route('group.create' ));
});

//Home/posts

Breadcrumbs::register('post.index', function ($breadcrumbs ) {
    $breadcrumbs->parent('home' );
    $breadcrumbs->push('Posts', route('post.index' ));
});
//Home/group/groupname/createpost

Breadcrumbs::register('post.create', function ($breadcrumbs,$group ) {
    $breadcrumbs->parent('group.feed',$group );
    $breadcrumbs->push('New Post', route('post.create' ,$group));
});


//home/users/user/
Breadcrumbs::register('user.index', function ($breadcrumbs  ) {
    $breadcrumbs->parent('home' );
    $breadcrumbs->push('Users', route('user.index'  ));
});
//home/users/user/
Breadcrumbs::register('user.show', function ($breadcrumbs,$user ) {

    if( Auth::user()->can('viewAny',User::class)){
        $breadcrumbs->parent('user.index'  );
    }
    else{
        $breadcrumbs->parent('home'  );

    }
    $breadcrumbs->push($user->first_name.' '.$user->last_name, route('user.show',$user ));
});

//home/users/user/edit
Breadcrumbs::register('user.edit', function ($breadcrumbs,$user ) {
    $breadcrumbs->parent('user.show',$user );
    $breadcrumbs->push('Edit Profile', route('user.edit' ,$user));
});

//home/users/user/changepassword
Breadcrumbs::register('auth.changepassword', function ($breadcrumbs,$user ) {
    $breadcrumbs->parent('user.edit',$user );
    $breadcrumbs->push('Change Password', route('auth.changepassword' ,$user));
});

//home/users/create
Breadcrumbs::register('user.create', function ($breadcrumbs  ) {
    $breadcrumbs->parent('user.index'  );
    $breadcrumbs->push('New User', route('user.create'  ));
});
//home/users/import
Breadcrumbs::register('user.import', function ($breadcrumbs  ) {
    $breadcrumbs->parent('user.index'  );
    $breadcrumbs->push('Import Users', route('user.import'  ));
});


