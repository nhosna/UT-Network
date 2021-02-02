function hsl_col_perc(percent, start, end) {
    var a = percent / 100,
        b = (end - start) * a,
        c = b + start;


    return 'hsl(' + c + ', 100%, 65%)';
}

function setPercent(percent,count, progressDiv,progressContainerDiv,textDiv){
    let colour = hsl_col_perc(percent, 0, 120); //Red -> Green
    $(progressDiv).css({'background-color':colour ,'width':percent + '%'})   ;
    $(progressContainerDiv).css({'border-color':colour})   ;

    let d;
    if(count===1){
         d=count+' vote';

    }else{
        d=count+' votes';

    }
    $(textDiv).html( Math.floor(percent)+' % from '+d)   ;


}


