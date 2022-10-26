
@if(isset($reply))



        <div class="card   mt-5"   id="areply_{{$reply->id}}" style="background-color: rgba(236,236,236,0.32)"  >

            <div class="card-body"  >
                <div class="row  ">

                    <div class="col-md-1 col-sm-2  col-xs-3"  >
                        <a href="{{ url('users/'.$reply->user->id) }}" style="  color: #555555;">   @include('partials.user-avatar', ['size'=>'sm','first_name'=>$reply->user->first_name ,'last_name'=>$reply->user->last_name])</a>
                    </div>


                    <div class="col-md-9 col-sm-8 col-xs-7 "  >
                        <h4 class="card-title">   {{ $reply->user->first_name  }} {{ $reply->user->last_name  }}
{{--                            <p class="card-text "><small class="text-muted " style="font-style:italic">{{ $reply->updated_at->diffForHumans() }}</small></p>--}}
                            <p class="card-text "><small class="text-muted " style="font-style:italic">{{Jalalian::fromCarbon( $reply->updated_at)->format('%A, %d %B %Y, %H:%m')   }} </small></p>
                        </h4>

                    </div>


                    <div class="col-md-2  col-sm-2  col-xs-2"  >


                        @if($reply->user->id===auth()->user()->id)
                            @include('partials.reply-options')
                        @endif
                    </div>
                    </div>

             <div class="row  ">
                    <div class="col-md-8 col-md-offset-2 cols-sm-8 col-sm-offset-2  cols-xs-8 col-xs-offset-2"  >

                            <blockquote>

                              {{  $replyable->user->first_name }} {{  $replyable->user->last_name }}:

                                    <p  class="rtl-text">
                                        <a   href="#a{{$reply->replyable_type}}_{{$replyable->id}}">
                                            {!!   Str::limit ( $replyable->body ,100)      !!}
                                        </a>
                                    </p>

                            </blockquote>


                    </div>

                </div>



                <div class="row">


                    <div class="col-md-11 col-sm-11 col-xs-11" style="text-align: right" id="replybody_{{$reply->id}}" >
                        <h4  class="rtl-text">
                            {!!   nl2br($reply->body)   !!}
                        </h4>

                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-1"></div>


                </div>


                <div class="row">

                    <div class="col-md-12 " style="text-align: right" >
                        @include('partials.reply-btn',['comment_id'=>$comment ,'replyable_id'=>$reply->id,'replyable_type'=>'reply','replyable_user'=>$reply->user_id] )


                    </div>


                </div>

            </div>


        </div>



@endif


