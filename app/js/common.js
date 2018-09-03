$(function () {

    // Custom JS
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
        if (window.matchMedia('(max-width: 480px)').matches) {
            $('html, body').animate({
                scrollTop: $(sectionTo).offset().top - 75
            }, 1500);
        } else {
            $('html, body').animate({
                scrollTop: $(sectionTo).offset().top + 1//srcoll to elemement with 120px offset on top (sticky header height)
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
        responsive: [
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                }
    },

  ]
    });
    $('[data-fancybox]').fancybox({
        modal: false,
        buttons: ["close"],
        hideScrollbar: true,
        openEffect  : 'none',
        closeEffect : 'none'
    });
     //popup data placement
    $('.header-paste').html();
    $('.popup-subhead').html();
    $('input[name="position"]').val(); 
    $('input[type="submit"]').val(); 
    $('[data-popup]').on('click', function () {
        var header = $(this).data('header');
        var position = $(this).data('position');
        var submit = $(this).data('submit');
        var subhead = $(this).data('subhead');
        $('.header-paste').html(header);
        $('.popup-subhead').html(subhead);
        $('input[name="position"]').val(position);
        $('input[type="submit"]').val(submit);
    });
    ymaps.ready(init);
    function init() {
        // Создание карты.    
        var myMap = new ymaps.Map("map", {
            center: [55.72930263518857,37.87428686245723],
            zoom: 16
        });
        var myPlacemark = new ymaps.Placemark([55.729072568997516,37.871175499999964]);
        myMap.geoObjects.add(myPlacemark);
        myMap.behaviors.disable('scrollZoom');
    };
});
