@extends('layouts.container')

@section('containerbread')
    {{ Breadcrumbs::render('post.show',$post->group,$post) }}


@endsection

{{--@section('panelhead')--}}
{{--<h1>Post</h1>--}}
{{--@endsection--}}

@section('containercontent')
    @include('panels.view.show-post')
@endsection
