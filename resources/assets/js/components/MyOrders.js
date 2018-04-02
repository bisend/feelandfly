if (document.getElementById('profile-my-orders'))
{
    new Vue({
        el: '#profile-my-orders',
        data: {
            orders: window.FFShop.orders,
            page: window.FFShop.page,
            currentOrder: null,
            payments: window.FFShop.payments,
            deliveries: window.FFShop.deliveries,
            totalOrdersCount: window.FFShop.totalOrdersCount,
            myOrdersPages: [],
            isPrev: false,
            isNext: false
        },
        mounted: function () {
            var _this = this;
            _this.currentOrder = window.FFShop.orders[0];
            _this.myOrdersPages = _this.createPagination(_this.page, 5, _this.totalOrdersCount);
        },
        watch: {
            page: function () {
                var _this = this;

                _this.myOrdersPages = _this.createPagination(_this.page, 5, _this.totalOrdersCount);

                _this.getOrders();
            }
        },
        methods: {
            setOrderProducts: function (order) {
                var _this = this;

                _this.currentOrder = order;

                $('#orderDetails').modal();
            },
            setPage: function (page) {
                var _this = this;

                _this.page = page;
            },
            range: function(low, high, step) {
                let matrix = [];
                let inival, endval, plus;
                let walker = step || 1;
                let chars  = false;

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
                let _this = this;
                let maxElements = 7;
                let pages = [];
                let lastPage = Math.ceil(totalItemsCount / itemsPerPage);
                let minMiddle;
                let maxMiddle;
                let pagesPerBothSides;
                let min;
                let max;
                let pagesPerLeftSide;
                let pagesPerRightSide;

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
                _this.isPrev = pages.shift();
                _this.isNext = pages.pop();

                return pages;
            },
            getOrders: function () {
                let _this = this;

                showLoader();

                $.ajax({
                    type: 'post',
                    url: '/profile/my-orders',
                    data: {
                        page: _this.page,
                        language: LANGUAGE
                    },
                    success: function (data) {
                        _this.orders = data.orders;
                        hideLoader();
                    },
                    error: function (data) {
                        hideLoader();
                        showPopup(SERVER_ERROR);
                    }
                });
                
            }
        }
    });
}