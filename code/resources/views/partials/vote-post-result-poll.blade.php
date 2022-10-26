@if($initval[1]==0)
    No one has voted yet
@else
    <ul class="list-group">


        @foreach($initval[0] as $key =>  $percent)
                <li class="list-group-item  ">
                    <div class="row">

                        <div class="col-12">
                            <p class="rtl-text">
                                {{$post->poll()[$key]}}

                            </p>

                        </div>
                    </div>

                    <div class="row">


                        <div class="col-12" style="width: 100%">
                            <div class="progress">

                                <div class="progress-bar  " id="progress" role="progressbar" style="width: {{$percent}}%; background-color: #4e555b"  aria-valuenow="{{$percent}}" aria-valuemin="0" aria-valuemax="100"> {{$percent}}% </div>

                            </div>
                        </div>

                    </div>


                </li>

        @endforeach
    </ul>

@endif
