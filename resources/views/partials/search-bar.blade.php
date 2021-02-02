
<form id="search_form" >
<div class="  row form-search">

        <div class="col-md-9 col-sm-8 col-xs-8">
            <input type="text" class="form-control"  id="search_input"   name="search"  />
        </div>
        <div class="col-md-3 col-sm-4 col-xs-4">
            <input type="submit"  id="search_btn" value="Search" class="btn btn-block btn-default"/>
        </div>

</div>

</form>

@push('scripts')
<script>


    $('#search_form').on('submit',function(e) {
        e.preventDefault();

        $value = $("#search_input").val();

            $.ajax({
                    url: "{{$route}}",
                    type: 'get',
                    dataType: 'json',
                    data:{'search':$value    },

                    success: function (data) {
                        console.log(data);
                        $('#search-container').html(data.data   );

                    },


                    error: function (xhr) {
                        console.log(xhr.responseText); // this line will save you tons of hours while debugging
                        // do something here because of error
                    }
                }
            );

        });






</script>
@endpush
