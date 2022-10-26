

<div class="card-body" >
    {!! Form::open(  ["method" => "PUT", "url" => "/votes/{$id}", "class" => "form-horizontal", "role" => "form","name"=>"edit-group"]) !!}


    @if($type==='poll')

        <div class="row justify-content-center">

            <div class="col-8 col-md-offset-2  "  style="background-color: transparent"  id="vote-panel_{{$post_id}}"  >
                @include('panels.form.create-vote-poll',['initval'=>$value,'poll'=>$poll])
            </div>


        </div>


        <div class="row justify-content-center">



        <div class="col-8 col-md-offset-2"  style="background-color: transparent"  >
            <div class="form-group">
                {!! Form::text('body',  $body , ['class' => 'form-control rtl-text', 'rows' => 1 , 'maxlength'=>255  ]) !!}
            </div>

        </div>
        <div class="col-2 form-group"  >
            <button type="submit" class="btn btn-primary">
                Reply
            </button>
        </div>


        </div>
    @else

    <div class="row justify-content-center">


        <div class="col-3  "  style="background-color: transparent"  id="vote-panel_{{$post_id}}"  >

            @if($type==='percent')
                @include('panels.form.create-vote-percent',['initval'=>$value] )
            @elseif($type==='like')
                @include('panels.form.create-vote-like',['initval'=>$value])
            @endif

        </div>

        <div class="col-6"  style="background-color: transparent"  >
            <div class="form-group">
                {!! Form::text('body',  $body , ['class' => 'form-control rtl-text', 'rows' => 1 , 'maxlength'=>255  ]) !!}
            </div>

        </div>
        <div class="col-3 form-group"  >
            <button type="submit" class="btn btn-primary">
                Reply
            </button>
        </div>



    </div>

    @endif

    {!! Form::close( ) !!}

</div>
