/* -----------------------------------------------------------------------------



File:           JS Core
Version:        1.0
Last change:    00/00/00 
-------------------------------------------------------------------------------- */
(function ($) {

    "use strict";

    var Moda = {
        init: function () {
            this.Basic.init();
        },

        Basic: {
            init: function () {
                this.Global();
                this.Animation();
                this.navbarFixed();
                this.MobileMenu();
                this.searchModal();
                this.cartModal();
                this.MenuSearcher();
                this.loadMore();
                this.preloader();
                this.rangeSlider();
                this.scrollToTop();
                this.inputStyle();
            },
            Animation: function () {
                var wow = new WOW(
                    {
                        boxClass: 'wow',
                        animateClass: 'animated',
                        offset: 0,
                        mobile: true,
                        live: true,
                        callback: function (box) {
                        },
                        scrollContainer: null,
                    },
                );
                wow.init();
            },

            inputStyle: function () {
                let formControl = document.querySelectorAll('.moda-user-dashboard .input-text');
                let p = document.querySelectorAll('.moda-user-dashboard p');
                let n = document.querySelectorAll('.moda-user-dashboard .nice-select');

                $("#moda-currency-switcher").change(function () {
                    var site = $(this).data("site");
                    var val = $(this).val();
                    window.location.href = site + "?wmc-currency=" + val;

                });

                for (let i = 0; i < formControl.length; i++) {
                    formControl[i].className += "form-control";
                    formControl[i].style.marginBottom = "15px";
                }

                for (let i = 0; i < n.length; i++) {
                    n[i].style.marginBottom = "15px";
                }

                for (let i = 0; i < p.length; i++) {
                    p[i].style.marginBottom = "0px";
                }
            },

            rangeSlider: function () {
                $(function () {
                    $(".a").slider({
                        range: true,
                        min: 0,
                        max: 500,
                        values: [75, 300],
                        slide: function (event, ui) {
                            $(".b").text("$" + ui.values[0] + " - $" + ui.values[1]);
                        }
                    });
                    $(".b").text("$" + $(".a").slider("values", 0) +
                        " - $" + $(".a").slider("values", 1));
                });
            },
            //* Navbar Fixed  
            Global: function () {
                $('[data-background]').each(function () {
                    $(this).css('background-image', 'url(' + $(this).attr('data-background') + ')');
                });
                $(window).on('load', function () {
                    $("select").niceSelect();
                    $('input[type="number"]').niceNumber();
                });
                if ($('.moda-edit-address').length) {
                    $('.woocommerce-input-wrapper').addClass('input-group');
                }
            },
            //* Navbar Fixed
            navbarFixed: function () {
                if ($('.header-section').length) {
                    $(window).on('scroll', function () {
                        var scroll = $(window).scrollTop();
                        if (scroll >= 120) {
                            $(".moda-default-header").addClass("navbar_fixed");
                        } else {
                            $(".moda-default-header").removeClass("navbar_fixed");
                        }
                    });
                }
                ;
            },

            // mobile menu 
            MobileMenu: function () {
                $('.open-nav, .header-categories-btn').click(function () {
                    $('body').addClass('nav_activee');
                });
                $('.nav_close, .overlaly').click(function () {
                    $('body').removeClass('nav_activee');
                });

                if ($('.mobile-menu li.dropdown ul').length) {
                    $('.mobile-menu li.dropdown').append('<div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>');
                    $('.mobile-menu li.dropdown .dropdown-btn').on('click', function () {
                        $(this).prev('ul').slideToggle(500);
                    });
                }
                ;
            },

            // search modal js
            searchModal: function () {
                $('.open-nav').click(function () {
                    $('body').addClass('right-side-nav-activee');
                });
                $('.nav-close-btn, .nav_close, .right-overlaly, .overlaly').click(function () {

                    $('body').removeClass('right-side-nav-activee');
                });
            },

            // cart modal js 
            cartModal: function () {
                $('.moda-cart-open').click(function (event) {
                    event.preventDefault();
                    $('body').addClass('moda-cart-activee');
                });
                $('.cart-overlay, .cart-close').click(function (event) {
                    event.preventDefault();
                    $('body').removeClass('moda-cart-activee');
                });
            },

            //  Menu inner search
            MenuSearcher: function () {
                $(".searchbtn").click(function (event) {
                    event.preventDefault();
                    $(".search-close").click(function () {
                        $(".wrapper").removeClass("search-area");
                        $(".searchbtn").removeClass("bg-green");
                    });
                    $(this).toggleClass("bg-green");
                    $(".fas").toggleClass("color-white");
                    $(".wrapper").toggleClass("search-area");
                    $(".input").focus().toggleClass("active-width").val('');
                });
            },

            // Load more js 
            loadMore: function () {
                // swiper slider
                var swiper1 = new Swiper(".mySwiper", {
                    loop: true,
                    spaceBetween: 16,
                    slidesPerView: 4,
                    freeMode: true,
                    watchSlidesVisibility: true,
                    watchSlidesProgress: true,
                });
                var swiper2 = new Swiper(".mySwiper2", {
                    loop: true,
                    spaceBetween: 0,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    thumbs: {
                        swiper: swiper1,
                    },
                });
                var swiper3 = new Swiper(".product-slide", {
                    loop: true,
                    spaceBetween: 0,
                    slidesPerView: 1,
                    speed: 1000,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                });
                var swiper4 = new Swiper(" .moda-related-product-wraper", {
                    loop: true,
                    spaceBetween: 30,
                    slidesPerView: 4,
                    speed: 1000,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    breakpoints: {
                        1024: {
                            slidesPerView: 4,
                            spaceBetween: 30
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 30
                        },
                        640: {
                            slidesPerView: 2,
                            spaceBetween: 20
                        },
                        100: {
                            slidesPerView: 2,
                            spaceBetween: 10
                        },
                    }
                });
            },

            // Preloader JS
            preloader: function () {
                if ($('.preloader').length) {
                    $(window).on('load', function () {
                        $('.preloader').fadeOut();
                        $('.preloader').delay(50).fadeOut('slow');
                    });
                }
                ;
            },

            // Scroll to top
            scrollToTop: function () {
                if ($('.scroll-top').length) {
                    $(window).on('scroll', function () {
                        if ($(this).scrollTop() > 200) {
                            $('.scroll-top').fadeIn();
                        } else {
                            $('.scroll-top').fadeOut();
                        }
                    });
                    //Click event to scroll to top
                    $('.scroll-top').on('click', function () {
                        $('html, body').animate({
                            scrollTop: 0
                        }, 200);
                        return false;
                    });
                }
                ;
            },

        }
    };
    jQuery(document).ready(function () {
        Moda.init();

    });
    console.log('unit js loaded');
})(jQuery);

