
{{--<h4 style="text-align: center">Voters</h4>--}}


<div class="row">
    <div class="col-2"></div>

        <ul class="list-group col-8 row  " >


            @foreach($results as $result)
                <li class="list-group-item  " >


                    <div class="col-md-2 col-sm-3 col-xs-4 ">
                        <a href="/users/{{$result->id}}" style="color: #555555;">  @include('partials.user-avatar',['size'=>'sm','first_name'=>$result->first_name ,'last_name'=>$result->last_name])</a>

                    </div>


                    <div class="col-md-9 col-sm-7 col-xs-7 ">
                     <h4> {{ $result->first_name }} {{ $result->last_name }}</h4>
                    </div>

                    <div class="col-md-1 col-sm-2 col-xs-1">
                        @if($result->type==='percent')
                            @include('partials.vote-voters-result-percent',['initval'=>$result->value,'id'=>$result->id])
                        @elseif($result->type==='like')
                            @include('partials.vote-voters-result-like',['initval'=>$result->value,'id'=>$result->id])
                        @elseif($result->type==='poll')
                            @include('partials.vote-voters-result-poll',['initval'=>$result->value,'id'=>$result->id])
                        @endif
                    </div>



                </li>

                @if(!is_null($result->body))
                <li class="list-group-item" >
                    <p class="rtl-text">  {!!   nl2br($result->body)   !!} </p>
                </li>
                @endif

            @endforeach

        </ul>




    <div class="col-2"></div>


</div>


<div class="text-center" >

   {{$results->links()}}
</div>
