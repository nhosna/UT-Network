@extends('layouts.panel')
@section('panelbread')
    {{ Breadcrumbs::render('group.detail',$group ) }}

@endsection

@section('panelhead')





    <div class="row">
        <div class="col-2">
            <a href="{{  route('group.feed',$group->id)  }}" class="btn btn-default pull-left"> Back</a>
        </div>

        <div class="col-8">

            <h3 style="text-align: center;direction: rtl" class="break-word " >
                {{ $group->name }}
            </h3>
        </div>
        <div class="col-2">
            @can('update',$group)
                <a href="{{route('group.edit',$group->id)}}" class="btn btn-default pull-right"><i class="fa fa-edit" ></i> Edit Group</a>
            @endcan

        </div>


    </div>

@endsection
@section('panelbody')

    <div class="row justify-content-center">
        <div class="col-2"></div>
        <div class="col-8"  >
            <h4 style="text-align: center">
                Description
            </h4>
            <p class="rtl-text"style="text-align: center" >
                {{$group->description}}

            </p>
        </div>
        <div class="col-2"></div>
    </div>

{{--    @include('panels.view.show-admin');--}}
    @include('panels.view.show-member');

@endsection

