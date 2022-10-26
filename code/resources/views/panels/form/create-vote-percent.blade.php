

<div class="d-flex justify-content-center my-4">
    <div class="w-75"  style="width:100%">
        <label for="range_{{$post_id}}"> <input  type="range"  name="opinion"  min="0" max="100" value="50" class="custom-range" id="range_{{$post_id}}"   > </label>
    </div>
    <span class="font-weight-bold text-primary ml-2 valueSpan2  " id="value_{{$post_id}}"   ></span>


</div>


<script>

    var slider = document.getElementById("range_{{$post_id}}");
    var output = document.getElementById("value_{{$post_id}}");

    @if(isset($initval))
    slider.value={{$initval}} ;

    @endif


    output.innerHTML = slider.value;

    slider.oninput = function() {
        output.innerHTML = this.value;

    }


</script>



