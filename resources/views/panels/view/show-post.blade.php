

    <div class="card mt-5   " id="apost_{{$post->id}}" data-offset="0" >


        <div class=" card-header    " style="background-color: white">
            <div class="   row  ">

                <div class="col-md-1 col-sm-2  "  >
                    <a href="{{ url('users/'.$post->user->id) }}" style="        color: #555555;"> @include('partials.user-avatar',[ 'size'=>'sm', 'first_name'=>$post->user->first_name ,'last_name'=>$post->user->last_name])</a>

                </div>


                <div class="col-md-5 col-sm-5"  >

                    <h4 class="card-title">
                        {{ $post->user->first_name }} {{ $post->user->last_name }}   @if(Route::current()->getName()!=='post.show') <small> from <a href="{{route('group.feed',$post->group->id)}} ">  {{is_null($post->group)?'':$post->group->name}}</a></small> @endif
                        {{--                            <small class="text-muted " style="font-style:italic">  created:     {{ $post->created_at!==null? \Morilog\Jalali\Jalalian::fromCarbon( $post->created_at )->format('%A, %d %B %Y, %H:%m') :''  }}({{$post->created_at->diffForHumans()}})</small>--}}
                        <br/>
{{--                        <small class="text-muted " style="font-style:italic">{{$post->created_at->diffForHumans()}}</small>--}}
                        <small class="text-muted " style="font-style:italic">{{'Created:'.Jalalian::fromCarbon( $post->created_at )->format('%A, %d %B %Y, %H:%m')   }} </small>
                        <br/>
                        @if($post->hasExpired()===false)
                            <small class="text-muted " style="font-style:italic">  {{ $post->expires_at!==null? 'Expires:'. Jalalian::fromCarbon( $post->expires_at )->format('%A, %d %B %Y, %H:%m'):''  }}   </small>

                        @else
                            <small class="text-muted " style="font-style:italic">  {{ $post->expires_at!==null? 'Expired:'. Jalalian::fromCarbon( $post->expires_at )->format('%A, %d %B %Y, %H:%m'):''  }}   </small>

                        @endif

                    </h4>



                </div>


                <div class="col-md-4 col-sm-5"  >

                <h4 class=" card-title rtl-text">
                    {{$post->title}}
                </h4>

                </div>

                <div class="col-md-2"  >

                    @can('update',$post)
                        @include('partials.post-options')
                    @endcan

                </div>
            </div>
         </div>


        @if(Route::current()->getName()!=='post.show'   )

        <a class=" text-center" data-toggle="collapse" onclick="removeCollapse(this)" href="#collapse_{{$post->id}}"  aria-expanded="false" aria-controls="collapse_{{$post->id}}">
            More

        </a>


        <div class="collapse" id="collapse_{{$post->id}}">
       @endif
        <div class="card-body"  >

                     <div class="row">
                        <div    class="col-md-8 col-md-offset-2 col-sm-offset-2 col-sm-8 col-xs-offset-2 col-xs-8 "   >
                            <h4 class="rtl-text">
                                {!!   nl2br($post->body)   !!}
                            </h4>

                        </div>
                    </div>

                    @if(count ($post->files)>0)
                    <div class="row mt-5">
                        <div class="col-md-2"></div>

                        <div class=" col-md-8  ">
                            @include('panels.view.show-file ' )
                        </div>
                        <div class="col-md-2"></div>

                    </div>
                    @endif

            @if(Route::current()->getName()==='post.show'   )
                    <div class=" form-row row mt-5  ">


                        <div class="col-2"></div>
                        <div class="col-2 ">
                            <label>Results:</label>
                        </div>
                        <div class="col-6   ">
                            @if($post->vote_type==='like')
                                @include('partials.vote-post-result-like',['votes'=>$post-> voteCount(),'id'=>$post->id])
                            @elseif($post->vote_type==='percent')
                                @include('partials.vote-post-result-percent',['initval'=>$post-> votePercentage() ,'id'=>$post->id ])

                            @elseif($post->vote_type==='poll')
                                @include('partials.vote-post-result-poll',['initval'=>$post-> votePollResult() ,'id'=>$post->id ])

                            @endif


                        </div>


                    </div>




                @if($post->hasExpired()===false)


                    @if( is_null($post->myVote()))
                        @include('panels.form.create-vote')

                    @endif



                @endif


                <div class="row">

                    <div class="col-md-2  " style="text-align: left"  >
                        @include("partials.voters-btn")

                    </div>
                     <div class="col-md-8"    >
                    <span id="comment-box"></span>
                    </div>


                    <div class="col-md-2  " style="text-align: right" >
                        @include('partials.comment-btn')
                    </div>
                </div>


            @else
            <div class=" form-row row mt-5  ">


                <div class="col-2"></div>

                <div class="col-8 text-center  ">

                    <a href="{{ url("/posts/{$post->id}") }}" class="card-link" >See Post</a>

                </div>
                <div class="col-2"></div>
            </div>

            @endif





        </div>

    </div>
      @if(Route::current()->getName()!=='post.show'   )
    </div>
    @endif

<div  id="vote-container" data-id="{{$post->id}}"  >
</div>
@if(Route::current()->getName()==='post.show')

@if(!is_null($post->myVote()))
    @include('panels.view.show-vote',['vote'=>$post->myVote()])

@endif

@include('panels.view.show-comments')

@endif



@push('scripts')

    <script src="{{ asset('js/scripts/show-post.js') }}" type="text/javascript"></script>


@endpush
