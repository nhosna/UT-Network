{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>--}}

<div class="alert alert-warning" id="pollalert" style="display: none"></div>

<div class="input-group  row">
    <input id="userinput" type="text" class="form-control rtl-text " placeholder="Add an item..." aria-label="Add an item" aria-describedby="basic-addon2">
    <div class="input-group-append">
        <button class="btn btn-primary" id="addpollitem" type="button">Add</button>
    </div>
</div>


<div class=" input-group row">

    <ul class="list-group col-12" id="poll-ul">
    </ul>
</div>


<span  id="formControl"></span>

@isset($initval)

<script>


    $(document).ready(function () {


        @foreach($initval as $v)

        var li = "<li class='list-group-item rtl-text' data-value='{{$v}}'> {{$v}}  <i  class='fa fa-remove pull-right '    style='cursor:pointer'  onclick='deleteItem(this)'> </i> </li>"
        $('#poll-ul').append(li);
        liArr.push("{{$v}}");

         @endforeach

    });


</script>

@endisset

@push('scripts')
    <script src="{{ asset('js/scripts/create-poll.js') }}" type="text/javascript"></script>

@endpush
