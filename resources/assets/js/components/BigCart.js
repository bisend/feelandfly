new Vue({
    el: '#big-cart',
    data: GLOBAL_DATA,
    methods: {
        //method handles onChange count input
        toInteger: function (productId, sizeId, count) {
            var _this = this;

            if (count < 1 || count == '')
            {
                count = 1;
            }

            if (count > 99)
            {
                count = 99;
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
        }
    }
});