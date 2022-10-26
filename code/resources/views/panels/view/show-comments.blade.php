




<div class="form-row row">


    <div class="col-md-12">

        <div  class="panel panel-default   mt-5">
            <div  class="panel-heading">
                Comments
            </div>

            @isset($comments)
            <div id="comment-container" class='panel-body' data-id="{{$post->id}}">

                @forelse( $comments   as $comment)
                    @include('panels.view.show-comment')
                @empty
                        <p id="zero-comments">
                            No comments yet
                        </p>
                @endforelse

                <div class="text-center">

                    {{$comments->links()}}

                </div>


            </div>



           @endisset

        </div>
    </div>


</div>




