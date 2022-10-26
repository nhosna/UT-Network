<div class="dropdown show pull-right">
    <button class="btn btn-secondary dropdown-toggle" style="  color: black;background-color: transparent; border-color: transparent;" href="#" role="button" id="commentoptions_{{$comment->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
    <div class="dropdown-menu" aria-labelledby= "commentoptions_{{$comment->id}}">
        <a class="dropdown-item" onclick="makeCommentEditable(this,'{{$comment->body}}',{{$comment->id}},'comment')" href="#" >Edit</a>
        <a class="dropdown-item" href="{{ url("/comments/$comment->id") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" >Delete</a>
    </div>
</div>
