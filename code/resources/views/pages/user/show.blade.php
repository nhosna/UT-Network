

@extends('layouts.panel')


@section('panelbread')

    {{ Breadcrumbs::render('user.show',$user ) }}

@endsection
@section('panelhead')


    <h2>
        Profile
        @can('update',$user)
            <a href="{{ url("/users/{$user->id}/edit") }}" class="btn btn-default pull-right"  ><i class="fa fa-edit"></i> Edit Profile</a>
        @endcan


    </h2>






@endsection
@section('panelbody')

    @include('panels.view.show-user')




@endsection

