new Vue({
    el: '#mini-cart',
    data: GLOBAL_DATA,
    methods: {
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
    }
});