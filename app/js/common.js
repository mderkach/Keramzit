$(function () {

    // Custom JS
    var $hamburger = $(".hamburger");
    $hamburger.on("click", function (e) {
        $hamburger.toggleClass("is-active");
    });
    $('input[name="phone"]').inputmask("+7(999)999-99-99");
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
    $('input[name="position"]').val(); 
    $('[data-popup]').on('click', function () {
        var header = $(this).data('header');
        var position = $(this).data('position');
        $('.header-paste').html(header);
        $('input[name="position"]').val(position);
    });
    ymaps.ready(init);
    function init() {
        // Создание карты.    
        var myMap = new ymaps.Map("map", {
            // Координаты центра карты.
            // Порядок по умолчнию: «широта, долгота».
            // Чтобы не определять координаты центра карты вручную,
            // воспользуйтесь инструментом Определение координат.
            center: [55.76, 37.64],
            // Уровень масштабирования. Допустимые значения:
            // от 0 (весь мир) до 19.
            zoom: 7
        });
    };
});
