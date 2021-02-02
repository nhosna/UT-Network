




{!! Form::open(  ['method' => 'PUT', 'url' => "/groups/{$group->id}/member", 'class' => 'form-horizontal', 'role' => 'form','name'=>'edit-member','data-value'=>$group->id]) !!}



<div class="form-group row ">

    <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2   col-xs-8 col-xs-offset-2 ">
        @include('partials.initials-paginate',['route'=>'group.edit'])
    </div>
</div>

<div id="filter-container">
@include('panels.form.edit-members' )
</div>

<div class="form-group">
    <div class="col-md-8 col-md-offset-2">
        <button type="submit" class="btn btn-primary pull-right"    >
            Save Changes
        </button>
    </div>
</div>

{!! Form::close( ) !!}


@push('scripts')
 <script src="{{ asset('js/scripts/edit-member.js') }}"></script>

@endpush
