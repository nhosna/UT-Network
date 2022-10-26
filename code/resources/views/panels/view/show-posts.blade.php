
<div id="post-container">

    @forelse( $posts as $post)
        @include('panels.view.show-post'   )


    @empty
        <div class="card"  data-offset="0" >


            <div class=" card-header  " style="background-color: white">
            <p style="text-align: center;">
                No posts yet

            </p>

            </div>
        </div>

    @endforelse


    @if(count($posts)>0)
            <div class="text-center">


                {!! $posts->appends(['search'=>Request::input('search')])->links() !!}
            </div>


    @endif
</div>

