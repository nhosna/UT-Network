



{!! Form::open(['url' => "posts/$post->id/vote" ]) !!}

@if($post->vote_type==='poll')

    <div class="row justify-content-center mt-5" style="background-color: transparent; " >
    <div class="col-md-8 col-md-offset-2"  style="background-color: transparent"  id="vote-panel_{{$post->id}}"    >
        @include('panels.form.create-vote-poll',['post_id'=>$post->id])
    </div>

    </div>

    <div class="row justify-content-between mt-5" style="background-color: transparent">


    <div class="col-8 col-md-offset-2"  style="background-color: transparent"  >
        <div class="form-group">
            {!! Form::text('body', null, ['class' => 'form-control rtl-text', 'rows' => 1 ,'maxlength'=>255  ]) !!}
        </div>

    </div>
    <div class="col-2"  style="background-color: transparent">
        <button type="submit" class="btn btn-primary">
            Vote
        </button>
    </div>

    </div>


@else



<div class="row justify-content-center">


    <div class="col-3 col-md-offset-2  "  style="background-color: transparent"     >

        @if($post->vote_type==='percent')
            @include('panels.form.create-vote-percent',['post_id'=>$post->id])
        @elseif($post->vote_type==='like')
            @include('panels.form.create-vote-like',['post_id'=>$post->id])
        @endif
    </div>

    <div class="col-3"  style="background-color: transparent"  >
        <div class="form-group">
            {!! Form::text('body', null, ['class' => 'form-control rtl-text', 'rows' => 1 ,'maxlength'=>255  ]) !!}
        </div>
    </div>
    <div class="col-2 form-group"  >
        <button type="submit" class="btn btn-primary">
            Vote
        </button>
    </div>



</div>





@endif


{!! Form::close() !!}

