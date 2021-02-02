




@extends('layouts.panel')



@section('panelbread')
    {{ Breadcrumbs::render('user.index' ) }}

@endsection

@section('panelhead')
    <h2>
        Users
        @can( 'create', App\User::class )
            <a href="{{ url('/users/create') }}" class="btn btn-default pull-right"><i class="fa fa-user" ></i> New User</a>
            <a href="{{ url('/users/import') }}" class="btn btn-default pull-right"><i class="fa fa-upload" ></i> Import Users</a>


        @endcan
    </h2>




@endsection
@section('panelbody')

    @include('partials.search-bar',['route'=> route('user.search')] )

    <div id="search-container">


        @include('panels.view.index-user')

    </div>

@endsection

