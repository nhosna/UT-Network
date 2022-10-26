
@extends('layouts.panel')

@section('panelbread')
    {{ Breadcrumbs::render('user.create' ) }}

@endsection

@section('panelhead')

    <h2>
        Create a User
        <a href="{{ url("/users") }}" class="btn btn-default pull-right"> Back</a>

    </h2>
@endsection

@section('panelbody')

@include('panels.form.create-user')


@endsection
