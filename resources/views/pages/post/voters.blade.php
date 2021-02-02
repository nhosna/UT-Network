


@extends('layouts.panel')


@section('panelbread')
    {{ Breadcrumbs::render('post.voters',$post->group,$post ) }}

@endsection


@section('panelhead')
    <h2> Voters </h2>

@endsection


@section('panelbody')


    @include('panels.view.show-voters')


@endsection












