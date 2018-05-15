/**
 * Created by vlad_ on 18.01.2018.
 */

if (document.getElementById('main-slider-section'))
{
    let previewMainSliderInited = false,
        sync1Main, sync2Main, navSpeedThumbs = 500;

    function initPreviewMainSlider () {
        //Resize carousels in modal
        if ($('#main-slider-section').length > 0) {

            // $(document).on('shown.bs.modal', function () {
            //     $(this).find('.sync1.product-preview-images-big, .sync2.product-preview-images-small').each(function () {
            //         $(this).data('owlCarousel') ? $(this).data('owlCarousel').onResize() : null;
            //     });
            // });

            if (!previewMainSliderInited === true)
            {
                sync1Main = $("#main-slider-section .sync1");
                sync2Main = $("#main-slider-section .sync2");
            }

            sync2Main.owlCarousel({
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

            sync1Main.owlCarousel({
                rtl: false,
                items: 1,
                navSpeed: 1000,
                nav: false,
                onChanged: syncPosition,
                responsiveRefreshRate: 200

            });

            if (!previewMainSliderInited) {
                previewMainSliderInited = true;
            }
        }

        function syncPosition(el) {
            let current = this._current;
            sync2Main
                .find(".owl-item")
                .removeClass("synced")
                .eq(current)
                .addClass("synced");
            center(current);
        }

        sync2Main.on("click", ".owl-item", function (e) {
            e.preventDefault();
            let number = $(this).index();
            sync1Main.trigger("to.owl.carousel", [number, 1000, true]);
            return false;
        });

        function center(num) {

            let sync2visible = sync2Main.find('.owl-item.active').map(function () {
                return $(this).index();
            });

            if ($.inArray(num, sync2visible) === -1) {
                if (num > sync2visible[sync2visible.length - 1]) {
                    sync2Main.trigger("to.owl.carousel", [num - sync2visible.length + 2, navSpeedThumbs, true]);
                } else {
                    sync2Main.trigger("to.owl.carousel", Math.max(0, num - 1));
                }
            } else if (num === sync2visible[sync2visible.length - 1]) {
                sync2Main.trigger("to.owl.carousel", [sync2visible[1], navSpeedThumbs, true]);
            } else if (num === sync2visible[0]) {
                sync2Main.trigger("to.owl.carousel", [Math.max(0, num - 1), navSpeedThumbs, true]);
            }
        }
    }

    function destroyPreviewMainSlider () {
        if (previewMainSliderInited === true)
        {
            sync1Main.trigger('destroy.owl.carousel');
            sync2Main.trigger('destroy.owl.carousel');

            sync1Main.find('.owl-stage-outer').children().unwrap();
            sync1Main.removeClass("owl-center owl-loaded owl-text-select-on");

            sync2Main.find('.owl-stage-outer').children().unwrap();
            sync2Main.removeClass("owl-center owl-loaded owl-text-select-on");
        }
    }

    function checkPreviewMainSliderStock ()
    {
        GLOBAL_DATA.mainSliderPreview.product.product_sizes.forEach(function (item) {
            if (item.size_id == GLOBAL_DATA.mainSliderPreview.currentSizeId) {
                if (item.stocks[0].stock > 0) {
                    GLOBAL_DATA.mainSliderPreview.inStock = true;
                } else {
                    GLOBAL_DATA.mainSliderPreview.inStock = false;
                }
            }
        });
    }

    GLOBAL_DATA.mainSliderProducts = window.FFShop.mainSliderProducts;

    if (GLOBAL_DATA.mainSliderProducts && GLOBAL_DATA.mainSliderProducts.length > 0)
    {
        GLOBAL_DATA.isMainSliderProductsInited = true;

        GLOBAL_DATA.mainSliderPreview.product = GLOBAL_DATA.mainSliderProducts[0];

        GLOBAL_DATA.mainSliderPreview.rel = 'prettyPhoto[main-slider-' + GLOBAL_DATA.mainSliderProducts[0].id + ']';

        GLOBAL_DATA.mainSliderPreview.currentSizeId = GLOBAL_DATA.mainSliderPreview.product.sizes[0].id;

        //init category product preview count
        GLOBAL_DATA.mainSliderPreview.count = 1;

        checkPreviewMainSliderStock ();
    }

    new Vue({
            el: '#main-slider-section',
            data: GLOBAL_DATA,
            mounted: function () {
                let _this = this;
                let counter;

                    //Main Slider carousel
                if ($('#main-slider').length > 0) {
                    $("#main-slider").owlCarousel({
                        autoplay: true,
                        items: 1,
                        dots: true,
                        nav: true,
                        loop: true,
                        touchDrag: true,
                        mouseDrag: false,
                        autoplayHoverPause: true,
                        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                        responsive: {
                            0: {items: 1}
                        },
                        onInitialized: function () {
                            $('body').on('mouseenter', '[data-marker-link]', function (event) {
                                counter = $(this).attr('data-marker-link');
                                _this.initMarkerPosition(counter);
                            });

                            $('body').on('mouseleave', '[data-marker-product]', function (event) {
                                _this.resetMarkerPosition(counter);
                            });

                            $('body').on('click', '[data-marker-product-preview]', function (event) {
                                event.preventDefault();
                                _this.changeMainSliderProductPreview(counter);
                            });
                        }
                    });
                }

                if (GLOBAL_DATA.isMainSliderProductsInited)
                {
                    $("a[rel^='prettyPhoto[main-slider-" + GLOBAL_DATA.mainSliderPreview.product.id + "]']").prettyPhoto({
                        theme: 'facebook',
                        slideshow: 5000,
                        autoplay_slideshow: false,
                        social_tools: false,
                        deeplinking: false,
                        ajaxcallback: function () {
                            let PRETTY_LOADED = true;
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
                }
            },
            methods: {
                initMarkerPosition: function (counter) {
                    let owlActive = $('#main-slider .owl-item.active');
                    let product = owlActive.find('[data-marker-product=' + counter + ']');
                    let point = owlActive.find('[data-marker-point=' + counter + ']');
                    let container = product.closest('[data-marker-container]');

                    let defaultY = 50,
                        defaultX = 50,
                        translateY = defaultY,
                        translateX = defaultX,
                        pointY,
                        pointX,
                        containerHeight,
                        containerWidth,
                        containerY,
                        containerX,
                        productY,
                        productX,
                        productHeight,
                        productWidth;

                    pointY = point.offset().top;
                    pointX = point.offset().left;

                    containerY = container.offset().top;
                    containerX = container.offset().left;
                    containerHeight = container.height();
                    containerWidth = container.width();

                    productHeight = product.height();
                    productWidth = product.width();
                    productY = pointY - (productHeight / 2) + 7.5;
                    productX = pointX - (productWidth / 2) + 7.5;

                    //Move to up
                    if((productY + productHeight) >= (containerY + containerHeight)){
                        let hiddenPixels = (productY + productHeight) - (containerY + containerHeight);
                        let hiddenPercent = (hiddenPixels * 100) / productHeight;
                        translateY = Math.round(translateY + hiddenPercent) + 1;
                    }
                    //Move to bot
                    if (productY <= containerY)
                    {
                        let hiddenPixels = containerY - productY;
                        let hiddenPercent = (hiddenPixels * 100) / productHeight;
                        translateY = Math.round(defaultY - hiddenPercent) - 1;
                    }
                    //Move to left
                    if(productX <= containerX){
                        let hiddenPixels = containerX - productX;
                        let hiddenPercent = (hiddenPixels * 100) / productWidth;
                        translateX = Math.round(defaultX - hiddenPercent) - 1;
                    }
                    //Move to right
                    if((productX + productWidth) >= (containerX + containerWidth)){
                        let hiddenPixels = (productX + productWidth) - (containerX + containerWidth);
                        let hiddenPercent = (hiddenPixels * 100) / productWidth;
                        translateX = Math.round(defaultX + hiddenPercent) + 1;
                    }

                    product.css('transform', 'translate(-' + translateX + '%, -' + translateY + '%) scale(1)');
                },
                resetMarkerPosition: function (counter) {
                    let owlActive = $('#main-slider .owl-item.active');
                    let product = owlActive.find('[data-marker-product=' + counter + ']');
                    product.css('transform', 'translate(-50%, -50%) scale(0)');
                },
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
                    destroyPreviewMainSlider();

                    GLOBAL_DATA.mainSliderPreview.product = GLOBAL_DATA.mainSliderProducts[counter];

                    GLOBAL_DATA.mainSliderPreview.rel = 'prettyPhoto[main-slider-' + GLOBAL_DATA.mainSliderPreview.product.id + ']';

                    GLOBAL_DATA.mainSliderPreview.currentSizeId = GLOBAL_DATA.mainSliderPreview.product.sizes[0].id;

                    checkPreviewMainSliderStock ();

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
                    let $container = $('#main-slider-preview');

                    $container.modal();

                    setTimeout(function () {
                        $('#main-slider-section .ttip:not(.tooltipstered)').tooltipster({
                            theme: 'tooltipster-borderless'
                        });

                        initPreviewMainSlider();

                        $("a[rel^='prettyPhoto[main-slider-" + GLOBAL_DATA.mainSliderPreview.product.id + "]']").prettyPhoto({
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

                    GLOBAL_DATA.mainSliderPreview.product.product_sizes.forEach(function (item) {
                        if (item.product_id == searchObj.productId && item.size_id == searchObj.sizeId) {
                            if (count > item.stocks[0].stock)
                            {
                                GLOBAL_DATA.mainSliderPreview.count = item.stocks[0].stock > 0 ? item.stocks[0].stock : 1;
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

                    if (GLOBAL_DATA.mainSliderPreview.inStock) {
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
                    } else {
                        setNotifyIds(productId, sizeId);
                        var LOADED = true;
                        $('#main-slider-preview').modal('hide');
                        $('#main-slider-preview').on('hidden.bs.modal', function () {
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
                    GLOBAL_DATA.mainSliderPreview.currentSizeId = sizeId;

                    checkPreviewMainSliderStock ();

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

                    GLOBAL_DATA.mainSliderPreview.product.product_sizes.forEach(function (item) {
                        if (item.product_id == searchObj.productId && item.size_id == searchObj.sizeId) {
                            if (GLOBAL_DATA.mainSliderPreview.count < item.stocks[0].stock) {
                                GLOBAL_DATA.mainSliderPreview.count++;
                            }
            
                            if (GLOBAL_DATA.mainSliderPreview.count == item.stocks[0].stock ) {
                                showPopup(CART_MAX);
                            }
                        }
                    });

                    if (GLOBAL_DATA.mainSliderPreview.count > 9999) {
                        GLOBAL_DATA.mainSliderPreview.count = 9999;
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