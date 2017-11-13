/**
 * Created by vlad_ on 13.10.2017.
 */
var LANGUAGE = $('html').attr('lang'),
    DEFAULT_LANGUAGE = 'ru';

var INIT_CART_WS;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var GLOBAL_DATA = {
    singleProduct: {
        product: [],
        productId: '',
        sizeId: '',
        count: 1
    },
    cartItems: [],
    cartProducts: [],
    totalCount: 0,
    totalAmount: 0,
    INIT_CART_ENDED: false,
    IS_DATA_PROCESSING: false,
    timer: undefined,
    user: null,
    userTypeId: 1
};

function initCart() {

    INIT_CART_WS = new WaitSync(function () {

        if (GLOBAL_DATA.IS_DATA_PROCESSING)
        {
            return false;
        }

        GLOBAL_DATA.IS_DATA_PROCESSING = true;

        $.ajax({
            type: 'post',
            url: '/cart/init-cart',
            data: {
                language: LANGUAGE,
                userTypeId: GLOBAL_DATA.userTypeId
            },
            success: function (data) {
                GLOBAL_DATA.IS_DATA_PROCESSING = false;
                GLOBAL_DATA.INIT_CART_ENDED = true;
                GLOBAL_DATA.cartItems = data.cart;
                GLOBAL_DATA.cartProducts = data.cartProducts;
                GLOBAL_DATA.totalCount = data.totalCount;
                GLOBAL_DATA.totalAmount = data.totalAmount;
            },
            error: function (error) {
                GLOBAL_DATA.IS_DATA_PROCESSING = false;
                GLOBAL_DATA.INIT_CART_ENDED = true;
                console.log(error);
            }
        });
    });
}

initCart();

function getUser() {
    $.ajax({
        type: 'post',
        url: '/get-user',
        data: {
            language: LANGUAGE
        },
        success: INIT_CART_WS.wrap(
            'initCart',
            function (data) {
                GLOBAL_DATA.user = data.user;
                GLOBAL_DATA.userTypeId = data.userTypeId;
            }
        ),
        error: INIT_CART_WS.wrap(
            'initCart',
            function (error) {
                console.log(error);
            }
        )
    });
}

getUser();

function showLoader() {
    // $('body').addClass('modal-open').css('padding-right', '17px');
    $('[data-big-loader]').fadeIn(400);
}

function hideLoader() {
    $('[data-big-loader]').fadeOut(400);
    // $('[data-big-loader]').hide();
    // $('body').removeClass('modal-open').css('padding-right', 0);
}

$(window).load(function () {
    // showLoader();

    // setTimeout(function () {
    //     hideLoader();
    // }, 5000);
});