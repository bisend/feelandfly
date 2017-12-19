if (document.getElementById('profile-wish-list'))
{
    new Vue({
        el: '#profile-wish-list',
        data: GLOBAL_DATA,
        mounted: function () {

        },
        watch: {
            totalWishListCount: function () {
                var _this = this;
                console.log(_this.createPagination(GLOBAL_DATA.wishListPagination.page, GLOBAL_DATA.wishListPagination.itemsPerPage, GLOBAL_DATA.totalWishListCount));
                GLOBAL_DATA.wishListPages = _this.createPagination(GLOBAL_DATA.wishListPagination.page, GLOBAL_DATA.wishListPagination.itemsPerPage, GLOBAL_DATA.totalWishListCount);
                if (GLOBAL_DATA.wishListCurrentPage > Math.ceil(GLOBAL_DATA.totalWishListCount / GLOBAL_DATA.wishListPagination.itemsPerPage))
                {
                    GLOBAL_DATA.wishListCurrentPage -= 1;
                    GLOBAL_DATA.wishListPagination.page -= 1;
                }
            },
            wishListCurrentPage: function () {
                var _this = this;
                GLOBAL_DATA.wishListPages = _this.createPagination(GLOBAL_DATA.wishListPagination.page, GLOBAL_DATA.wishListPagination.itemsPerPage, GLOBAL_DATA.totalWishListCount);

                _this.setIndexes(GLOBAL_DATA.wishListCurrentPage);
            }
        },
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
                        GLOBAL_DATA.totalWishListCount = data.totalWishListCount;
                    },
                    error: function (error) {
                        hideLoader();
                        GLOBAL_DATA.IS_DATA_PROCESSING = false;
                        console.log(error);
                    }
                });
            },
            range: function(low, high, step) {
                var matrix = [];
                var inival, endval, plus;
                var walker = step || 1;
                var chars  = false;

                if ( !isNaN ( low ) && !isNaN ( high ) ) {
                    inival = low;
                    endval = high;
                } else if ( isNaN ( low ) && isNaN ( high ) ) {
                    chars = true;
                    inival = low.charCodeAt ( 0 );
                    endval = high.charCodeAt ( 0 );
                } else {
                    inival = ( isNaN ( low ) ? 0 : low );
                    endval = ( isNaN ( high ) ? 0 : high );
                }

                plus = ( ( inival > endval ) ? false : true );
                if ( plus ) {
                    while ( inival <= endval ) {
                        matrix.push ( ( ( chars ) ? String.fromCharCode ( inival ) : inival ) );
                        inival += walker;
                    }
                } else {
                    while ( inival >= endval ) {
                        matrix.push ( ( ( chars ) ? String.fromCharCode ( inival ) : inival ) );
                        inival -= walker;
                    }
                }

                return matrix;
            },
            createPagination: function (page, itemsPerPage, totalItemsCount) {
                var _this = this;
                var maxElements = 7;
                var pages = [];
                var lastPage = Math.ceil(totalItemsCount / itemsPerPage);
                var minMiddle;
                var maxMiddle;
                var pagesPerBothSides;
                var min;
                var max;
                var pagesPerLeftSide;
                var pagesPerRightSide;

                if (maxElements >= lastPage)
                {
                    pages = _this.range(1, lastPage);
                }
                else
                {
                    minMiddle = Math.ceil(maxElements / 2);
                    maxMiddle = Math.ceil(lastPage - maxElements / 2);

                    if (page > minMiddle)
                    {
                        pages.push(1);
                        pages.push('...');
                    }

                    if (page > minMiddle && page < maxMiddle) {
                        pagesPerBothSides = Math.floor(maxElements / 4);
                        min = page - pagesPerBothSides;
                        max = page + pagesPerBothSides;
                        for (var i = min; i <= max; i++) {
                            pages.push(i);
                        }
                    }
                    else if (page <= minMiddle)
                    {
                        pagesPerLeftSide = maxElements - 2;
                        for (i = 1; i <= pagesPerLeftSide; i++)
                        {
                            pages.push(i);
                        }
                    }
                    else if (page >= maxMiddle)
                    {
                        pagesPerRightSide = maxElements - 3;
                        min = lastPage - pagesPerRightSide;
                        for (i = min; i <= lastPage; i++)
                        {
                            pages.push(i);
                        }
                    }

                    if (page < maxMiddle) {
                        pages.push('...');
                        pages.push(lastPage);
                    }
                }

                if (page == 1) {
                    pages.unshift(false);
                } else {
                    pages.unshift(true);
                }

                if (page == lastPage) {
                    pages.push(false);
                } else {
                    pages.push(true);
                }

                /////////
                GLOBAL_DATA.wishListPagination.isPrev = pages.shift();
                GLOBAL_DATA.wishListPagination.isNext = pages.pop();

                return pages;
            },
            setWishListPage: function (page) {
                GLOBAL_DATA.wishListPagination.page = page;
                GLOBAL_DATA.wishListCurrentPage = page;
            },
            setIndexes: function (page) {
                if (page == 1)
                {
                    GLOBAL_DATA.wishListPagination.startIndex = 0;
                    GLOBAL_DATA.wishListPagination.endIndex = GLOBAL_DATA.wishListPagination.itemsPerPage;
                }
                else
                {
                    GLOBAL_DATA.wishListPagination.startIndex = (page - 1) * GLOBAL_DATA.wishListPagination.itemsPerPage;
                    GLOBAL_DATA.wishListPagination.endIndex = GLOBAL_DATA.wishListPagination.startIndex + GLOBAL_DATA.wishListPagination.itemsPerPage;
                }
            }
        }
    });
}