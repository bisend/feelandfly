if (document.getElementById('grid-view'))
{
    //init category products
    GLOBAL_DATA.categoryProducts = window.FFShop.products;

    //init currentSizeId for categoryProducts
    GLOBAL_DATA.categoryProducts.forEach(function (item) {
        item.currentSizeId = item.sizes[0].id;
    });
    
    //init category product preview (first product) from categoryProducts
    GLOBAL_DATA.categoryProductPreview.product = GLOBAL_DATA.categoryProducts[0];
    
    //init category product preview rel for pretty photo
    GLOBAL_DATA.categoryProductPreview.rel = 'prettyPhoto[category-' + GLOBAL_DATA.categoryProducts[0].id + ']';
    
    //init category product preview currentSizeId
    GLOBAL_DATA.categoryProductPreview.currentSizeId = GLOBAL_DATA.categoryProductPreview.product.sizes[0].id;
    
    //init category product preview count
    GLOBAL_DATA.categoryProductPreview.count = 1;

    var gridView = new Vue({
        el: '#grid-view',
        data: GLOBAL_DATA,
        methods: {
            //check if props in list
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
            //changing currentSizeId of category product
            changeCurrentSizeId: function (counter, sizeId) {
                GLOBAL_DATA.categoryProducts[counter].currentSizeId = sizeId;
            },
            //changing category product preview
            changeCategoryProductPreview: function (counter) {
                GLOBAL_DATA.categoryProductPreview.product = GLOBAL_DATA.categoryProducts[counter];

                GLOBAL_DATA.categoryProductPreview.rel = 'prettyPhoto[category-' + GLOBAL_DATA.categoryProductPreview.product.id + ']';

                GLOBAL_DATA.categoryProductPreview.currentSizeId = GLOBAL_DATA.categoryProductPreview.product.sizes[0].id;
                
                //init count checking if current preview in cart
                if (this.findWhere(GLOBAL_DATA.cartItems, ({productId: GLOBAL_DATA.categoryProductPreview.product.id, sizeId: GLOBAL_DATA.categoryProductPreview.currentSizeId})))
                {
                    //looping cartItems
                    GLOBAL_DATA.cartItems.forEach(function (item) {
                        //check if current active size id in cart
                        if (item.productId == GLOBAL_DATA.categoryProductPreview.product.id && item.sizeId == GLOBAL_DATA.categoryProductPreview.currentSizeId)
                        {
                            //then setting count
                            GLOBAL_DATA.categoryProductPreview.count = item.count;
                        }
                    });
                }
                else
                {
                    GLOBAL_DATA.categoryProductPreview.count = 1;
                }
                
                //container with preview
                var $container = $('#prod-preview-test');

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
                                $('body').addClass('modal-open').css('padding-right', '17px');
                                PRETTY_LOADED = false;
                            }
                        });
                    },
                    callback: function () {
                        $('body').removeClass('modal-open').css('padding-right', 0);
                    }
                });

                $container.modal();
            }
        }
    });

    var productPreview = new Vue({
        el: '#category-product-preview',
        data: GLOBAL_DATA,
        methods: {
            //method handles onChange count input
            toInteger: function (count) {
                var searchObj = {
                        productId: GLOBAL_DATA.categoryProductPreview.product.id,
                        sizeId: GLOBAL_DATA.categoryProductPreview.currentSizeId
                    },
                    _this = this;

                if (count < 1 || count == '')
                {
                    GLOBAL_DATA.categoryProductPreview.count = 1;
                }

                if (count > 99)
                {
                    GLOBAL_DATA.categoryProductPreview.count = 99;
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

                            GLOBAL_DATA.cartItems = data.cart;
                            GLOBAL_DATA.totalCount = data.totalCount;
                            GLOBAL_DATA.totalAmount = data.totalAmount;

                            var LOADED = true;
                            $('#prod-preview-test').modal('hide');
                            $('#prod-preview-test').on('hidden.bs.modal', function () {
                                if (LOADED)
                                {
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
                        if (LOADED)
                        {
                            $('#big-cart').modal();
                            // $('body').addClass('modal-open').css('padding-right', '17px');
                            LOADED = false;
                        }
                    });
                }
            },
            //changing current sizeId in preview
            changeCurrentSizeId: function (sizeId) {
                GLOBAL_DATA.categoryProductPreview.currentSizeId = sizeId;

                if (this.findWhere(GLOBAL_DATA.cartItems, ({productId: GLOBAL_DATA.categoryProductPreview.product.id, sizeId: GLOBAL_DATA.categoryProductPreview.currentSizeId})))
                {
                    //looping cartItems
                    GLOBAL_DATA.cartItems.forEach(function (item) {
                        //check if current active size id in cart
                        if (item.productId == GLOBAL_DATA.categoryProductPreview.product.id && item.sizeId == GLOBAL_DATA.categoryProductPreview.currentSizeId)
                        {
                            //then setting count
                            GLOBAL_DATA.categoryProductPreview.count = item.count;
                        }
                    });
                }
                else
                {
                    GLOBAL_DATA.categoryProductPreview.count = 1;
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
                        productId: GLOBAL_DATA.categoryProductPreview.product.id,
                        sizeId: GLOBAL_DATA.categoryProductPreview.currentSizeId
                    },
                    _this = this;

                var oldCount = GLOBAL_DATA.categoryProductPreview.count;

                GLOBAL_DATA.categoryProductPreview.count++;

                if (GLOBAL_DATA.categoryProductPreview.count > 99)
                {
                    GLOBAL_DATA.categoryProductPreview.count = 99;
                }

                //check if size id in cart
                if (_this.findWhere(GLOBAL_DATA.cartItems, searchObj))
                {
                    //check if old count != new count
                    if (oldCount != GLOBAL_DATA.categoryProductPreview.count)
                    {
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

                if (GLOBAL_DATA.categoryProductPreview.count < 1)
                {
                    GLOBAL_DATA.categoryProductPreview.count = 1;
                }

                //check if size id in cart
                if (_this.findWhere(GLOBAL_DATA.cartItems, searchObj))
                {
                    //check if old count != new count
                    if (oldCount != GLOBAL_DATA.categoryProductPreview.count)
                    {
                        //then send update ajax
                        if (_this.timer)
                        {
                            clearTimeout(_this.timer);
                            _this.timer = undefined;
                        }
                        _this.timer = setTimeout(function () {

                            _this.updateCart(searchObj.productId, searchObj.sizeId, GLOBAL_DATA.categoryProductPreview.count);

                        }, 400);
                    }
                }
            }
        }
    });
}
