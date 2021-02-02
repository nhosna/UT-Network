
var liArr = [];


var button = document.getElementById("enter");
var input = document.getElementById("userinput");
var ul = document.querySelector("ul");



function deleteItem(self){
    console.log(liArr);

    let value=$(self).parent().data('value');
    let  index = liArr.indexOf(value);
    delete liArr[index];



    $(self).parent().remove();

}


$('#addpollitem').on("click", function () {

    var value = input.value;


    if(value!=='' && liArr.indexOf(value)===-1){
        var li = "<li class='list-group-item rtl-text' data-value="+value+">" +value+ "<i  class='fa fa-remove pull-right'    style='cursor:pointer'  onclick='deleteItem(this)'> </i> </li>"
        $('ul').append(li);
        liArr.push(value);
    }

    $('#userinput').val('');



});

$("#post-create").on('submit',function (e) {
    e.preventDefault();



    if( document.getElementById("poll_radio").checked){
        if(validatePollItemsCount()){
            return ;
        }

        liArr.forEach(function (value,index,arr){
            $("#formControl").append(" <input type='hidden' name='pollitem[]' value='"+value+"'   />");

        });

    }

    $(this).unbind().submit();

})

function validatePollItemsCount(){

    let count=0;

    liArr.forEach(function (value,index,arr){
        if(value!==null){
            count++;
        }
    });

    if(count<2) {
        $message = $('#pollalert');
        $message.css('display', 'block');
        $message.html('There must be at least two items inside the poll.');

        return true;

    }
    return false;


}


