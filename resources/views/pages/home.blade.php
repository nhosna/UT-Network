@extends('layouts.container')



@section('containerbread')
    {{ Breadcrumbs::render('home' ) }}

@endsection

@section('containercontent')

    @include('panels.view.show-posts')

@endsection


