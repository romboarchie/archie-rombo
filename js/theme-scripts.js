jQuery(document).ready(function ($) {
    "use strict";

    // Back to Top Button Logic
    var $backToTop = $('#back-to-top');

    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $backToTop.fadeIn();
        } else {
            $backToTop.fadeOut();
        }
    });

    $backToTop.click(function () {
        $('html, body').animate({ scrollTop: 0 }, 800);
        return false;
    });

    // Sticky Header Class Toggling
    var $navbar = $('.site-main-nav');
    var navOffset = $navbar.offset().top;

    $(window).scroll(function () {
        if ($(window).scrollTop() > navOffset) {
            $navbar.addClass('is-sticky');
        } else {
            $navbar.removeClass('is-sticky');
        }
    });
});
