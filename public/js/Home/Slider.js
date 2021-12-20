$(document).ready(function () {
    $(".slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
  autoplaySpeed: 3000,
        arrows: true,
        fade: true,
        prevArrow: '<i class="bi slider-i slider-i-left bi-arrow-left-circle"></i>',
        nextArrow: '<i class="bi slider-i slider-i-right bi-arrow-right-circle"></i>'
 
    });
});
