

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-2 col-sm-3 control-label ']) !!}

    <div class="col-md-8 col-sm-11">
        {!! Form::text('name', isset($group)? $group->name:null, ['class' => 'form-control rtl-text', 'required', 'autofocus','id'=>'edit-group-name']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    </div>
</div>

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    {!! Form::label('description', 'Description', ['class' => 'col-md-2 col-sm-3 control-label ']) !!}

    <div class="col-md-8 col-sm-11">
        {!! Form::textarea('description',isset($group)? $group->description:null , ['class' => 'form-control rtl-text' ,'required','id'=>'edit-group-description']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    </div>
</div>








