

@extends('layouts.panel')

@section('panelbread')

    {{ Breadcrumbs::render('user.edit',$user ) }}

@endsection

@section('panelhead')
    <h2>
        Edit Profile
        @can( 'delete',$user )
            <a href="{{ url("/users/{$user->id}") }}"  class="btn btn-danger pull-right " data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?"  ><i class="fa fa-trash-o"></i> Delete</a>
        @endcan
    </h2>



@endsection
@section('panelbody')

    @include('panels.form.edit-user')
@endsection

