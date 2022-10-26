
$(document).ready(function(){


    var status={};

    $('input[type="checkbox"]').on('change', function() {
        // console.log('check');

        $checked=$(this).prop('checked');
        $name=$(this).attr('name');

        if($checked===true){

            if($name==='admins[]'){
                status[$(this).val( )]=1;

            }else if($name==='members[]'){
                status[$(this).val( )]=0;
            }
        }
        else if($checked===false){
            status[$(this).val( )]=null;
        }


        $('input[value="' + this.value + '"]')
            . not(this).prop('checked', false);

    });


    function sendMembers(  ){

        $form=$("form[name='edit-member']");
        $group=$form.attr('data-value');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        return $.ajax({
                url: '/groups/'+$group+'/edit',
                type: 'GET',
                dataType: 'json',
                data: { 'status':status   },
                success: function (data) {

                    console.log(data);

                },


                error: function (xhr) {
                    console.log(xhr.responseText);

                }
            }
        );




    }
    // var isDone = false;
    $(".page-link").on('click',function(e){


        e.preventDefault();

        var href = $(this).attr('href');
        let request=sendMembers( false);


        request.done(function () {

            window.location.href = href;


        })






    });

    $("form[name='edit-member']").on('submit',function (e) {
        e.preventDefault();

        let request=  sendMembers ( );
        $t=$(this);

        request.done(function () {

            $t.unbind().submit();

        })


    })


});
