$(function () {

    // Custom JS
    var url = document.location.toString();
    if (url.match('#')) {
        $('.nav-link[href="#' + url.split('#')[1] + '"]').tab('show');
        setTimeout(function () {
            $(window).scrollTop(0);
        }, 200);
    }
    var $hamburger = $(".hamburger");
    $hamburger.on("click", function (e) {
        $hamburger.toggleClass("is-active");
    });
    $('input[name="phone"]').inputmask("+7(999)999-99-99");
    $('.sticky').scrollToFixed({
        top: 100,
        limit: $('.sticky').offset().bottom
    });
    $('.sticky-anchor').click(function () {
        var sectionTo = $(this).attr('href');
        if ($(this).attr("id") == "anchor-price") {
            $('html, body').animate({
                scrollTop: $(sectionTo).offset().top
            }, 1500);
        } else if ($(this).attr("id") == "anchor-contacts") {
            $('html, body').animate({
                scrollTop: $(sectionTo).offset().top - 100
            }, 1500);
        } else {
            $('html, body').animate({
                scrollTop: $(sectionTo).offset().top - 30
            }, 1500);
        }
    });
    $('.slider-wrapper').slick({
        infinite: true,
        lazyLoad: 'ondemand',
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        prevArrow: '<div class="slick-prev"></div>',
        nextArrow: '<div class="slick-next"></div>',
        responsive: [
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
    },

  ]
    });
    $('.slider-cert_wrapper').slick({
        infinite: true,
        lazyLoad: 'ondemand',
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 3000,
        prevArrow: '<div class="slick-prev"></div>',
        nextArrow: '<div class="slick-next"></div>',
        responsive: [
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
    },

  ]
    });
    $('[data-fancybox]').fancybox({
        modal: false,
        buttons: ["close"],
        hideScrollbar: true,
        openEffect: 'none',
        closeEffect: 'none',
    });
    $('[data-fancybox="privacy"]').fancybox({
        src: "#privacy",
        touch: false
    });
    //popup data placement
    $('.header-paste').html();
    $('.popup-subhead').html();
    $('input[name="position"]').val();
    $('input[type="submit"]').val();
    $('input[name="package"]').val();
    $('[data-popup]').on('click', function () {
        var header = $(this).data('header');
        var position = $(this).data('position');
        var submit = $(this).data('submit');
        var subhead = $(this).data('subhead');
        var package = $(this).data('package');
        $('.header-paste').html(header);
        $('.popup-subhead').html(subhead);
        $('input[name="position"]').val(position);
        $('input[type="submit"]').val(submit);
        $('input[name="package"]').val(package);
    });
    if (window.matchMedia('(min-width: 576px)').matches) {
        ymaps.ready(init);
        function init() {
            // Создание карты.    
            var myMap = new ymaps.Map("map", {
                center: [55.72930263518857, 37.87428686245723],
                zoom: 16
            });
            var place = new ymaps.Placemark([55.7306830037432,37.86919066532892]);
            var route = new ymaps.Polyline([
                [55.726825, 37.859385],
                [55.726795, 37.859588],
                [55.726785, 37.860994],
                [55.726662, 37.865799],
                [55.729490, 37.866034],
                [55.729460048113765,37.867431136215174],
                [55.73068603081336,37.867527695739696],
                [55.73065576010114,37.8690780125503]
            ]);
            myMap.geoObjects.add(place);
            myMap.geoObjects.add(route);
            myMap.behaviors.disable('scrollZoom');
        };
    };


});
