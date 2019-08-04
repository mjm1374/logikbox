/*jshint esversion: 6 */ 

let 
rankUp = $('.football__item--up'),
rankDown = $('.football__item--down')
;


$(document).on('click', '.football__item--up, .football__item--down', function(e){
    e.preventDefault();
    let thisClick = $(this).data('dir');
    $('.football_team--' + currentRank).removeClass('football_team--show');
    $('.football_team--' + currentRank).addClass('football_team--hide');

    if (thisClick == 'up'){
        currentRank = currentRank - 1;
        if(currentRank == 0) currentRank =20;
    }
    else{
        currentRank = currentRank + 1;
        if (currentRank == 21) currentRank = 1;
    }

    $('.football_team--' + currentRank).removeClass('football_team--hide');
    $('.football_team--' + currentRank).addClass('football_team--show');

});

$(document).on('touchend', '.football__item--up .football__item--down', function (e) {
    e.preventDefault();
    $(this).click();
});
