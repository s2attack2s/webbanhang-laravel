$(document).ready(function () {
    $(".product-tabs7").slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<i class="bi index-i index-i-left bi-arrow-left-circle"></i>',
        nextArrow: '<i class="bi index-i index-i-right bi-arrow-right-circle"></i>',
        responsive: [
            {
              breakpoint: 769,
              settings: {
                slidesToShow: 2,
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
    $(".product-hot").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<i class="bi index-i index-i-left bi-arrow-left-circle"></i>',
        nextArrow: '<i class="bi index-i index-i-right bi-arrow-right-circle"></i>',
        responsive: [
            {
              breakpoint: 769,
              settings: {
                slidesToShow: 2,
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
