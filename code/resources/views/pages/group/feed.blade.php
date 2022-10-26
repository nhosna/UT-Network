


@extends('layouts.panel')


@section('panelbread')
    {{ Breadcrumbs::render('group.feed',$group ) }}

@endsection


@section('panelhead')

    <div class="row justify-content-center">

        <h3 style="text-align: center;direction: rtl" class="break-word " >

        {{ $group->name }}</h3>
    </div>

    <div class="row justify-content-end">
    <a href="{{ url("/groups/{$group->id}/details") }}" class="btn btn-default pull-left" style="text-align: left"><i class="fa fa-info-circle" ></i> Details</a>

    @can('create',['App\Models\Post',$group])

        <a href="{{ url("/groups/{$group->id}/newpost") }}" class="btn btn-default pull-right"><i class="fa fa-newspaper-o" ></i> New Post</a>
    @endcan
     </div>



@endsection


@section('panelbody')


    @include('partials.search-bar',['route'=>route('group.searchfeedpost',$group->id)] )


    <ul class="nav nav-tabs nav-justified    ">
        <li class=" nav-item active "  ><a href="#"    >Posts</a></li>
        <li class="nav-item"  ><a href="{{ url("/groups/{$group->id}/archive") }}"   >Archive</a></li>
    </ul>



@endsection

@section('panelend')



    <div id="search-container">

       @include('panels.view.show-posts')
    </div>


@endsection



