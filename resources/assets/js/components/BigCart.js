new Vue({
    el: '#big-cart',
    data: GLOBAL_DATA,
    methods: {
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
        //method handles onChange count input
        toInteger: function (productId, sizeId, count) {
            var _this = this;

            if (count < 1 || count == '')
            {
                count = 1;
            }

            GLOBAL_DATA.cartItems.forEach(function (item) {
                if (item.productId == productId && item.sizeId == sizeId)
                {
                    item.product.product_sizes.forEach(function (el) {
                        if (el.product_id == productId && el.size_id == sizeId) {
                            if (count > el.stocks[0].stock ) {
                                count = el.stocks[0].stock;
                                showPopup(CART_MAX);
                            }
                        }
                    });

                    if (count > 9999)
                    {
                        count = 9999;
                    }
                }
            });
            //check if current page single product
            if (document.getElementById('product-details'))
            {
                if (GLOBAL_DATA.singleProduct.productId == productId && GLOBAL_DATA.singleProduct.sizeId == sizeId)
                {
                    GLOBAL_DATA.singleProduct.count = count;
                }
            }
            
            //then update cart
            if (_this.timer)
            {
                clearTimeout(_this.timer);
                _this.timer = undefined;
            }
            _this.timer = setTimeout(function () {

                _this.updateCart(productId, sizeId, count);

            }, 400);
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
        deleteFromCart: function (productId, sizeId) {
            if (GLOBAL_DATA.IS_DATA_PROCESSING)
            {
                return false;
            }

            GLOBAL_DATA.IS_DATA_PROCESSING = true;

            showLoader();

            $.ajax({
                type: 'post',
                url: '/cart/delete-from-cart',
                data: {
                    productId: productId,
                    sizeId: sizeId,
                    language: LANGUAGE,
                    userTypeId: GLOBAL_DATA.userTypeId
                },
                success: function (data) {
                    GLOBAL_DATA.IS_DATA_PROCESSING = false;
                    hideLoader();
                    GLOBAL_DATA.cartItems = data.cart;
                    GLOBAL_DATA.totalCount = data.totalCount;
                    GLOBAL_DATA.totalAmount = data.totalAmount;

                    if (GLOBAL_DATA.cartItems.length < 1)
                    {
                        $('#big-cart').modal('hide');
                    }
                },
                error: function (error) {
                    GLOBAL_DATA.IS_DATA_PROCESSING = false;
                    hideLoader();
                    console.log(error);
                }
            });
        },
        //method handles + button incrementing value
        increment: function (productId, sizeId) {
            var searchObj = {
                    productId: productId,
                    sizeId: sizeId
                },
                _this = this;

            var oldCount;
            var newCount = 1;

            GLOBAL_DATA.cartItems.forEach(function (item) {
                if (item.productId == productId && item.sizeId == sizeId)
                {
                    oldCount = item.count;
                    
                    item.product.product_sizes.forEach(function (el) {
                        if (el.product_id == searchObj.productId && el.size_id == searchObj.sizeId) {
                            item.count++;
    
                            if (item.count > el.stocks[0].stock ) {
                                item.count = el.stocks[0].stock;
                                showPopup(CART_MAX);
                            }
                        }
                    });

                    if (item.count > 9999)
                    {
                        item.count = 9999;
                    }

                    newCount = item.count;
                }
            });

            //check if current page single product
            if (document.getElementById('product-details'))
            {
                if (GLOBAL_DATA.singleProduct.productId == productId && GLOBAL_DATA.singleProduct.sizeId == sizeId)
                {
                    GLOBAL_DATA.singleProduct.count = newCount;
                }
            }

            //check if size id in cart
            if (_this.findWhere(GLOBAL_DATA.cartItems, searchObj))
            {
                //check if old count != new count
                if (oldCount != newCount)
                {
                    //then send update ajax
                    if (_this.timer) {
                        clearTimeout(_this.timer);
                        _this.timer = undefined;
                    }
                    _this.timer = setTimeout(function () {

                        _this.updateCart(searchObj.productId, searchObj.sizeId, newCount);

                    }, 400);
                }
            }
        },
        //method handles - button decrementing value
        decrement: function (productId, sizeId) {
            var searchObj = {
                    productId: productId,
                    sizeId: sizeId
                },
                _this = this;
            var oldCount;
            var newCount = 1;

            GLOBAL_DATA.cartItems.forEach(function (item) {
                if (item.productId == productId && item.sizeId == sizeId)
                {
                    oldCount = item.count;

                    item.count--;

                    if (item.count < 1)
                    {
                        item.count = 1;
                    }

                    newCount = item.count;
                }
            });

            //check if current page single product
            if (document.getElementById('product-details'))
            {
                if (GLOBAL_DATA.singleProduct.productId == productId && GLOBAL_DATA.singleProduct.sizeId == sizeId)
                {
                    GLOBAL_DATA.singleProduct.count = newCount;
                }
            }

            //check if size id in cart
            if (_this.findWhere(GLOBAL_DATA.cartItems, searchObj))
            {
                //check if old count != new count
                if (oldCount != newCount)
                {
                    //then send update ajax
                    if (_this.timer) {
                        clearTimeout(_this.timer);
                        _this.timer = undefined;
                    }
                    _this.timer = setTimeout(function () {

                        _this.updateCart(searchObj.productId, searchObj.sizeId, newCount);

                    }, 400);
                }
            }
        }
    }
});