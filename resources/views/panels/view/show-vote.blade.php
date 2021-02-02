
<div class="form-row row ">


   <div class="col-12">

         <div  class="panel panel-default  mt-5">


             <div  class="panel-heading">


                <h2 class="panel-title">You voted:</h2>
                <small class="text-muted " style="font-style:italic">{{ $vote->created_at->diffForHumans() }} </small>

                 @if($post->hasExpired()===false)
                <div class="dropdown show pull-right">
                    <button class="btn btn-secondary dropdown-toggle" style="  color: black;background-color: transparent; border-color: transparent;" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" onclick="makeVoteEditable(this,{{$vote->id}},{{$vote->value}},'{{$vote->body}}','{{$vote->post->vote_type}}',{{$vote->post->id}},  {{$post->vote_type=='poll'? json_encode($post->poll())  :''}}   )" href="#" >Edit</a>
                        <a class="dropdown-item" href="{{ url("/votes/{$vote->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" >Delete</a>
                    </div>
                </div>

                 @endif

            </div>




        <div class="panel-body"   >
        <div   id="votebody_{{$vote->id}}" >
            {!! Form::open(  ["method" => "PUT", "url" => "/votes/{$vote->id}", "class" => "form-horizontal", "role" => "form","name"=>"edit-group"]) !!}

            <div class="row justify-content-around ">

                <div class="col-md-8  col-md-offset-1 col-sm-6  " id="vote_{{$vote->id}}">
                    <p class="rtl-text">    {!!   nl2br($vote->body)   !!}</p>
                </div>
                <div class="col-md-3 col-sm-6  "  id="vote-panel_{{$vote->post->id}}" style="text-align: center"  >
                    @if($vote->post->vote_type==='percent')
                        @include('partials.vote-voters-result-percent',['initval'=>$vote->value,'id'=>$vote->id ])
                    @elseif($vote->post->vote_type==='like')
                        @include('partials.vote-voters-result-like',['initval'=>$vote->value,'id'=>$vote->id])
                    @elseif($vote->post->vote_type==='poll')
                       @include('partials.vote-voters-result-poll',['initval'=>$vote->value,'id'=>$vote->id])

                    @endif


                </div>
            </div>

            {!! Form::close( ) !!}

        </div>
        </div>





    </div>
</div>
</div>



