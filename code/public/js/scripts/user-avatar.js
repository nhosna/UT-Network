
function setColor(char){
var alphabet = "abcdefghijklmnopqrstuvwxyz";
let pos= alphabet.indexOf(char );

var colors=[
'#ffb7b2',
'#ffdcc4',
'rgba(255,140,69,0.52)',
'rgba(255,183,133,0.82)',
'rgba(189,250,89,0.59)',
'rgba(200,255,123,0.59)',
'#B5EAD7',
'rgba(83,250,189,0.3)',
'rgba(127,153,236,0.37)',
'rgba(207,127,236,0.42)',
'#FFF5BA',
'rgba(255,222,24,0.48)',
'#b6ffbe',
'#FFCCF9',
];

return colors [pos % colors.length];

}


$(document).ready(function (){
    jQuery("div[name='avatar']").each(function() {
    $(this).css({backgroundColor:setColor( $(this).attr('data-value') )});
    });

});

$(document).arrive("div[name='avatar']", function() {
    $(this).css({backgroundColor:setColor( $(this).attr('data-value') )});
});
