if (document.getElementById('grid-view'))
{
    var previewGridSliderInited = false,
        sync1Grid, sync2Grid, navSpeedThumbs = 500;

    function initPreviewGridSlider () {
        //Resize carousels in modal
        if ($('.sync2.product-preview-images-small').length > 0) {

            // $(document).on('shown.bs.modal', function () {
            //     $(this).find('.sync1.product-preview-images-big, .sync2.product-preview-images-small').each(function () {
            //         $(this).data('owlCarousel') ? $(this).data('owlCarousel').onResize() : null;
            //     });
            // });

            if (!previewGridSliderInited === true) {
                sync1Grid = $(".sync1.product-preview-images-big");
                sync2Grid = $(".sync2.product-preview-images-small");
            }

            sync2Grid.owlCarousel({
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

            sync1Grid.owlCarousel({
                rtl: false,
                items: 1,
                navSpeed: 1000,
                nav: false,
                onChanged: syncPosition,
                responsiveRefreshRate: 200

            });

            if (!previewGridSliderInited) {
                previewGridSliderInited = true;
            }
        }

        function syncPosition(el) {
            var current = this._current;
            sync2Grid
                .find(".owl-item")
                .removeClass("synced")
                .eq(current)
                .addClass("synced");
            center(current);
        }

        sync2Grid.on("click", ".owl-item", function (e) {
            e.preventDefault();
            var number = $(this).index();
            sync1Grid.trigger("to.owl.carousel", [number, 1000, true]);
            return false;
        });

        function center(num) {

            var sync2visible = sync2Grid.find('.owl-item.active').map(function () {
                return $(this).index();
            });

            if ($.inArray(num, sync2visible) === -1) {
                if (num > sync2visible[sync2visible.length - 1]) {
                    sync2Grid.trigger("to.owl.carousel", [num - sync2visible.length + 2, navSpeedThumbs, true]);
                } else {
                    sync2Grid.trigger("to.owl.carousel", Math.max(0, num - 1));
                }
            } else if (num === sync2visible[sync2visible.length - 1]) {
                sync2Grid.trigger("to.owl.carousel", [sync2visible[1], navSpeedThumbs, true]);
            } else if (num === sync2visible[0]) {
                sync2Grid.trigger("to.owl.carousel", [Math.max(0, num - 1), navSpeedThumbs, true]);
            }
        }
    }

    function destroyPreviewGridSlider () {
        if (previewGridSliderInited === true)
        {
            sync1Grid.trigger('destroy.owl.carousel');
            sync2Grid.trigger('destroy.owl.carousel');

            sync1Grid.find('.owl-stage-outer').children().unwrap();
            sync1Grid.removeClass("owl-center owl-loaded owl-text-select-on");

            sync2Grid.find('.owl-stage-outer').children().unwrap();
            sync2Grid.removeClass("owl-center owl-loaded owl-text-select-on");
        }
    }

    function checkPreviewCategoryStock ()
    {
        GLOBAL_DATA.categoryProductPreview.product.product_sizes.forEach(function (item) {
            if (item.size_id == GLOBAL_DATA.categoryProductPreview.currentSizeId) {
                if (item.stocks[0].stock > 0) {
                    GLOBAL_DATA.categoryProductPreview.inStock = true;
                } else {
                    GLOBAL_DATA.categoryProductPreview.inStock = false;
                }
            }
        });
    }

    //init category products
    GLOBAL_DATA.categoryProducts = window.FFShop.products;

    if (GLOBAL_DATA.categoryProducts && GLOBAL_DATA.categoryProducts.length > 0) {
        // init currentSizeId for categoryProducts
        GLOBAL_DATA.categoryProducts.forEach(function (item) {
            var $product = $('[data-category-product-id="' + item.id + '"]'),
                $productSizeActive = $product.find('[data-product-size-active]'),
                productSizeActiveId = $productSizeActive.length ? $productSizeActive.attr('data-product-size-id') : -1;

            if (productSizeActiveId !== -1) {
                item.currentSizeId = productSizeActiveId;
            }

            item.product_sizes.forEach(function (el) {
                if (el.size_id == item.currentSizeId) {
                    if (el.stocks[0].stock > 0) {
                        item.inStock = true;
                    } else {
                        item.inStock = false;
                    }
                }
            });

        });

        //init category product preview (first product) from categoryProducts
        GLOBAL_DATA.categoryProductPreview.product = GLOBAL_DATA.categoryProducts[0];

        //init category product preview rel for pretty photo
        GLOBAL_DATA.categoryProductPreview.rel = 'prettyPhoto[category-' + GLOBAL_DATA.categoryProducts[0].id + ']';

        //init category product preview currentSizeId
        GLOBAL_DATA.categoryProductPreview.currentSizeId = GLOBAL_DATA.categoryProductPreview.product.sizes[0].id;;

        //init category product preview count
        GLOBAL_DATA.categoryProductPreview.count = 1;

        checkPreviewCategoryStock();

        new Vue({
            el: '#grid-view',
            data: GLOBAL_DATA,
            mounted: function () {
                $('#grid-view .ttip:not(.tooltipstered)').tooltipster({
                    theme: 'tooltipster-borderless'
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
                //method handles add to cart
                addToCart: function (productId, sizeId, count, counter) {
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
                    
                    if (GLOBAL_DATA.categoryProducts[counter].inStock) {
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
    
                                    $('#big-cart').modal();
                                },
                                error: function (error) {
                                    hideLoader();
                                    GLOBAL_DATA.IS_DATA_PROCESSING = false;
                                    console.log(error);
                                }
                            });
                        }
                        else {
                            $('#big-cart').modal();
                        }
                    } else {
                        setNotifyIds(productId, sizeId);
                        $('[data-notify]').modal();
                    }
                },
                //
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
                                GLOBAL_DATA.totalWishListCount = data.totalWishListCount;

                            },
                            error: function (error) {
                                hideLoader();
                                GLOBAL_DATA.IS_DATA_PROCESSING = false;
                                console.log(error);
                            }
                        });
                    }

                },
                //changing currentSizeId of category product
                changeCurrentSizeId: function (counter, sizeId) {
                    GLOBAL_DATA.categoryProducts[counter].currentSizeId = sizeId;

                    GLOBAL_DATA.categoryProducts.forEach(function (item) {
                        item.product_sizes.forEach(function (el) {
                            if (el.size_id == item.currentSizeId) {
                                if (el.stocks[0].stock > 0) {
                                    item.inStock = true;
                                } else {
                                    item.inStock = false;
                                }
                            }
                        });
            
                    });
                },
                //changing category product preview
                changeCategoryProductPreview: function (counter) {
                    destroyPreviewGridSlider();

                    GLOBAL_DATA.categoryProductPreview.product = GLOBAL_DATA.categoryProducts[counter];

                    GLOBAL_DATA.categoryProductPreview.rel = 'prettyPhoto[category-' + GLOBAL_DATA.categoryProductPreview.product.id + ']';

                    GLOBAL_DATA.categoryProductPreview.currentSizeId = GLOBAL_DATA.categoryProductPreview.product.sizes[0].id;

                    checkPreviewCategoryStock ()

                    //init count checking if current preview in cart
                    if (this.findWhere(GLOBAL_DATA.cartItems, ({productId: GLOBAL_DATA.categoryProductPreview.product.id, sizeId: GLOBAL_DATA.categoryProductPreview.currentSizeId})))
                    {
                        //looping cartItems
                        GLOBAL_DATA.cartItems.forEach(function (item) {
                            //check if current active size id in cart
                            if (item.productId == GLOBAL_DATA.categoryProductPreview.product.id &&
                                item.sizeId == GLOBAL_DATA.categoryProductPreview.currentSizeId) {
                                //then setting count
                                GLOBAL_DATA.categoryProductPreview.count = item.count;
                            }
                        });
                    }
                    else {
                        GLOBAL_DATA.categoryProductPreview.count = 1;
                    }

                    //container with preview
                    var $container = $('#prod-preview-test');

                    $container.modal();

                    setTimeout(function () {
                        $('#prod-preview-test .ttip:not(.tooltipstered)').tooltipster({
                            theme: 'tooltipster-borderless'
                        });

                        initPreviewGridSlider();

                        $("a[rel^='prettyPhoto[category-" + GLOBAL_DATA.categoryProductPreview.product.id + "]']").prettyPhoto({
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
                                        // $('body').addClass('modal-open').css('padding-right', '17px');
                                        PRETTY_LOADED = false;
                                    }
                                });
                            },
                            callback: function () {
                                // $('body').removeClass('modal-open').css('padding-right', 0);
                            }
                        });
                    }, 400);
                }
            }
        });

        var preview = new Vue({
            el: '#category-product-preview',
            data: GLOBAL_DATA,
            mounted: function () {
                $("a[rel^='prettyPhoto[category-" + GLOBAL_DATA.categoryProductPreview.product.id + "]']").prettyPhoto({
                    theme: 'facebook',
                    slideshow: 5000,
                    autoplay_slideshow: false,
                    social_tools: false,
                    deeplinking: false,
                    ajaxcallback: function () {
                        var PRETTY_LOADED = true;
                        $('#prod-preview-test').modal('hide');
                        $('#prod-preview-test').on('hidden.bs.modal', function () {
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
            },
            methods: {
                //method handles onChange count input
                toInteger: function (count) {
                    var searchObj = {
                            productId: GLOBAL_DATA.categoryProductPreview.product.id,
                            sizeId: GLOBAL_DATA.categoryProductPreview.currentSizeId
                        },
                        _this = this;

                    if (count < 1 || count == '') {
                        GLOBAL_DATA.categoryProductPreview.count = 1;
                    }

                    GLOBAL_DATA.categoryProductPreview.product.product_sizes.forEach(function (item) {
                        if (item.product_id == searchObj.productId && item.size_id == searchObj.sizeId) {
                            if (count > item.stocks[0].stock)
                            {
                                GLOBAL_DATA.categoryProductPreview.count = item.stocks[0].stock > 0 ? item.stocks[0].stock : 1;
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

                            _this.updateCart(searchObj.productId, searchObj.sizeId, GLOBAL_DATA.categoryProductPreview.count);

                        }, 400);
                    }
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

                    if (GLOBAL_DATA.categoryProductPreview.inStock) {
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
                                    $('#prod-preview-test').modal('hide');
                                    $('#prod-preview-test').on('hidden.bs.modal', function () {
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
                            $('#prod-preview-test').modal('hide');
                            $('#prod-preview-test').on('hidden.bs.modal', function () {
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
                            $('#prod-preview-test').modal('hide');
                            $('#prod-preview-test').on('hidden.bs.modal', function () {
                                if (LOADED) {
                                    $('[data-notify]').modal();
                                    // $('body').addClass('modal-open').css('padding-right', '17px');
                                    LOADED = false;
                                }
                            });
                    }
                },
                //
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
                    GLOBAL_DATA.categoryProductPreview.currentSizeId = sizeId;

                    checkPreviewCategoryStock ()

                    if (this.findWhere(GLOBAL_DATA.cartItems, ({
                            productId: GLOBAL_DATA.categoryProductPreview.product.id,
                            sizeId: GLOBAL_DATA.categoryProductPreview.currentSizeId
                        }))) {
                        //looping cartItems
                        GLOBAL_DATA.cartItems.forEach(function (item) {
                            //check if current active size id in cart
                            if (item.productId == GLOBAL_DATA.categoryProductPreview.product.id && item.sizeId == GLOBAL_DATA.categoryProductPreview.currentSizeId) {
                                //then setting count
                                GLOBAL_DATA.categoryProductPreview.count = item.count;
                            }
                        });
                    }
                    else {
                        GLOBAL_DATA.categoryProductPreview.count = 1;
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
                            productId: GLOBAL_DATA.categoryProductPreview.product.id,
                            sizeId: GLOBAL_DATA.categoryProductPreview.currentSizeId
                        },
                        _this = this;

                    var oldCount = GLOBAL_DATA.categoryProductPreview.count;

                    GLOBAL_DATA.categoryProductPreview.product.product_sizes.forEach(function (item) {
                        if (item.product_id == searchObj.productId && item.size_id == searchObj.sizeId) {
                            if (GLOBAL_DATA.categoryProductPreview.count < item.stocks[0].stock) {
                                GLOBAL_DATA.categoryProductPreview.count++;
                            }
            
                            if (GLOBAL_DATA.categoryProductPreview.count == item.stocks[0].stock ) {
                                showPopup(CART_MAX);
                            }
                        }
                    });

                    if (GLOBAL_DATA.categoryProductPreview.count > 9999) {
                        GLOBAL_DATA.categoryProductPreview.count = 9999;
                    }

                    //check if size id in cart
                    if (_this.findWhere(GLOBAL_DATA.cartItems, searchObj)) {
                        //check if old count != new count
                        if (oldCount != GLOBAL_DATA.categoryProductPreview.count) {
                            //then send update ajax
                            if (_this.timer) {
                                clearTimeout(_this.timer);
                                _this.timer = undefined;
                            }
                            _this.timer = setTimeout(function () {

                                _this.updateCart(searchObj.productId, searchObj.sizeId, GLOBAL_DATA.categoryProductPreview.count);

                            }, 400);
                        }
                    }
                },
                //method handles - button decrementing value
                decrement: function () {
                    var searchObj = {
                            productId: GLOBAL_DATA.categoryProductPreview.product.id,
                            sizeId: GLOBAL_DATA.categoryProductPreview.currentSizeId
                        },
                        _this = this;

                    var oldCount = GLOBAL_DATA.categoryProductPreview.count;

                    GLOBAL_DATA.categoryProductPreview.count--;

                    if (GLOBAL_DATA.categoryProductPreview.count < 1) {
                        GLOBAL_DATA.categoryProductPreview.count = 1;
                    }

                    //check if size id in cart
                    if (_this.findWhere(GLOBAL_DATA.cartItems, searchObj)) {
                        //check if old count != new count
                        if (oldCount != GLOBAL_DATA.categoryProductPreview.count) {
                            //then send update ajax
                            if (_this.timer) {
                                clearTimeout(_this.timer);
                                _this.timer = undefined;
                            }
                            _this.timer = setTimeout(function () {

                                _this.updateCart(searchObj.productId, searchObj.sizeId, GLOBAL_DATA.categoryProductPreview.count);

                            }, 400);
                        }
                    }
                },

                CurrentSizeId: function (sizeId) {
                    GLOBAL_DATA.categoryProductPreview.currentSizeId = 5;

                    checkPreviewCategoryStock ()

                    if (this.findWhere(GLOBAL_DATA.cartItems, ({
                        productId: GLOBAL_DATA.categoryProductPreview.product.id,
                        sizeId: GLOBAL_DATA.categoryProductPreview.currentSizeId
                    }))) {
                        //looping cartItems
                        GLOBAL_DATA.cartItems.forEach(function (item) {
                            //check if current active size id in cart
                            if (item.productId == GLOBAL_DATA.categoryProductPreview.product.id && item.sizeId == GLOBAL_DATA.categoryProductPreview.currentSizeId) {
                                //then setting count
                                GLOBAL_DATA.categoryProductPreview.count = item.count;
                            }
                        });
                    }
                    else {
                        GLOBAL_DATA.categoryProductPreview.count = 1;
                    }
                },
            }
        });
    }
}