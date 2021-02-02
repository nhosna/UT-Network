

{!! Form::open(['method'=>'PUT','url' =>"/posts/$post->id" ,'class'=> "form-horizontal",'role'=>'form' ,'id'=>'post-create' ]) !!}



<div class="form-group row {{ $errors->has('title') ? ' has-error' : '' }}">
    {!! Form::label('title', 'Title', ['class' => 'col-md-2 col-sm-3 control-label' ]) !!}

    <div class="col-md-8 col-sm-8">
        {!! Form::text('title', $post->title, ['class' => 'form-control rtl-text', 'required', 'autofocus' ]) !!}

        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    </div>
</div>

<div class="form-group row {{ $errors->has('body') ? ' has-error' : '' }}">
    {!! Form::label('body', 'Body', ['class' => 'col-md-2 col-sm-3 control-label']) !!}

    <div class="col-md-8 col-sm-8">
        {!! Form::textarea('body',  $post->body, ['class' => 'form-control rtl-text', 'required']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('body') }}</strong>
        </span>
    </div>
</div>





<div class="form-group row {{ $errors->has('vote_type') ? ' has-error' : '' }}">
    <label class="col-md-2 col-sm-3 control-label">Vote Type </label>
    <div class="col-md-8 col-sm-8" >
        @include('partials.set-vote-type',['initval'=>$post->vote_type, ])
    </div>
    <span class="help-block">
            <strong>{{ $errors->first('vote_type') }}</strong>
        </span>
</div>


<div id="poll-container" style="display: none">

    <div class="form-group row {{ $errors->has('poll') ? ' has-error' : '' }}">
        <label class="col-md-2 col-sm-3 control-label">Poll</label>
        <div class="col-md-8 col-sm-8">
            @include('panels.form.create-poll' ,['initval'=>$post->poll()  ])

        </div>
        <span class="help-block">
                <strong>{{ $errors->first('poll') }}</strong>
                </span>
    </div>


</div>

<div class="form-group row ">
    <label class="col-md-2 col-sm-3 control-label">Set Expiration </label>
    <div class="col-md-6 col-sm-6">
        @include('partials.set-expiration',['initval'=>$post->expires_at])
    </div>
</div>


{!!   Form::hidden('group',$post->group ->id); !!}

<div class="form-group">
    <div class="col-md-2 pull-right   ">
        <button type="submit" class="btn btn-primary">
            Update
        </button>
    </div>
</div>


{!! Form::close() !!}




@push('scripts')
    <script src="{{ asset('js/scripts/create-post.js') }}" type="text/javascript"></script>

@endpush


