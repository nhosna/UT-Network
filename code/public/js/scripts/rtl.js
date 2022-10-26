$(".rtl-text").on('input',    function() {

    var el  = $(this);
    var len = el.val().length;

    //if (len <= 1){
    var x = /^[-!$%^&*()_+|~=`{}\[\]:\";'<>?,.\/]*[A-Za-z]/; // is ascii
    var isAscii = x.test(el.val());

    if(isAscii){
        el.css("direction", "ltr");
    } else {
        el.css("direction", "rtl");
    }


});

