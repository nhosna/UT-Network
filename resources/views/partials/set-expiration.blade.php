


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>


<link rel="stylesheet" href="{{ asset('css/datetimepicker.style.css') }}" />




<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text  "  style=" cursor: pointer;" id="date">
            <span class="fa fa-calendar"></span>
            +
            <span class="fa fa-clock-o"></span>
        </span>
    </div>

    <input type="text" id="inputDate" class="form-control" placeholder="Pick date and time" aria-label="date"
           aria-describedby="date" name="datetime" value="{{isset($initval)?\App\Facades\Morilog\Jalalian::fromCarbon( $initval )->format('Y/m/d H:i:s'):'' }}" required>




</div>

<script src="{{ asset('js/datetimepicker_custom.js') }}" type="text/javascript"></script>

<script type="text/javascript">

    {{ logger('Test') }}

    $('#date').MdPersianDateTimePicker({
        targetTextSelector: '#inputDate',
        // targetTextSelector: '#inputHidden',

        isGregorian: false,

        dateFormat: 'yyyy-MM-dd hh:mm:ss',
        enableTimePicker: true,
        disableBeforeToday: true,
        calendarViewOnChange: function (date) {
            console.log(date);




        }
    });





</script>



