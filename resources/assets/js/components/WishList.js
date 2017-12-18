if (document.getElementById('profile-wish-list'))
{
    new Vue({
        el: '#profile-wish-list',
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
            deleteFromWishList: function (wishListProductId) {
                showLoader();

                //ajax
                $.ajax({
                    type: 'post',
                    url: '/profile/delete-from-wish-list',
                    data: {
                        wishListProductId: wishListProductId,
                        wishListId: GLOBAL_DATA.wishList.id,
                        language: LANGUAGE,
                        userTypeId: GLOBAL_DATA.userTypeId
                    },
                    success: function (data) {
                        hideLoader();

                        GLOBAL_DATA.wishListItems = data.wishListItems;
                    },
                    error: function (error) {
                        hideLoader();
                        GLOBAL_DATA.IS_DATA_PROCESSING = false;
                        console.log(error);
                    }
                });
            }
        }
    });
}