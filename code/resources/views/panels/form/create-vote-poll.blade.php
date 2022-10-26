
<div class="list-group">
    @foreach($poll  as $key =>  $item)
        <input type="radio" name="opinion" value="{{$key}}" id="pollitem_{{$key}}" required {{isset($initval) &&  intval($initval)===$key?'checked':''}}  />
        <label class="list-group-item rtl-text" for="pollitem_{{$key}}">{{$item}}</label>

    @endforeach
</div>


