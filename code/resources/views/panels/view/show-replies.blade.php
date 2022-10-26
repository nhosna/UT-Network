

@foreach($replies as $reply)
    @include('panels.view.show-reply',['replyable'=>$reply->replyable()]   )

@endforeach

