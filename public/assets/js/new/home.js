$(document).ready(function () {
    $('.carousel').slick({
        speed: 500,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        adaptiveHeight: false,
        dots: false,
        arrows: true,
        centerMode: true,
        centerPadding: "0px",
        responsive: [{
            breakpoint: 1025,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                // centerMode: true,

            }

        }, {
            breakpoint: 800,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: false,
                infinite: true,

            }
        }, {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: false,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 2000,
            }
        }]
    });
});