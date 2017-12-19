if (document.getElementById('product-details'))
{
    //init single product
    GLOBAL_DATA.singleProduct.product = window.FFShop.product;
    //init single product id
    GLOBAL_DATA.singleProduct.productId = parseInt(window.FFShop.product.id);
    //init single size id [first id in list]
    GLOBAL_DATA.singleProduct.sizeId = parseInt(window.FFShop.product.sizes[0].id);

    new Vue({
        el: '#product-details',
        data: GLOBAL_DATA,
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

                if (count > 99)
                {
                    GLOBAL_DATA.singleProduct.count = 99;
                }
                
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

                GLOBAL_DATA.singleProduct.count++;

                if (GLOBAL_DATA.singleProduct.count > 99)
                {
                    GLOBAL_DATA.singleProduct.count = 99;
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
        }
    });
}