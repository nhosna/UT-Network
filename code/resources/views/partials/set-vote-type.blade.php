



<input
    type="radio" name="vote_type"
    id="like_radio"  value="like" required {{isset($initval) && $initval==='like'?'checked':''}}  />
<label for="like_radio">
    {{--    <i class="fa fa-thumbs-up"> </i>--}}
    {{--    +--}}
    {{--    <i class="fa fa-thumbs-down"></i>--}}

    Like/Dislike
</label>

<input
    type="radio" name="vote_type"
    id="percent_radio" value="percent"  required {{ isset($initval) && $initval==='percent'?'checked':''}}/>
<label for="percent_radio">
    Percentage
    {{--    <i class="fa fa-percentage"></i>--}}
</label>


<input
    type="radio" name="vote_type"
    id="poll_radio" value="poll"  required {{ isset($initval) && $initval==='poll'?'checked':''}}  />
<label for="poll_radio">
    Poll
    {{--    <i class="fa fa-percentage"></i>--}}
</label>



