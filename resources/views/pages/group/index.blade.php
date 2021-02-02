
@extends('layouts.panel')

@section('panelbread')

    {{ Breadcrumbs::render('group.index') }}

@endsection



@section('panelhead')
    <h2>
        Groups

        @can( 'create', App\Models\Group::class )

                 <a href="{{ url('groups/create') }}" class="btn btn-default pull-right"><i class="fa fa-university" ></i> New Group</a>
        @endcan



    </h2>
@endsection

@section('panelbody')
    @include('partials.search-bar',['route'=>route('group.search' )] )


    <div id="search-container">

        @include('panels.view.index-group')

    </div>
@endsection





