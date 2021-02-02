<div class="dropdown show pull-right">
    <button class="btn btn-secondary dropdown-toggle" style="  color: black;background-color: transparent; border-color: transparent;" href="#" role="button" id="replyoptions_{{$reply->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
    <div class="dropdown-menu" aria-labelledby="replyoptions_{{$reply->id}}">
        <a class="dropdown-item" onclick="makeCommentEditable(this,'{{$reply->body}}',{{$reply->id}},'reply')" href="#" >Edit</a>
        {!! Form::open(['method'=>'delete','url'=> "/replies/$reply->id",'data-confirm'=> "Are you sure?"]) !!}
        <input type="submit"   value="Delete"  class = "dropdown-item" >
        {!! Form::close() !!}

    </div>
</div>
