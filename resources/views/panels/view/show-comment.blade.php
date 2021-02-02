<div class="row ">

    <div class="col-md-12   col-sm-12  "  >

        <div class="card  mr-5 mt-5" id="acomment_{{$comment->id}}" data-offset="0" style="background-color: rgba(236,236,236,0.32)"  >

            <div class="card-body"  >
                <div class="row ">



                    <div class="col-md-1 col-sm-2  col-xs-3"  >
                        <a href="{{ url('users/'.$comment->user->id) }}" style="        color: #555555;">  @include('partials.user-avatar',['size'=>'sm','first_name'=>$comment->user->first_name ,'last_name'=>$comment->user->last_name])
                        </a>
                    </div>


                    <div class="col-md-9 col-sm-8 col-xs-7     "  >
                        <h4 class="card-title">   {{ $comment->user->first_name  }} {{ $comment->user->last_name  }}
{{--                            <p class="card-text "><small class="text-muted " style="font-style:italic">{{ $comment->updated_at->diffForHumans() }}</small></p>--}}
                            <p class="card-text "><small class="text-muted " style="font-style:italic">{{Jalalian::fromCarbon( $comment->updated_at)->format('%A, %d %B %Y, %H:%m')   }} </small></p>

                        </h4>

                    </div>

                    <div class="col-md-2  col-sm-2  col-xs-2"  >

                        @if($comment->user->id===auth()->user()->id)
                            @include('partials.comment-options')
                        @endif
                    </div>
                </div>

                <div class="row">



                    <div class="col-md-11 col-sm-11 col-xs-11"  style="text-align: right" >
                        <div    id="commentbody_{{$comment->id}}" >
                            <h4 class="rtl-text" >
                                {!!   nl2br($comment->body)   !!}
                            </h4>

                        </div>

                    </div>

                    <div class="col-md-1 col-sm-1 col-xs-1"></div>



                </div>
                <div class="row">

                    <div class="col-md-12 " style="text-align: right" >
                        @include('partials.reply-btn',['comment_id'=>$comment->id,'replyable_id'=>$comment->id,'replyable_type'=>'comment', 'replyable_user'=>$comment->user_id] )
                    </div>


                </div>



            </div>


        </div>




        </div>

    </div>



<div class="row">

     <div class="col-md-11 col-md-offset-1 col-sm-11 col-sm-offset-1 col-xs-11 col-xs-offset-1 ">
         <div id="reply-container" data-id="{{$comment->id}}"></div>


         @include('partials.more-replies',[ 'comment'=> $comment->id,'hidden'=>count($comment->replies)>0?false:true ])

     </div>
 </div>







