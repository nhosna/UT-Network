@extends('layouts.panel')
@section('panelbread')
    {{ Breadcrumbs::render('post.index'  ) }}

@endsection

@section('panelhead')
    <h2>
        Posts
    </h2>
@endsection
@section('panelbody')


    @include('partials.search-bar',['route'=>route('post.search' )] )

    <div id="search-container">

        @include('panels.view.index-post')

    </div>

@endsection

