/**
 * Created by vlad_ on 16.01.2018.
 */

if (document.getElementById('top-products'))
{
    let previewTopSliderInited = false,
        sync1Top, sync2Top, navSpeedThumbs = 500;

    function initPreviewTopSlider () {
        //Resize carousels in modal
        if ($('#top-products').length > 0) {

            // $(document).on('shown.bs.modal', function () {
            //     $(this).find('.sync1.product-preview-images-big, .sync2.product-preview-images-small').each(function () {
            //         $(this).data('owlCarousel') ? $(this).data('owlCarousel').onResize() : null;
            //     });
            // });

            if (!previewTopSliderInited === true) {
                sync1Top = $("#top-products .sync1");
                sync2Top = $("#top-products .sync2");
            }

            sync2Top.owlCarousel({
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

            sync1Top.owlCarousel({
                rtl: false,
                items: 1,
                navSpeed: 1000,
                nav: false,
                onChanged: syncPosition,
                responsiveRefreshRate: 200

            });

            if (!previewTopSliderInited) {
                previewTopSliderInited = true;
            }
        }

        function syncPosition(el) {
            let current = this._current;
            sync2Top
                .find(".owl-item")
                .removeClass("synced")
                .eq(current)
                .addClass("synced");
            center(current);
        }

        sync2Top.on("click", ".owl-item", function (e) {
            e.preventDefault();
            let number = $(this).index();
            sync1Top.trigger("to.owl.carousel", [number, 1000, true]);
            return false;
        });

        function center(num) {

            let sync2visible = sync2Top.find('.owl-item.active').map(function () {
                return $(this).index();
            });

            if ($.inArray(num, sync2visible) === -1) {
                if (num > sync2visible[sync2visible.length - 1]) {
                    sync2Top.trigger("to.owl.carousel", [num - sync2visible.length + 2, navSpeedThumbs, true]);
                } else {
                    sync2Top.trigger("to.owl.carousel", Math.max(0, num - 1));
                }
            } else if (num === sync2visible[sync2visible.length - 1]) {
                sync2Top.trigger("to.owl.carousel", [sync2visible[1], navSpeedThumbs, true]);
            } else if (num === sync2visible[0]) {
                sync2Top.trigger("to.owl.carousel", [Math.max(0, num - 1), navSpeedThumbs, true]);
            }
        }
    }

    function destroyPreviewTopSlider () {
        if (previewTopSliderInited === true)
        {
            sync1Top.trigger('destroy.owl.carousel');
            sync2Top.trigger('destroy.owl.carousel');

            sync1Top.find('.owl-stage-outer').children().unwrap();
            sync1Top.removeClass("owl-center owl-loaded owl-text-select-on");

            sync2Top.find('.owl-stage-outer').children().unwrap();
            sync2Top.removeClass("owl-center owl-loaded owl-text-select-on");
        }
    }

    function checkPreviewTopSliderStock ()
    {
        GLOBAL_DATA.topProductPreview.product.product_sizes.forEach(function (item) {
            if (item.size_id == GLOBAL_DATA.topProductPreview.currentSizeId) {
                if (item.stocks[0].stock > 0) {
                    GLOBAL_DATA.topProductPreview.inStock = true;
                } else {
                    GLOBAL_DATA.topProductPreview.inStock = false;
                }
            }
        });
    }

    GLOBAL_DATA.topProducts = window.FFShop.topProducts;

    if (GLOBAL_DATA.topProducts && GLOBAL_DATA.topProducts.length > 0)
    {
        GLOBAL_DATA.topProductPreview.product = GLOBAL_DATA.topProducts[0];

        GLOBAL_DATA.topProductPreview.rel = 'prettyPhoto[top-' + GLOBAL_DATA.topProducts[0].id + ']';

        GLOBAL_DATA.topProductPreview.currentSizeId = GLOBAL_DATA.topProductPreview.product.sizes[0].id;

        //init category product preview count
        GLOBAL_DATA.topProductPreview.count = 1;

        checkPreviewTopSliderStock ();

        new Vue({
            el: '#top-products',
            data: GLOBAL_DATA,
            mounted: function () {
                /*------------------- Product Slider -------------------*/
                if ($('#prod-slider-1').length > 0) {
                    $("#prod-slider-1").owlCarousel({
                        dots: false,
                        loop: false,
                        autoplay: false,
                        autoplayHoverPause: true,
                        touchDrag: true,
                        mouseDrag: false,
                        smartSpeed: 100,
                        nav: GLOBAL_DATA.topProducts.length > 4,
                        margin: 30,
                        responsive: {
                            0: {items: 1,nav: GLOBAL_DATA.topProducts.length > 1 },
                            1200: {items: 4,nav: GLOBAL_DATA.topProducts.length > 4},
                            992: {items: 3,nav: GLOBAL_DATA.topProducts.length > 3},
                            768: {items: 2,nav: GLOBAL_DATA.topProducts.length > 2},
                            568: {items: 1,nav: GLOBAL_DATA.topProducts.length > 1}
                        },
                        navText: [
                            "<i class='fa fa-angle-left'></i>",
                            "<i class='fa fa-angle-right'></i>"
                        ]
                    });
                }

                $("a[rel^='prettyPhoto[top-" + GLOBAL_DATA.topProductPreview.product.id + "]']").prettyPhoto({
                    theme: 'facebook',
                    slideshow: 5000,
                    autoplay_slideshow: false,
                    social_tools: false,
                    deeplinking: false,
                    ajaxcallback: function () {
                        var PRETTY_LOADED = true;
                        $('#top-preview').modal('hide');
                        $('#top-preview').on('hidden.bs.modal', function () {
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
                changeTopProductPreview(counter) {
                    destroyPreviewTopSlider();

                    GLOBAL_DATA.topProductPreview.product = GLOBAL_DATA.topProducts[counter];

                    GLOBAL_DATA.topProductPreview.rel = 'prettyPhoto[top-' + GLOBAL_DATA.topProductPreview.product.id + ']';

                    GLOBAL_DATA.topProductPreview.currentSizeId = GLOBAL_DATA.topProductPreview.product.sizes[0].id;

                    checkPreviewTopSliderStock ();

                    //init count checking if current preview in cart
                    if (this.findWhere(GLOBAL_DATA.cartItems, ({
                            productId: GLOBAL_DATA.topProductPreview.product.id,
                            sizeId: GLOBAL_DATA.topProductPreview.currentSizeId
                        }))) {
                        //looping cartItems
                        GLOBAL_DATA.cartItems.forEach(function (item) {
                            //check if current active size id in cart
                            if (item.productId == GLOBAL_DATA.topProductPreview.product.id && item.sizeId == GLOBAL_DATA.topProductPreview.currentSizeId) {
                                //then setting count
                                GLOBAL_DATA.topProductPreview.count = item.count;
                            }
                        });
                    }
                    else {
                        GLOBAL_DATA.topProductPreview.count = 1;
                    }

                    //container with preview
                    let $container = $('#top-preview');

                    $container.modal();

                    setTimeout(function () {
                        $('#top-products .ttip:not(.tooltipstered)').tooltipster({
                            theme: 'tooltipster-borderless'
                        });

                        initPreviewTopSlider();

                        $("a[rel^='prettyPhoto[top-" + GLOBAL_DATA.topProductPreview.product.id + "]']").prettyPhoto({
                            theme: 'facebook',
                            slideshow: 5000,
                            autoplay_slideshow: false,
                            social_tools: false,
                            deeplinking: false,
                            ajaxcallback: function () {
                                let PRETTY_LOADED = true;
                                $container.modal('hide');
                                $container.on('hidden.bs.modal', function () {
                                    if (PRETTY_LOADED) {
                                        // $('body').addClass('modal-open').css('padding-right', '17px');
                                        PRETTY_LOADED = false;
                                    }
                                });
                            },
                            callback: function () {
                                // $('body').removeClass('modal-open').css('padding-right', 0);
                            }
                        });
                    }, 500);

                },
                //method handles onChange count input
                toInteger: function (count) {
                    var searchObj = {
                            productId: GLOBAL_DATA.topProductPreview.product.id,
                            sizeId: GLOBAL_DATA.topProductPreview.currentSizeId
                        },
                        _this = this;

                    if (count < 1 || count == '') {
                        GLOBAL_DATA.topProductPreview.count = 1;
                    }

                    GLOBAL_DATA.topProductPreview.product.product_sizes.forEach(function (item) {
                        if (item.product_id == searchObj.productId && item.size_id == searchObj.sizeId) {
                            if (count > item.stocks[0].stock)
                            {
                                GLOBAL_DATA.topProductPreview.count = item.stocks[0].stock > 0 ? item.stocks[0].stock : 1;
                                showPopup(CART_MAX);
                            }
                        }
                    });

                    //if prod size in cart
                    if (this.findWhere(GLOBAL_DATA.cartItems, searchObj)) {
                        //then update cart
                        if (_this.timer) {
                            clearTimeout(_this.timer);
                            _this.timer = undefined;
                        }
                        _this.timer = setTimeout(function () {

                            _this.updateCart(searchObj.productId, searchObj.sizeId, GLOBAL_DATA.topProductPreview.count);

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
                    
                    if (GLOBAL_DATA.topProductPreview.inStock) {
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
                                    $('#top-preview').modal('hide');
                                    $('#top-preview').on('hidden.bs.modal', function () {
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
                            $('#top-preview').modal('hide');
                            $('#top-preview').on('hidden.bs.modal', function () {
                                if (LOADED) {
                                    $('#big-cart').modal();
                                    // $('body').addClass('modal-open').css('padding-right', '17px');
                                    LOADED = false;
                                }
                            });
                        }
                    } else {
                        setNotifyIds(productId, sizeId);
                        var LOADED = true;
                        $('#top-preview').modal('hide');
                        $('#top-preview').on('hidden.bs.modal', function () {
                            if (LOADED) {
                                $('[data-notify]').modal();
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
                    GLOBAL_DATA.topProductPreview.currentSizeId = sizeId;

                    checkPreviewTopSliderStock ();

                    if (this.findWhere(GLOBAL_DATA.cartItems, ({
                            productId: GLOBAL_DATA.topProductPreview.product.id,
                            sizeId: GLOBAL_DATA.topProductPreview.currentSizeId
                        }))) {
                        //looping cartItems
                        GLOBAL_DATA.cartItems.forEach(function (item) {
                            //check if current active size id in cart
                            if (item.productId == GLOBAL_DATA.topProductPreview.product.id && item.sizeId == GLOBAL_DATA.topProductPreview.currentSizeId) {
                                //then setting count
                                GLOBAL_DATA.topProductPreview.count = item.count;
                            }
                        });
                    }
                    else {
                        GLOBAL_DATA.topProductPreview.count = 1;
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
                            productId: GLOBAL_DATA.topProductPreview.product.id,
                            sizeId: GLOBAL_DATA.topProductPreview.currentSizeId
                        },
                        _this = this;

                    var oldCount = GLOBAL_DATA.topProductPreview.count;

                    GLOBAL_DATA.topProductPreview.product.product_sizes.forEach(function (item) {
                        if (item.product_id == searchObj.productId && item.size_id == searchObj.sizeId) {
                            if (GLOBAL_DATA.topProductPreview.count < item.stocks[0].stock) {
                                GLOBAL_DATA.topProductPreview.count++;
                            }
            
                            if (GLOBAL_DATA.topProductPreview.count == item.stocks[0].stock ) {
                                showPopup(CART_MAX);
                            }
                        }
                    });

                    if (GLOBAL_DATA.topProductPreview.count > 9999) {
                        GLOBAL_DATA.topProductPreview.count = 9999;
                    }

                    //check if size id in cart
                    if (_this.findWhere(GLOBAL_DATA.cartItems, searchObj)) {
                        //check if old count != new count
                        if (oldCount != GLOBAL_DATA.topProductPreview.count) {
                            //then send update ajax
                            if (_this.timer) {
                                clearTimeout(_this.timer);
                                _this.timer = undefined;
                            }
                            _this.timer = setTimeout(function () {

                                _this.updateCart(searchObj.productId, searchObj.sizeId, GLOBAL_DATA.topProductPreview.count);

                            }, 400);
                        }
                    }
                },
                //method handles - button decrementing value
                decrement: function () {
                    var searchObj = {
                            productId: GLOBAL_DATA.topProductPreview.product.id,
                            sizeId: GLOBAL_DATA.topProductPreview.currentSizeId
                        },
                        _this = this;

                    var oldCount = GLOBAL_DATA.topProductPreview.count;

                    GLOBAL_DATA.topProductPreview.count--;

                    if (GLOBAL_DATA.topProductPreview.count < 1) {
                        GLOBAL_DATA.topProductPreview.count = 1;
                    }

                    //check if size id in cart
                    if (_this.findWhere(GLOBAL_DATA.cartItems, searchObj)) {
                        //check if old count != new count
                        if (oldCount != GLOBAL_DATA.topProductPreview.count) {
                            //then send update ajax
                            if (_this.timer) {
                                clearTimeout(_this.timer);
                                _this.timer = undefined;
                            }
                            _this.timer = setTimeout(function () {

                                _this.updateCart(searchObj.productId, searchObj.sizeId, GLOBAL_DATA.topProductPreview.count);

                            }, 400);
                        }
                    }
                }
            }
        });
    }
}