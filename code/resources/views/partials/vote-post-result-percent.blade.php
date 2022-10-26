

@if($initval[1]==0)

    No one has voted yet

@else

 <figure style="text-align: center;width: 80%">
    <div   id="progress-container"   data-value="{{$id}}"   style="width: 100%; " >
        <div id="progress" data-value="{{$id}}"></div>
    </div>
    <h4 id="progress-text" style=" font-size: 16px" data-value="{{$id}}" ></h4>

</figure>


<script src="{{ asset('js/scripts/show-percent.js') }}"></script>


<script>

    $(document).ready(function () {


        let percent = {{$initval[0]}};
        let count={{$initval[1]}};

        let progressDiv=$("#progress[data-value='{{$id}}']");
        let textDiv=$("#progress-text[data-value='{{$id}}']");
        let progressContainerDiv=$("#progress-container[data-value='{{$id}}']");

        setPercent(percent,count, progressDiv,progressContainerDiv,textDiv);

    });


</script>

@endif
