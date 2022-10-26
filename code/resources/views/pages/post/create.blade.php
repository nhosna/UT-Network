


@extends('layouts.panel')


@section('panelbread')
    {{ Breadcrumbs::render('post.create',$group ) }}

@endsection


@section('panelhead')
   <h2> Create a Post

       <a href="{{ route('group.feed',$group->id) }}" class="btn btn-default pull-right"> Back</a>

   </h2>

@endsection


@section('panelbody')


    @include('panels.form.create-post')


@endsection












