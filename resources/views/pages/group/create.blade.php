
@extends('layouts.panel')

@section('panelbread')

    {{ Breadcrumbs::render('group.create') }}

@endsection

@section('panelhead')
    <h2>
        Create a Group

        <a href="{{ url('/groups') }}" class="btn btn-default pull-right"> Back</a>
    </h2>
@endsection

@section('panelbody')
    {!! Form::open(['url' => '/groups', 'method'=>'POST','class' => 'form-horizontal', 'role' => 'form'  ]) !!}

    @include('panels.form.edit-group')

    <div class="form-group">
        <div class="col-md-8 col-md-offset-2">
            <button type="submit" class="btn btn-primary pull-right" >
                Create
            </button>
        </div>
    </div>

    {!! Form::close() !!}


@endsection
