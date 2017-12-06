/**
 * Created by vlad_ on 13.10.2017.
 */
var LANGUAGE = $('html').attr('lang'),
    DEFAULT_LANGUAGE = 'ru';

var INIT_CART_WS;

var INCORRECT_FIELD_CLASS = 'incorrect-field',
    REQUIRED_FIELD_TEXT = (LANGUAGE == DEFAULT_LANGUAGE) ? 'Обязательное поле' : 'Обов`язкове поле',
    INCORRECT_FIELD_TEXT = (LANGUAGE == DEFAULT_LANGUAGE) ? 'Неправильные данные' : 'Невірно введені дані',
    SERVER_ERROR = (LANGUAGE == DEFAULT_LANGUAGE) ? 'Произошла ошибка, попробуйте еще.' : 'Сталася помилка, спробуйте ще.',
    EMAIL_NOT_VALID = (LANGUAGE == DEFAULT_LANGUAGE) ? 'Пользователь c таким e-mail уже существует.' : 'Користувач з таким e-mail вже існує.',
    EMAIL_CONFIRM_NOT_VALID = (LANGUAGE == DEFAULT_LANGUAGE) ? 'E-mail не подтвержден.' : 'E-mail не підтверджено.',
    EMAIL_NOT_EXISTS = (LANGUAGE == DEFAULT_LANGUAGE) ? 'Такой e-mail не существует.' : 'Такого e-mail не існує.',
    REGISTER_SUCCESS = (LANGUAGE == DEFAULT_LANGUAGE) ? 'Регистрация прошла успешно, на указанный e-mail отправлено письмо для подтверждения.' : 'Реєстрація пройшла успішно, на вказаний e-mail відправлено лист для підтвердження.',
    RESTORE_SUCCESS = (LANGUAGE == DEFAULT_LANGUAGE) ? 'На ваш e-mail отправлено письмо с паролем для входа.' : 'На ваш e-mail відправлено лист з паролем для входу.';




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
    categoryProducts: [],
    categoryProductPreview: {
        product: [],
        currentSizeId: '',
        count: '',
        rel: ''
    },
    similarProducts: [],
    similarProductPreview: {
        product: [],
        currentSizeId: '',
        count: '',
        rel: ''
    },
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

//URL FOR SEARCH
function buildSearchUrl(series)
{
    series = series
        .toLowerCase()
        .replace(/[^a-zA-Zа-яА-ЯїЇіІьЬєЄэЭъЪёЁґҐ0-9 ]/gi, ' ')
        .replace(/\s+/g, ' ')
        .trim()
        .replace(/\s/g, '+');

    return series;
}


function showLoader() {
    // $('body').addClass('modal-open').css('padding-right', '17px');
    $('[data-big-loader]').fadeIn(400);
}

function hideLoader() {
    $('[data-big-loader]').fadeOut(400);
    // $('[data-big-loader]').hide();
    // $('body').removeClass('modal-open').css('padding-right', 0);
}

function showPopup(message) {
    var popup = $('[data-popup]'),
        popupMessage = $('[data-popup-text]');
    popupMessage.text(message);
    popup.modal();
}

function hidePopup() {
    var popup = $('[data-popup]'),
        popupMessage = $('[data-popup-text]');
    // popup.modal('hide');
    popupMessage.text('');
}

$('body').on('click', '[data-popup-close]', function () {
    hidePopup();
});

$('body').on('click', '[data-popup]', function (e) {
    if ($(e.target).hasClass('pop-up-messege'))
    {
        hidePopup();
    }
});

$('#sort-select').on('changed.bs.select', function (e, clickedIndex) {
    // do something...
    window.location.href = $(e.currentTarget[clickedIndex]).attr('data-url');
});

$(window).load(function () {
    
});

$(document).ready(
    function () {
        var wasHidden = false;
        $('.open-search').click(function() {
            var i = $(this).find('i');
            if (!wasHidden)
            {
                $('.open-search').css('border', '2px solid #000');
                $('.navbar-nav').hide(50);
                $('.profile-search-smoll').stop().show().animate({
                    width: '600px'
                });
                $('.profile-search-smoll input').focus();

                i.removeClass('fa-search').addClass('fa-times');
            }
            else
            {
                i.removeClass('fa-times').addClass('fa-search');
                $('.profile-search-smoll').animate({
                    width: '0'
                }, function(){
                    $('.navbar-nav').show(50);
                    $('.open-search-this-none').fadeIn(100);
                    $('.profile-search-smoll').stop().hide();
                    $('.open-search').css('border', 'none');
                });
            }

            wasHidden =! wasHidden

        });
    }
);



