$(document).ready(function () {
    console.log(tardis.doctorwho());
    
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
    console.log("new_position",new_position);

    $('html, body').stop().animate({
        scrollTop: new_position.top 
    }, 500);

    //item.scrollIntoView(true); // Top
}
