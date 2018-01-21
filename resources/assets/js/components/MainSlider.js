/**
 * Created by vlad_ on 18.01.2018.
 */

if (document.getElementById('main-slider-section'))
{
    var initProductPreviewImagesSliderInited = false,
        sync1, sync2, sliderthumb, homethumb;

    function initProductPreviewImagesSliderMainSlider () {
        //Resize carousels in modal
        if ($('.sync2.product-preview-images-small').length > 0) {
            $(document).on('shown.bs.modal', function () {
                $(this).find('.sync1.product-preview-images-big, .sync2.product-preview-images-small').each(function () {
                    $(this).data('owlCarousel') ? $(this).data('owlCarousel').onResize() : null;
                });
            });

            var navSpeedThumbs = 500;

            if (!initProductPreviewImagesSliderInited === true) {
                sync1 = $(".sync1.product-preview-images-big");
                sync2 = $(".sync2.product-preview-images-small");
                sliderthumb = $(".single-prod-thumb");
                homethumb = $(".home-slide-thumb");
            }

            sliderthumb.owlCarousel({
                rtl: false,
                items: 3,
                //loop: true,
                nav: true,
                margin: 20,
                navSpeed: navSpeedThumbs,
                responsive: {
                    992: {items: 3},
                    767: {items: 4},
                    480: {items: 3},
                    320: {items: 2}
                },
                responsiveRefreshRate: 200,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ]
            });

            sync1.owlCarousel({
                rtl: false,
                items: 1,
                navSpeed: 1000,
                nav: false,
                onChanged: syncPosition,
                responsiveRefreshRate: 200

            });

            homethumb.owlCarousel({
                rtl: false,
                items: 5,
                nav: true,
                //loop: true,
                navSpeed: navSpeedThumbs,
                responsive: {
                    1500: {items: 5},
                    1024: {items: 4},
                    768: {items: 3},
                    600: {items: 4},
                    480: {items: 3},
                    320: {items: 2,
                        nav: false
                    }
                },
                responsiveRefreshRate: 200,
                navText: [
                    "<i class='fa fa-long-arrow-left'></i>",
                    "<i class='fa fa-long-arrow-right'></i>"
                ]
            });

            if (!initProductPreviewImagesSliderInited) {
                initProductPreviewImagesSliderInited = true;
            }
        }

        function syncPosition(el) {
            var current = this._current;
            $(".sync2.product-preview-images-small")
                .find(".owl-item")
                .removeClass("synced")
                .eq(current)
                .addClass("synced");
            center(current);
        }

        $(".sync2.product-preview-images-small").on("click", ".owl-item", function (e) {
            e.preventDefault();
            var number = $(this).index();
            sync1.trigger("to.owl.carousel", [number, 1000]);
            return false;
        });

        function center(num) {

            var sync2visible = sync2.find('.owl-item.active').map(function () {
                return $(this).index();
            });

            if ($.inArray(num, sync2visible) === -1) {
                if (num > sync2visible[sync2visible.length - 1]) {
                    sync2.trigger("to.owl.carousel", [num - sync2visible.length + 2, navSpeedThumbs, true]);
                } else {
                    sync2.trigger("to.owl.carousel", Math.max(0, num - 1));
                }
            } else if (num === sync2visible[sync2visible.length - 1]) {
                sync2.trigger("to.owl.carousel", [sync2visible[1], navSpeedThumbs, true]);
            } else if (num === sync2visible[0]) {
                sync2.trigger("to.owl.carousel", [Math.max(0, num - 1), navSpeedThumbs, true]);
            }
        }
    }

    function destroyProductPreviewImagesSliderMainSlider () {
        if (initProductPreviewImagesSliderInited === true) {
            sync1.trigger('destroy.owl.carousel');
            sliderthumb.trigger('destroy.owl.carousel');
            homethumb.trigger('destroy.owl.carousel');

            sync1.find('.owl-stage-outer').children().unwrap();
            sync1.removeClass("owl-center owl-loaded owl-text-select-on");

            sync2.find('.owl-stage-outer').children().unwrap();
            sync2.removeClass("owl-center owl-loaded owl-text-select-on");

            sliderthumb.find('.owl-stage-outer').children().unwrap();
            sliderthumb.removeClass("owl-center owl-loaded owl-text-select-on");

            homethumb.find('.owl-stage-outer').children().unwrap();
            homethumb.removeClass("owl-center owl-loaded owl-text-select-on");
        }
    }


    GLOBAL_DATA.mainSliderProducts = window.FFShop.mainSliderProducts;

    GLOBAL_DATA.mainSliderPreview.product = GLOBAL_DATA.mainSliderProducts[0];

    GLOBAL_DATA.mainSliderPreview.rel = 'prettyPhoto[main-slider-' + GLOBAL_DATA.mainSliderProducts[0].id + ']';

    GLOBAL_DATA.mainSliderPreview.currentSizeId = GLOBAL_DATA.mainSliderPreview.product.sizes[0].id;

    //init category product preview count
    GLOBAL_DATA.mainSliderPreview.count = 1;


    new Vue({
        el: '#main-slider-section',
        data: GLOBAL_DATA,
        mounted: function () {
            initProductPreviewImagesSliderMainSlider();

            destroyProductPreviewImagesSliderMainSlider();

            $("a[rel^='prettyPhoto[main-slider-" + GLOBAL_DATA.mainSliderPreview.product.id + "]']").prettyPhoto({
                theme: 'facebook',
                slideshow: 5000,
                autoplay_slideshow: false,
                social_tools: false,
                deeplinking: false,
                ajaxcallback: function () {
                    var PRETTY_LOADED = true;
                    $('#main-slider-preview').modal('hide');
                    $('#main-slider-preview').on('hidden.bs.modal', function () {
                        if (PRETTY_LOADED) {
                            $('body').addClass('modal-open').css('padding-right', '17px');
                            PRETTY_LOADED = false;
                        }
                    });
                },
                callback: function () {
                    $('body').removeClass('modal-open').css('padding-right', 0);
                }
            });
        },
        methods: {
            //check if props in list
            findWhere: function (list, props) {
                var idx = 0;
                var len = list.length;
                var match = false;
                var item, item_k, item_v, prop_k, prop_val;
                for (; idx < len; idx++) {
                    item = list[idx];
                    for (prop_k in props) {
                        // If props doesn't own the property, skip it.
                        if (!props.hasOwnProperty(prop_k)) continue;
                        // If item doesn't have the property, no match;
                        if (!item.hasOwnProperty(prop_k)) {
                            match = false;
                            break;
                        }
                        if (props[prop_k] === item[prop_k]) {
                            // We have a match…so far.
                            match = true;
                        } else {
                            // No match.
                            match = false;
                            // Don't compare more properties.
                            break;
                        }
                    }
                    // We've iterated all of props' properties, and we still match!
                    // Return that item!
                    if (match) return item;
                }
                // No matches
                return null;
            },
            changeMainSliderProductPreview(counter) {
                destroyProductPreviewImagesSliderMainSlider();

                GLOBAL_DATA.mainSliderPreview.product = GLOBAL_DATA.mainSliderProducts[counter];

                GLOBAL_DATA.mainSliderPreview.rel = 'prettyPhoto[main-slider-' + GLOBAL_DATA.mainSliderPreview.product.id + ']';

                GLOBAL_DATA.mainSliderPreview.currentSizeId = GLOBAL_DATA.mainSliderPreview.product.sizes[0].id;

                //init count checking if current preview in cart
                if (this.findWhere(GLOBAL_DATA.cartItems, ({
                        productId: GLOBAL_DATA.mainSliderPreview.product.id,
                        sizeId: GLOBAL_DATA.mainSliderPreview.currentSizeId
                    }))) {
                    //looping cartItems
                    GLOBAL_DATA.cartItems.forEach(function (item) {
                        //check if current active size id in cart
                        if (item.productId == GLOBAL_DATA.mainSliderPreview.product.id && item.sizeId == GLOBAL_DATA.mainSliderPreview.currentSizeId) {
                            //then setting count
                            GLOBAL_DATA.mainSliderPreview.count = item.count;
                        }
                    });
                }
                else {
                    GLOBAL_DATA.mainSliderPreview.count = 1;
                }

                //container with preview
                var $container = $('#main-slider-preview');

                $container.modal();

                setTimeout(function () {
                    initProductPreviewImagesSliderMainSlider();

                    $("a[rel^='prettyPhoto[main-slider-" + GLOBAL_DATA.mainSliderPreview.product.id + "]']").prettyPhoto({
                        theme: 'facebook',
                        slideshow: 5000,
                        autoplay_slideshow: false,
                        social_tools: false,
                        deeplinking: false,
                        ajaxcallback: function () {
                            var PRETTY_LOADED = true;
                            $container.modal('hide');
                            $container.on('hidden.bs.modal', function () {
                                if (PRETTY_LOADED) {
                                    $('body').addClass('modal-open').css('padding-right', '17px');
                                    PRETTY_LOADED = false;
                                }
                            });
                        },
                        callback: function () {
                            $('body').removeClass('modal-open').css('padding-right', 0);
                        }
                    });
                }, 500);
            },
            //method handles onChange count input
            toInteger: function (count) {
                var searchObj = {
                        productId: GLOBAL_DATA.mainSliderPreview.product.id,
                        sizeId: GLOBAL_DATA.mainSliderPreview.currentSizeId
                    },
                    _this = this;

                if (count < 1 || count == '') {
                    GLOBAL_DATA.mainSliderPreview.count = 1;
                }

                if (count > 99) {
                    GLOBAL_DATA.mainSliderPreview.count = 99;
                }

                //if prod size in cart
                if (this.findWhere(GLOBAL_DATA.cartItems, searchObj)) {
                    //then update cart
                    if (_this.timer) {
                        clearTimeout(_this.timer);
                        _this.timer = undefined;
                    }
                    _this.timer = setTimeout(function () {

                        _this.updateCart(searchObj.productId, searchObj.sizeId, GLOBAL_DATA.mainSliderPreview.count);

                    }, 400);
                }
            },
            //method handles add to cart
            addToCart: function (productId, sizeId, count) {
                var obj = {
                        productId: parseInt(productId),
                        sizeId: parseInt(sizeId),
                        count: parseInt(count)
                    },
                    searchObj = {
                        productId: parseInt(productId),
                        sizeId: parseInt(sizeId)
                    },
                    _this = this;

                if (_this.findWhere(GLOBAL_DATA.cartItems, searchObj) == null) {
                    if (GLOBAL_DATA.IS_DATA_PROCESSING) {
                        return false;
                    }

                    GLOBAL_DATA.IS_DATA_PROCESSING = true;

                    showLoader();

                    //ajax
                    $.ajax({
                        type: 'post',
                        url: '/cart/add-to-cart',
                        data: {
                            productId: obj.productId,
                            sizeId: obj.sizeId,
                            count: obj.count,
                            language: LANGUAGE,
                            userTypeId: GLOBAL_DATA.userTypeId
                        },
                        success: function (data) {
                            hideLoader();
                            GLOBAL_DATA.IS_DATA_PROCESSING = false;

                            GLOBAL_DATA.cartItems = data.cart;
                            GLOBAL_DATA.totalCount = data.totalCount;
                            GLOBAL_DATA.totalAmount = data.totalAmount;

                            var LOADED = true;
                            $('#main-slider-preview').modal('hide');
                            $('#main-slider-preview').on('hidden.bs.modal', function () {
                                if (LOADED) {
                                    $('#big-cart').modal();
                                    // $('body').addClass('modal-open').css('padding-right', '17px');
                                    LOADED = false;
                                }
                            });


                        },
                        error: function (error) {
                            hideLoader();
                            GLOBAL_DATA.IS_DATA_PROCESSING = false;
                            console.log(error);
                        }
                    });
                }
                else {
                    // $('#prod-preview-test').modal('hide');
                    // $('#big-cart').modal();

                    var LOADED = true;
                    $('#main-slider-preview').modal('hide');
                    $('#main-slider-preview').on('hidden.bs.modal', function () {
                        if (LOADED) {
                            $('#big-cart').modal();
                            // $('body').addClass('modal-open').css('padding-right', '17px');
                            LOADED = false;
                        }
                    });
                }
            },
            addToWishList: function (productId, sizeId, wishListId) {
                var obj = {
                        productId: parseInt(productId),
                        sizeId: parseInt(sizeId)
                    },
                    _this = this;

                if (_this.findWhere(GLOBAL_DATA.wishListItems, obj) == null) {
                    if (GLOBAL_DATA.IS_DATA_PROCESSING) {
                        return false;
                    }

                    GLOBAL_DATA.IS_DATA_PROCESSING = true;

                    showLoader();

                    //ajax
                    $.ajax({
                        type: 'post',
                        url: '/profile/add-to-wish-list',
                        data: {
                            productId: obj.productId,
                            sizeId: obj.sizeId,
                            wishListId: wishListId,
                            language: LANGUAGE,
                            userTypeId: GLOBAL_DATA.userTypeId
                        },
                        success: function (data) {
                            hideLoader();

                            GLOBAL_DATA.IS_DATA_PROCESSING = false;

                            GLOBAL_DATA.wishListItems = data.wishListItems;

                        },
                        error: function (error) {
                            hideLoader();
                            GLOBAL_DATA.IS_DATA_PROCESSING = false;
                            console.log(error);
                        }
                    });
                }

            },
            //changing current sizeId in preview
            changeCurrentSizeId: function (sizeId) {
                GLOBAL_DATA.mainSliderPreview.currentSizeId = sizeId;

                if (this.findWhere(GLOBAL_DATA.cartItems, ({
                        productId: GLOBAL_DATA.mainSliderPreview.product.id,
                        sizeId: GLOBAL_DATA.mainSliderPreview.currentSizeId
                    }))) {
                    //looping cartItems
                    GLOBAL_DATA.cartItems.forEach(function (item) {
                        //check if current active size id in cart
                        if (item.productId == GLOBAL_DATA.mainSliderPreview.product.id && item.sizeId == GLOBAL_DATA.mainSliderPreview.currentSizeId) {
                            //then setting count
                            GLOBAL_DATA.mainSliderPreview.count = item.count;
                        }
                    });
                }
                else {
                    GLOBAL_DATA.mainSliderPreview.count = 1;
                }
            },
            //method handles updating cart, change count
            updateCart: function (productId, sizeId, count) {
                if (GLOBAL_DATA.IS_DATA_PROCESSING) {
                    return false;
                }

                GLOBAL_DATA.IS_DATA_PROCESSING = true;

                var obj = {
                        productId: parseInt(productId),
                        sizeId: parseInt(sizeId),
                        count: parseInt(count)
                    },
                    _this = this;

                showLoader();

                //ajax
                $.ajax({
                    type: 'post',
                    url: '/cart/update-cart',
                    data: {
                        productId: obj.productId,
                        sizeId: obj.sizeId,
                        count: obj.count,
                        language: LANGUAGE,
                        userTypeId: GLOBAL_DATA.userTypeId
                    },
                    success: function (data) {
                        GLOBAL_DATA.IS_DATA_PROCESSING = false;
                        hideLoader();
                        GLOBAL_DATA.cartItems = data.cart;
                        GLOBAL_DATA.totalCount = data.totalCount;
                        GLOBAL_DATA.totalAmount = data.totalAmount;
                    },
                    error: function (error) {
                        GLOBAL_DATA.IS_DATA_PROCESSING = false;
                        hideLoader();
                        console.log(error);
                    }
                });
            },
            //method handles + button incrementing value
            increment: function () {
                var searchObj = {
                        productId: GLOBAL_DATA.mainSliderPreview.product.id,
                        sizeId: GLOBAL_DATA.mainSliderPreview.currentSizeId
                    },
                    _this = this;

                var oldCount = GLOBAL_DATA.mainSliderPreview.count;

                GLOBAL_DATA.mainSliderPreview.count++;

                if (GLOBAL_DATA.mainSliderPreview.count > 99) {
                    GLOBAL_DATA.mainSliderPreview.count = 99;
                }

                //check if size id in cart
                if (_this.findWhere(GLOBAL_DATA.cartItems, searchObj)) {
                    //check if old count != new count
                    if (oldCount != GLOBAL_DATA.mainSliderPreview.count) {
                        //then send update ajax
                        if (_this.timer) {
                            clearTimeout(_this.timer);
                            _this.timer = undefined;
                        }
                        _this.timer = setTimeout(function () {

                            _this.updateCart(searchObj.productId, searchObj.sizeId, GLOBAL_DATA.mainSliderPreview.count);

                        }, 400);
                    }
                }
            },
            //method handles - button decrementing value
            decrement: function () {
                var searchObj = {
                        productId: GLOBAL_DATA.mainSliderPreview.product.id,
                        sizeId: GLOBAL_DATA.mainSliderPreview.currentSizeId
                    },
                    _this = this;

                var oldCount = GLOBAL_DATA.mainSliderPreview.count;

                GLOBAL_DATA.mainSliderPreview.count--;

                if (GLOBAL_DATA.mainSliderPreview.count < 1) {
                    GLOBAL_DATA.mainSliderPreview.count = 1;
                }

                //check if size id in cart
                if (_this.findWhere(GLOBAL_DATA.cartItems, searchObj)) {
                    //check if old count != new count
                    if (oldCount != GLOBAL_DATA.mainSliderPreview.count) {
                        //then send update ajax
                        if (_this.timer) {
                            clearTimeout(_this.timer);
                            _this.timer = undefined;
                        }
                        _this.timer = setTimeout(function () {

                            _this.updateCart(searchObj.productId, searchObj.sizeId, GLOBAL_DATA.mainSliderPreview.count);

                        }, 400);
                    }
                }
            }
        }
    });

}