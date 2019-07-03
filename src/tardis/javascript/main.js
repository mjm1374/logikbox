$(document).ready(function () {
    console.log(tardis.doctorwho());
});


$(document).on("click", ".tardis__logo", function (e) {
    console.log(tardis.doctorwho());
    $('#tardisSnd').get(0).currentTime = 0;
    $('#tardisSnd').get(0).play();
});

$(document).on("click", ".nava",function (e) {
    e.preventDefault();
    let target = $(this).data('target');
    scrollToTop(target);

});

function scrollToTop(elmnt) {
    var item = document.getElementById(elmnt);
    var new_position = $(item).offset();
    new_position.top = new_position.top - 60;

    $('html, body').stop().animate({
        scrollTop: new_position.top 
    }, 500);
}
