@extends('layouts.panel')
@section('panelbread')
    {{ Breadcrumbs::render('group.edit',$group ) }}

@endsection

@section('panelhead')

    <div class="row">
        <div class="col-2">

                <a href="{{ url("/groups/{$group->id}/details") }}" class="btn btn-default pull-left"> Back</a>


        </div>

        <div class="col-8">

        <h3 style="text-align: center;direction: rtl" class="break-word " >
            {{ $group->name }}
        </h3>
        </div>
        <div class="col-2">

            @can( 'delete',$group )
                <a href="{{ url("/groups/{$group->id}") }}"  class="btn btn-danger pull-right " data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?"  ><i class="fa fa-trash-o"></i> Delete</a>
            @endcan

        </div>




    </div>



@endsection
@section('panelbody')

    <h4 style="text-align: center">Edit Name And Description</h4>
    {!! Form::open(  ['method' => 'PUT', 'url' => "/groups/{$group->id}/group", 'class' => 'form-horizontal', 'role' => 'form','name'=>'edit-group','data-value'=>$group->id]) !!}

    @include('panels.form.edit-group')

    <div class="form-group">
        <div class="col-md-8 col-md-offset-2  ">
            <button type="submit" class="btn btn-primary pull-right"    >
                Save Changes
            </button>
        </div>
    </div>
    {!! Form::close( ) !!}

    <h4 style="text-align: center">Edit Members</h4>

    @include('panels.form.edit-member')

@endsection

