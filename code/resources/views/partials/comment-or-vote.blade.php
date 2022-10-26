<label>
    comment
    <input type="radio" name="commentorvote" id="comment_{{$post->id}}" onchange="disableVote(this,{{$post->id}})">
</label>
<label>
    vote
    <input type="radio"  name="commentorvote" id="vote_{{$post->id}}" onchange="enableVote(this,{{$post->id}})"  checked>
</label>


