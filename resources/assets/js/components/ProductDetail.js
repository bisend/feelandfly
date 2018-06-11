if (document.getElementById('product-details'))
{
    let sync1Product, sync2Product, navSpeedThumbs = 500;

    function initPreviewProductSlider () {
        //Resize carousels in modal

        sync1Product = $("[data-single-product-container] .sync1");
        sync2Product = $("[data-single-product-container] .sync2");

        sync2Product.owlCarousel({
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

        sync1Product.owlCarousel({
                rtl: false,
                items: 1,
                navSpeed: 1000,
                nav: false,
                onChanged: syncPosition,
                responsiveRefreshRate: 200

            });

        function syncPosition(el) {
            let current = this._current;
            sync2Product
                .find(".owl-item")
                .removeClass("synced")
                .eq(current)
                .addClass("synced");
            center(current);
        }

        sync2Product.on("click", ".owl-item", function (e) {
            e.preventDefault();
            let number = $(this).index();
            sync1Product.trigger("to.owl.carousel", [number, 1000, true]);
            return false;
        });

        function center(num) {

            let sync2visible = sync2Product.find('.owl-item.active').map(function () {
                return $(this).index();
            });

            if ($.inArray(num, sync2visible) === -1) {
                if (num > sync2visible[sync2visible.length - 1]) {
                    sync2Product.trigger("to.owl.carousel", [num - sync2visible.length + 2, navSpeedThumbs, true]);
                } else {
                    sync2Product.trigger("to.owl.carousel", Math.max(0, num - 1));
                }
            } else if (num === sync2visible[sync2visible.length - 1]) {
                sync2Product.trigger("to.owl.carousel", [sync2visible[1], navSpeedThumbs, true]);
            } else if (num === sync2visible[0]) {
                sync2Product.trigger("to.owl.carousel", [Math.max(0, num - 1), navSpeedThumbs, true]);
            }
        }
    }

    $(document).ready(function () {
        initPreviewProductSlider();
    });

    //init single product
    GLOBAL_DATA.singleProduct.product = window.FFShop.product;
    //init single product id
    GLOBAL_DATA.singleProduct.productId = parseInt(window.FFShop.product.id);
    //init single size id [first id in list]
    GLOBAL_DATA.singleProduct.sizeId = parseInt(window.FFShop.product.sizes[0].id);

    GLOBAL_DATA.singleProduct.product.product_sizes.forEach(function (item) {
        if (item.size_id == GLOBAL_DATA.singleProduct.sizeId) {
            if (item.stocks[0].stock > 0) {
                GLOBAL_DATA.singleProduct.inStock = true;
            } else {
                GLOBAL_DATA.singleProduct.inStock = false;
            }
        }
    });

    new Vue({
        el: '#product-details',
        data: GLOBAL_DATA,
        mounted: function () {
            $('#product-details .ttip:not(.tooltipstered)').tooltipster({
                theme: 'tooltipster-borderless'
            });
        },
        watch: {
            // check if INIT CART AJAX ENDED, if true set count from cart
            INIT_CART_ENDED: function (INIT_CART_ENDED) {
                if (INIT_CART_ENDED)
                {
                    //looping cartItems
                    GLOBAL_DATA.cartItems.forEach(function (item) {
                        //check if current prod id and size id in cartItems
                        if (item.productId == GLOBAL_DATA.singleProduct.productId && item.sizeId == GLOBAL_DATA.singleProduct.sizeId)
                        {
                            //if true setting current COUNT of item from cart
                            GLOBAL_DATA.singleProduct.count = item.count;
                        }
                    });
                }
            }
        },
        methods: {
            //method handles onChange count input
            toInteger: function (count) {
                var searchObj = {
                    productId: GLOBAL_DATA.singleProduct.productId,
                    sizeId: GLOBAL_DATA.singleProduct.sizeId
                },
                    _this = this;

                if (count < 1 || count == '')
                {
                    GLOBAL_DATA.singleProduct.count = 1;
                }

                GLOBAL_DATA.singleProduct.product.product_sizes.forEach(function (item) {
                    if (item.product_id == searchObj.productId && item.size_id == searchObj.sizeId) {
                        if (count > item.stocks[0].stock)
                        {
                            GLOBAL_DATA.singleProduct.count = item.stocks[0].stock > 0 ? item.stocks[0].stock : 1;
                            showPopup(CART_MAX);
                        }
                    }
                });
                
                //if prod size in cart
                if (this.findWhere(GLOBAL_DATA.cartItems, searchObj))
                {
                    //then update cart
                    if (_this.timer)
                    {
                        clearTimeout(_this.timer);
                        _this.timer = undefined;
                    }
                    _this.timer = setTimeout(function () {

                        _this.updateCart(searchObj.productId, searchObj.sizeId, GLOBAL_DATA.singleProduct.count);

                    }, 400);
                }
            },
            //method handles search in cartItems return true|false
            findWhere: function (list, props) {
                var idx = 0;
                var len = list.length;
                var match = false;
                var item, item_k, item_v, prop_k, prop_val;
                for (; idx<len; idx++) {
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
            //method handles current active size id
            changeSizeId: function (sizeId) {
                GLOBAL_DATA.singleProduct.sizeId = parseInt(sizeId);

                GLOBAL_DATA.singleProduct.count = 1;

                GLOBAL_DATA.notify.sizeId = parseInt(sizeId);

                GLOBAL_DATA.singleProduct.product.product_sizes.forEach(function (item) {
                    if (item.size_id == sizeId) {
                        if (item.stocks[0].stock > 0) {
                            GLOBAL_DATA.singleProduct.inStock = true;
                        } else {
                            GLOBAL_DATA.singleProduct.inStock = false;
                        }
                    }
                });

                //looping cartItems
                GLOBAL_DATA.cartItems.forEach(function (item) {
                    //check if current active size id in cart
                    if (item.productId == GLOBAL_DATA.singleProduct.productId && item.sizeId == parseInt(sizeId))
                    {
                        //then setting count
                        GLOBAL_DATA.singleProduct.count = item.count;
                    }
                });
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

                if (GLOBAL_DATA.singleProduct.inStock) {
                    if (_this.findWhere(GLOBAL_DATA.cartItems, searchObj) == null)
                    {
                        if (GLOBAL_DATA.IS_DATA_PROCESSING)
                        {
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
                                //check if this item not in cart yet
                                // if (_this.findWhere(GLOBAL_DATA.cartItems, searchObj) == null)
                                // {
                                //     //then push this item to global cart items
                                //     GLOBAL_DATA.cartItems.push(obj);
                                // }
    
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
            //method handles updating cart, change count
            updateCart: function (productId, sizeId, count) {
                if (GLOBAL_DATA.IS_DATA_PROCESSING)
                {
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
                    productId: GLOBAL_DATA.singleProduct.productId,
                    sizeId: GLOBAL_DATA.singleProduct.sizeId
                },
                    _this = this;

                var oldCount = GLOBAL_DATA.singleProduct.count;
                
                GLOBAL_DATA.singleProduct.product.product_sizes.forEach(function (item) {
                    if (item.product_id == searchObj.productId && item.size_id == searchObj.sizeId) {
                        if (GLOBAL_DATA.singleProduct.count < item.stocks[0].stock) {
                            GLOBAL_DATA.singleProduct.count++;
                        }

                        if (GLOBAL_DATA.singleProduct.count == item.stocks[0].stock ) {
                            showPopup(CART_MAX);
                        }
                    }
                });
            
                

                if (GLOBAL_DATA.singleProduct.count > 9999)
                {
                    GLOBAL_DATA.singleProduct.count = 9999;
                }
                
                //check if size id in cart
                if (this.findWhere(GLOBAL_DATA.cartItems, searchObj))
                {
                    //check if old count != new count
                    if (oldCount != GLOBAL_DATA.singleProduct.count)
                    {
                        //then send update ajax
                        if (_this.timer) {
                            clearTimeout(_this.timer);
                            _this.timer = undefined;
                        }
                        _this.timer = setTimeout(function () {

                            _this.updateCart(searchObj.productId, searchObj.sizeId, GLOBAL_DATA.singleProduct.count);

                        }, 400);
                    }
                }
            },
            //method handles - button decrementing value
            decrement: function () {
                var searchObj = {
                    productId: GLOBAL_DATA.singleProduct.productId,
                    sizeId: GLOBAL_DATA.singleProduct.sizeId
                },
                    _this = this;

                var oldCount = GLOBAL_DATA.singleProduct.count;

                GLOBAL_DATA.singleProduct.count--;

                if (GLOBAL_DATA.singleProduct.count < 1)
                {
                    GLOBAL_DATA.singleProduct.count = 1;
                }
                
                //check if size id in cart
                if (this.findWhere(GLOBAL_DATA.cartItems, searchObj))
                {
                    //check if old count != new count
                    if (oldCount != GLOBAL_DATA.singleProduct.count)
                    {
                        //then send update ajax
                        if (_this.timer)
                        {
                            clearTimeout(_this.timer);
                            _this.timer = undefined;
                        }
                        _this.timer = setTimeout(function () {

                            _this.updateCart(searchObj.productId, searchObj.sizeId, GLOBAL_DATA.singleProduct.count);

                        }, 400);
                    }
                }
            },
            addToWishList: function (productId, sizeId, wishListId) {
                var obj = {
                        productId: parseInt(productId),
                        sizeId: parseInt(sizeId)
                    },
                    _this = this;

                if (_this.findWhere(GLOBAL_DATA.wishListItems, obj) == null)
                {
                    if (GLOBAL_DATA.IS_DATA_PROCESSING)
                    {
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
            scrollToReview() {
                $("a[href='#prod-tab-1']").closest('li').removeClass('active');

                $('#prod-tab-1').removeClass('active in');

                $("a[href='#prod-tab-2']").closest('li').addClass('active');

                $('#prod-tab-2').addClass('active in');

                $('html, body').animate({
                    scrollTop: ($("[data-review-form]").offset().top) - 150
                }, 600);
            }
        }
    });
}

$(window).load(function(){
    $("[data-single-product-container] .sync2").on('initialize.owl.carousel', function( event ){
        fixedSize();
    });

    function fixedSize(){
        sync2Product.find(".item-smoll .owl-stage .owl-item").each(function(i, item){
            var $item = $(item),
                $itemW = $item.outerWidth();
            $item.css("height", $itemW);
        })
    };


});

$(document).ready(function () {
    GLOBAL_DATA.singleProduct.sizeId = parseInt(5);
    GLOBAL_DATA.notify.sizeId = parseInt(5);
    GLOBAL_DATA.singleProduct.inStock = true;
});