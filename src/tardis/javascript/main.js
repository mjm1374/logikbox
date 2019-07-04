$(document).ready(function () {
    console.log(tardis.doctorwho());
});


$(document).on("click", ".tardis__logo", function (e) {
    
    $('#tardis__logo').css('opacity',0);
    $('#tardisSnd').get(0).currentTime = 0;
    $('#tardisSnd').get(0).play();

    $("#tardis__logo").animate({
        opacity: 0.4,
    }, 2000, function () {
        $("#tardis__logo").animate({
            opacity: 0.20,
            easing: 'swing'
        }, 2000, function () {
            $("#tardis__logo").animate({
                opacity: 0.65,
                easing: 'swing'
            }, 2000, function () {
                $("#tardis__logo").animate({
                    opacity: 0.35,
                    easing: 'swing'
                }, 2000, function () {
                    $("#tardis__logo").animate({
                        opacity: 1,
                        easing: 'swing'
                    }, 2000, function () {
                        console.log(tardis.doctorwho());
                    });
                });
            });
        });
    });
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
