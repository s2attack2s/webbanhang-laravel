$(document).ready(function () {
    $(".free-ship").slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: true,
        autoplay:true,
        speed:2500,
        prevArrow: '<i class="bi free-ship-i free-ship-i-left bi-arrow-left-circle"></i>',
        nextArrow: '<i class="bi free-ship-i free-ship-i-right bi-arrow-right-circle"></i>',
        responsive: [
            {
              breakpoint: 769,
              settings: {
                slidesToShow: 3,
              }
            },
            {
                breakpoint: 426,
                settings: {
                  slidesToShow: 1,
                }
              },
        ]
    });
});
