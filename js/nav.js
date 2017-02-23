$(document).ready(function() {
    $(window).scroll(function() {

    if ($(window).scrollTop() > 200) {
        $('.nav').addClass('sticky');
    } else {
        $('.nav').removeClass('sticky');
    }
    });

    $('.mobile-toggle').click(function() {
    if ($('.nav').hasClass('show')) {
        $('.nav').removeClass('show');
    } else {
        $('.nav').addClass('show');
    }
    });
   
    

}); 
    


