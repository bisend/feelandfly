'use strict';

$(window).load(function ()
{
    //Custom Scroll Style
    if ($(window).width() < 767) {
        if ($(".header-wrap").length > 0) {
            $(".navigation").mCustomScrollbar({
                theme: "dark-2",
                scrollButtons: {
                    enable: false
                }
            });
        }
        if ($(".cate-wrap").length > 0) {
            $(".cate-wrap > nav").mCustomScrollbar({
                theme: "dark-2",
                scrollButtons: {
                    enable: false
                }
            });
        }
        if ($(".product-table").length > 0) {
            $(".product-table").mCustomScrollbar({
                theme: "dark-2",
                axis: "x",
                scrollButtons: {
                    enable: false
                }
            });
        }
    }
});

$(document).ready(function ()
{
    /*------------------- Menu JS Starts  -------------------*/
    if ($('.wrapper > header').length > 0) {

        // Submenu Position Change on window size
        if ($(window).width() > 767) {
            $("ul.primary-navbar li li").mouseover(function () {
                if ($(this).children('ul').length == 1) {
                    var parent = $(this);
                    var child_menu = $(this).children('ul');
                    if ($(parent).offset().left + $(parent).width() + $(child_menu).width() > $(window).width()) {
                        $(child_menu).css('left', '-' + $(parent).width() + 'px');
                    } else {
                        $(child_menu).css('left', $(parent).width() + 'px');
                    }
                }
            });
        }


        if ($(window).width() < 767) {
            /*------------------- Header Offcanvas Add  -------------------*/
            $(".nav-trigger").on("click", function (e) {
                e.stopPropagation();
                $(".header-wrap .navigation").toggleClass("off-canvas");
                return false;
            });

            /*------------------- Category Menu -------------------*/
            $('.cate-toggle').on('click', function () {
                $('.cate-wrap').slideToggle();
                return false;
            });
        }

        // $(".mega-dropdown-slider").owlCarousel({
        //     dots: false,
        //     loop: true,
        //     autoplay: false,
        //     autoplayHoverPause: true,
        //     smartSpeed: 100,
        //     nav: true,
        //     margin: 30,
        //     responsive: {
        //         0: {items: 1},
        //         1200: {items: 2},
        //         992: {items: 2},
        //         768: {items: 2},
        //         568: {items: 2}
        //     },
        //     navText: [
        //         "<i class='fa fa-angle-left'></i>",
        //         "<i class='fa fa-angle-right'></i>"
        //     ]
        // });


    }
    /*------------------- Menu JS Ends  -------------------*/


// owlCarousel Slider //


    /*------------------- Product Slider -------------------*/
    // if ($('#prod-slider-1, #prod-slider-2').length > 0) {
    //     $("#prod-slider-1, #prod-slider-2").owlCarousel({
    //         dots: false,
    //         loop: false,
    //         autoplay: false,
    //         autoplayHoverPause: true,
    //         smartSpeed: 100,
    //         nav: true,
    //         margin: 30,
    //         responsive: {
    //             0: {items: 1},
    //             1201: {items: 2},
    //             768: {items: 1},
    //             568: {items: 2}
    //         },
    //         navText: [
    //             "<i class='fa fa-angle-left'></i>",
    //             "<i class='fa fa-angle-right'></i>"
    //         ]
    //     });
    // }

    /*------------------- Product  Slider -------------------*/
    // if ($('#deal-slider, #prod-featured-slider').length > 0) {
    //     $("#deal-slider, #prod-featured-slider").owlCarousel({
    //         dots: false,
    //         //loop: true,
    //         autoplay: true,
    //         autoplayHoverPause: true,
    //         smartSpeed: 100,
    //         nav: true,
    //         margin: 30,
    //         responsive: {
    //             0: {items: 1},
    //             1201: {items: 4},
    //             1024: {items: 3},
    //             768: {items: 2},
    //             568: {items: 2}
    //         },
    //         navText: [
    //             "<i class='fa fa-angle-left'></i>",
    //             "<i class='fa fa-angle-right'></i>"
    //         ]
    //     });
    // }

    /*------------------- Testimonial Slider -------------------*/
    // if ($('#testimonial-1').length > 0) {
    //     $("#testimonial-1").owlCarousel({
    //         dots: true,
    //         loop: true,
    //         autoplay: false,
    //         autoplayHoverPause: true,
    //         smartSpeed: 100,
    //         nav: false,
    //         margin: 30,
    //         responsive: {
    //             0: {items: 1}
    //         }
    //     });
    // }

    /*------------------- Brand Slider -------------------*/
    // if ($('#brand-slider').length > 0) {
    //     $("#brand-slider").owlCarousel({
    //         dots: true,
    //         loop: true,
    //         autoplay: true,
    //         autoplayHoverPause: true,
    //         smartSpeed: 100,
    //         nav: false,
    //         margin: 30,
    //         responsive: {
    //             0: {items: 1},
    //             1200: {items: 6},
    //             992: {items: 5},
    //             480: {items: 3}
    //         }
    //     });
    // }

    /*------------------- Blog Slider -------------------*/
    // if ($('#blog-slider-1').length > 0) {
    //     $("#blog-slider-1").owlCarousel({
    //         dots: true,
    //         loop: true,
    //         autoplay: true,
    //         autoplayHoverPause: true,
    //         smartSpeed: 100,
    //         nav: true,
    //         margin: 30,
    //         responsive: {
    //             0: {items: 1},
    //             1200: {items: 3},
    //             992: {items: 2},
    //             568: {items: 2}
    //         },
    //         navText: [
    //             "<i class='fa fa-angle-left'></i>",
    //             "<i class='fa fa-angle-right'></i>"
    //         ]
    //     });
    // }

    /*------------------- Realated Blog Slider -------------------*/
    // if ($('#rel-blog-slider').length > 0) {
    //     $("#rel-blog-slider").owlCarousel({
    //         dots: true,
    //         loop: true,
    //         autoplay: false,
    //         autoplayHoverPause: true,
    //         smartSpeed: 100,
    //         nav: false,
    //         margin: 30,
    //         responsive: {
    //             0: {items: 1},
    //             1024: {items: 2},
    //             768: {items: 1},
    //             568: {items: 2}
    //         }
    //     });
    // }

    /*------------------- Brand Slider -------------------*/
    // if ($('#brand-slider-2').length > 0) {
    //     $("#brand-slider-2").owlCarousel({
    //         dots: false,
    //         loop: true,
    //         autoplay: true,
    //         autoplayHoverPause: true,
    //         smartSpeed: 100,
    //         nav: false,
    //         margin: 30,
    //         responsive: {
    //             0: {items: 1},
    //             992: {items: 5},
    //             768: {items: 4},
    //             568: {items: 3},
    //             380: {items: 2}
    //         }
    //     });
    // }

    /*------------------- Related Product Slider -------------------*/
    // if ($('#rel-prod-slider').length > 0) {
    //     $("#rel-prod-slider").owlCarousel({
    //         dots: false,
    //         loop: false,
    //         autoplay: false,
    //         autoplayHoverPause: true,
    //         smartSpeed: 100,
    //         nav: true,
    //         margin: 30,
    //         responsive: {
    //             0: {items: 1},
    //             1200: {items: 4},
    //             992: {items: 3},
    //             768: {items: 2},
    //             568: {items: 1}
    //         },
    //         navText: [
    //             "<i class='fa fa-angle-left'></i>",
    //             "<i class='fa fa-angle-right'></i>"
    //         ]
    //     });
    // }

    /*------------------- Widget Slider -------------------*/
    // if ($('#widget-best-seller').length > 0) {
    //     $("#widget-best-seller").owlCarousel({
    //         dots: false,
    //         loop: true,
    //         autoplay: false,
    //         autoplayHoverPause: true,
    //         smartSpeed: 100,
    //         nav: true,
    //         margin: 30,
    //         responsive: {
    //             0: {items: 1},
    //             600: {items: 2},
    //             768: {items: 1}
    //         },
    //         navText: [
    //             "<i class='fa fa-angle-left'></i>",
    //             "<i class='fa fa-angle-right'></i>"
    //         ]
    //     });
    // }

    //Resize carousels in modal
    // if ($('.sync2:not(.product-preview-images-small)').length > 0) {
    //     $(document).on('shown.bs.modal', function () {
    //         $(this).find('.sync1, .sync2').each(function () {
    //             $(this).data('owlCarousel') ? $(this).data('owlCarousel').onResize() : null;
    //         });
    //     });
    //
    //     var sync1 = $(".sync1");
    //     var sync2 = $(".sync2");
    //     var sliderthumb = $(".single-prod-thumb");
    //     var homethumb = $(".home-slide-thumb");
    //     var navSpeedThumbs = 500;
    //
    //     sliderthumb.owlCarousel({
    //         rtl: false,
    //         items: 3,
    //         //loop: true,
    //         nav: true,
    //         margin: 20,
    //         navSpeed: navSpeedThumbs,
    //         responsive: {
    //             992: {items: 3},
    //             767: {items: 4},
    //             480: {items: 3},
    //             320: {items: 2}
    //         },
    //         responsiveRefreshRate: 200,
    //         navText: [
    //             "<i class='fa fa-angle-left'></i>",
    //             "<i class='fa fa-angle-right'></i>"
    //         ]
    //     });
    //
    //     sync1.owlCarousel({
    //         rtl: false,
    //         items: 1,
    //         navSpeed: 1000,
    //         nav: false,
    //         onChanged: syncPosition,
    //         responsiveRefreshRate: 200
    //
    //     });
    //
    //     homethumb.owlCarousel({
    //         rtl: false,
    //         items: 5,
    //         nav: true,
    //         //loop: true,
    //         navSpeed: navSpeedThumbs,
    //         responsive: {
    //             1500: {items: 5},
    //             1024: {items: 4},
    //             768: {items: 3},
    //             600: {items: 4},
    //             480: {items: 3},
    //             320: {items: 2,
    //                 nav: false
    //             }
    //         },
    //         responsiveRefreshRate: 200,
    //         navText: [
    //             "<i class='fa fa-long-arrow-left'></i>",
    //             "<i class='fa fa-long-arrow-right'></i>"
    //         ]
    //     });
    // }
    //
    // function syncPosition(el) {
    //     var current = this._current;
    //     $(".sync2")
    //             .find(".owl-item")
    //             .removeClass("synced")
    //             .eq(current)
    //             .addClass("synced");
    //     center(current);
    // }
    //
    // $(".sync2:not(.product-preview-images-small)").on("click", ".owl-item", function (e) {
    //     e.preventDefault();
    //     var number = $(this).index();
    //     sync1.trigger("to.owl.carousel", [number, 1000]);
    //     return false;
    // });
    //
    // function center(num) {
    //
    //     var sync2visible = sync2.find('.owl-item.active').map(function () {
    //         return $(this).index();
    //     });
    //
    //     if ($.inArray(num, sync2visible) === -1) {
    //         if (num > sync2visible[sync2visible.length - 1]) {
    //             sync2.trigger("to.owl.carousel", [num - sync2visible.length + 2, navSpeedThumbs, true]);
    //         } else {
    //             sync2.trigger("to.owl.carousel", Math.max(0, num - 1));
    //         }
    //     } else if (num === sync2visible[sync2visible.length - 1]) {
    //         sync2.trigger("to.owl.carousel", [sync2visible[1], navSpeedThumbs, true]);
    //     } else if (num === sync2visible[0]) {
    //         sync2.trigger("to.owl.carousel", [Math.max(0, num - 1), navSpeedThumbs, true]);
    //     }
    // }
//
// owlCarousel Slider End //

    /*------------------- Scroll To Top Animate -------------------*/
    $('#to-top').on('click', function () {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });

    // /*------------------- Sidebar Filter Range -------------------*/
    // var priceSliderRange = $('#price-range');
    // if ($.ui) {
    //     if ($(priceSliderRange).length) {
    //         $(priceSliderRange).slider({
    //             range: true,
    //             min: 0,
    //             max: 1000,
    //             values: [120, 540],
    //             slide: function (event, ui) {
    //                 //$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
    //                 $("#price-min").html(ui.values[0] + " грн");
    //                 $("#price-max").html(ui.values[1]+ " грн" );
    //                 console.log(ui);
    //             }
    //         });
    //         $("#price-min").html($("#price-range").slider("values", 0) + " грн");
    //         $("#price-max").html($("#price-range").slider("values", 1) + " грн");
    //     }
    // }

    // prettyPhoto
    // ---------------------------------------------------------------------------------------    
    if ($('.caption-link').length > 0) {
        $("a[rel^='prettyPhoto[single-product]']").prettyPhoto({
            theme: 'facebook',
            slideshow: 5000,
            autoplay_slideshow: false,
            social_tools:false,
            deeplinking:false
        });
    }

});

$(window).scroll(function () {
    /*------------------- Sticky Header Starts  -------------------*/
    if ($('#headerstyle').length === 0) {
        if ($(this).scrollTop() > 5) {
            $('.main-header').addClass('is-sticky');
        }
        else {
            $('.main-header').removeClass('is-sticky');
        }
    }
    
    /*------------------- Scroll To Top Animate -------------------*/
    if ($(this).scrollTop() > 100) {
        $('#to-top').css({bottom: '55px'});
    }
    else {
        $('#to-top').css({bottom: '-150px'});
    }
});


/*------ 12.01.2018  -------*/
/*------------------- lookbook Slider -------------------*/
if ($('#lookbook-slider').length > 0) {
    $("#lookbook-slider").owlCarousel({
        dots: true,
        loop: true,
        autoplay: true,
        autoplayHoverPause: true,
        smartSpeed: 300,
        nav: true,
        margin: 30,
        responsive: {
            0: {items: 1},
            1200: {items: 1},
            992: {items: 1},
            568: {items: 1}
        },
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ]
    });
}

/*------------------- category Slider -------------------*/
if ($('#slider-category').length > 0) {
    $("#slider-category").owlCarousel({
        dots: true,
        loop: true,
        autoplay: true,
        autoplayHoverPause: true,
        smartSpeed: 100,
        nav: true,
        margin: 30,
        responsive: {
            0: {items: 1},
            1200: {items: 4},
            992: {items: 3},
            568: {items: 2},
            400: {items: 1}
        },
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ]
    });
}