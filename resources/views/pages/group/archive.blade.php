
@extends('layouts.panel')

@section('panelbread')
    {{ Breadcrumbs::render('group.archive',$group ) }}

@endsection



@section('panelhead')
    <h1 style="text-align: center" class="break-word ">
        {{ $group->name }}
    </h1>
@endsection

@section('panelbody')


    @include('partials.search-bar',[ 'route'=>route('group.searcharchivepost',$group->id)])


    <ul class="nav nav-tabs nav-justified    ">
        <li class=" nav-item   "  ><a href="{{ url("/groups/{$group->id}") }}"   >Posts</a></li>
        <li class="nav-item active"  ><a href="#"   >Archive</a></li>
    </ul>
@endsection

@section('panelend')

    <div id="search-container">


    @include('panels.view.show-posts' )
    </div>
@endsection


