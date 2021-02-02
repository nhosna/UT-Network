

{{--@push('styles')--}}
{{--<style>--}}


{{--    .like-thread input[type='radio'] {opacity: 0;position:absolute;width:1px;height:1px;cursor: pointer;}--}}
{{--    .like-thread input[type='radio'] + label {margin:.6em;color: #B1B1B1; text-shadow: 1px 1px #fff;}--}}
{{--    .like-thread input[type='radio']:checked + label{color: #2be001;}--}}
{{--    .like-thread input[type='radio']:hover + label{color: rgba(65, 255, 11, 0.45);}--}}

{{--    .dislike-thread input[type='radio'] {opacity: 0;position:absolute;width:1px;height:1px;cursor: pointer;}--}}
{{--    .dislike-thread input[type='radio'] + label {margin:.6em;color: #B1B1B1; text-shadow: 1px 1px #fff;}--}}
{{--    .dislike-thread input[type='radio']:checked + label{color: #db1717;}--}}
{{--    .dislike-thread input[type='radio']:hover + label{color: #f39696;}--}}


{{--    .icon-thread  li{display: inline-block; margin:0 0 0}--}}
{{--    .icon-thread  ul{border-bottom: 1px dashed transparent;background: transparent;text-align:center}--}}
{{--    /*.fa {*/--}}
{{--    /*    font-size: 25px;*/--}}
{{--    /*    cursor: pointer;*/--}}
{{--    /*    user-select: none;*/--}}
{{--    /*}*/--}}

{{--</style>--}}
{{--@endpush--}}


<div class="icon-thread"  >

    <ul>
        <li  class="like-thread "  >
            <input type="radio" name="opinion" id="like_{{$post_id}}"    value="101"  required {{isset($initval) && $initval=='101'?'checked':''}} >
            <label class="radio  "  for="like_{{$post_id}}"    ><i  style="font-size: 2em;"  class="fa fa-thumbs-up "></i></label>

        </li>


        <li class="dislike-thread ">
            <input type="radio" name="opinion" id="dislike_{{$post_id}}"  value="-1" required {{isset($initval) && $initval=='-1'?'checked':''}} >
            <label class="radio" for="dislike_{{$post_id}}" ><i  style="font-size: 2em;" class="fa fa-thumbs-down"></i></label>

        </li>

    </ul>


</div>

