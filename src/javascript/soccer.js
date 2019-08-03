/*jshint esversion: 6 */ 

let currentRank = 1,
rankUp = $('.football__item--up'),
rankDown = $('.football__item--down')
;


$(document).on('click', '.football__item--up, .football__item--down', function(e){
    //e.preventDefault();
    let thisClick = $(this).data('dir');
    $('.football_teams').removeClass('football_team--show');
    $('.football_teams').addClass('football_team--hide');
    if (thisClick == 'up'){
        console.log('clicked up', $(this));
        currentRank = currentRank - 1;
        if(currentRank == 0) currentRank =20;
    }
    else{
        console.log('clicked down', $(this));
        currentRank = currentRank + 1;
        if (currentRank == 21) currentRank = 1;
    }
    console.log('currentRank ', currentRank);
    $('.football_team--' + currentRank).addClass('football_team--show');

});