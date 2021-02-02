
function changePollDisplay(){

    if ( !document.getElementById("poll_radio").checked){
        $('#poll-container').hide();

    }else{
        $('#poll-container').show();
    }

}


$(document).ready(function () {
    changePollDisplay();

})
$("input[name='vote_type']").on('change',function(){
    changePollDisplay();

});
