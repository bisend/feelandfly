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
    RESTORE_SUCCESS = (LANGUAGE == DEFAULT_LANGUAGE) ? 'На ваш e-mail отправлено письмо с паролем для входа.' : 'На ваш e-mail відправлено лист з паролем для входу.',
    ORDER_CREATED_MESSAGE = (LANGUAGE == DEFAULT_LANGUAGE) ? 'Заказ принят. Скоро с вами свяжется наш менеджер.' : 'Замовлення прийнято. Незабаром з вами зв\'яжеться наш менеджер.',
    PERSONAL_INFO_SAVED = (LANGUAGE == DEFAULT_LANGUAGE) ? 'Данные сохранены.' : 'Дані збережено.',
    EMAIL_CHANGED_MESSAGE = (LANGUAGE == DEFAULT_LANGUAGE) ? 'Данные сохранены. Вы изменили e-mail, Вам отправлено письмо для подтверждения нового електронного адреса.' : 'Дані збережено. Ви змінили e-mail, Вам відправлено лист для підтвердження нової електронної адреси.',
    PASSWORD_CHANGED_MESSAGE = (LANGUAGE == DEFAULT_LANGUAGE) ? 'Пароль сохранен.' : 'Пароль змінено.',
    WRONG_OLD_PASSWORD = (LANGUAGE == DEFAULT_LANGUAGE) ? 'Неверный старый пароль.' : 'Неправильний старий пароль.',
    REVIEW_ADDED = (LANGUAGE == DEFAULT_LANGUAGE) ? 'Спасибо! Модератор пересмотрит Ваш отзыв, после чего он появится на сайте.' : 'Дякуємо! Модератор перегляне Ваш відгук, після чого він з`явиться на сайті.';

if (window.location.hash && window.location.hash == '#_=_') {
    if (window.history && history.pushState) {
        window.history.pushState("", document.title, window.location.pathname);
    } else {
        // Prevent scrolling by storing the page's current scroll offset
        var scroll = {
            top: document.body.scrollTop,
            left: document.body.scrollLeft
        };
        window.location.hash = '';
        // Restore the scroll offset, should be flicker free
        document.body.scrollTop = scroll.top;
        document.body.scrollLeft = scroll.left;
    }
}

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
    orderConfirm: {
        name: '',
        phone: '',
        email: '',
        address: '',
        comment: '',
        paymentId: '',
        deliveryId: ''
    },
    wishListItems: [],
    wishListPagination: {
        page: 1,
        itemsPerPage: 5,
        startIndex: 0,
        endIndex: 5,
        isPrev: false,
        isNext: false
    },
    review: {
        rating: 0,
        hoverRating: 0,
        tempRating: 0,
        validatedFalse: false,
        name: '',
        email: '',
        text: ''
    },
    wishListPages: [],
    wishListCurrentPage: 1,
    totalCount: 0,
    totalAmount: 0,
    totalWishListCount: 0,
    
    reviewsPages: [],
    reviewIsPrev: false,
    reviewIsNext: false,
    totalReviewsCount: 0,
    reviewsCurrentPage: 1,
    reviews: [],
    
    INIT_CART_ENDED: false,
    IS_DATA_PROCESSING: false,
    timer: undefined,
    user: null,
    profile: null,
    wishList: null,
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
                GLOBAL_DATA.profile = data.profile;
                GLOBAL_DATA.wishList = data.wishList;
                GLOBAL_DATA.wishListItems = data.wishListItems;
                GLOBAL_DATA.totalWishListCount = data.totalWishListCount;

                if (GLOBAL_DATA.user)
                {
                    GLOBAL_DATA.orderConfirm.name = GLOBAL_DATA.user.name;
                    GLOBAL_DATA.orderConfirm.email = GLOBAL_DATA.user.email;
                    GLOBAL_DATA.orderConfirm.phone = data.profile.phone_number;
                    GLOBAL_DATA.orderConfirm.address = data.profile.address_delivery;

                    if (data.profile.payment_id != null)
                    {
                        GLOBAL_DATA.orderConfirm.paymentId = data.profile.payment_id;
                    }

                    if (data.profile.delivery_id != null)
                    {
                        GLOBAL_DATA.orderConfirm.deliveryId = data.profile.delivery_id;
                    }

                    GLOBAL_DATA.review.name = GLOBAL_DATA.user.name;
                    GLOBAL_DATA.review.email = GLOBAL_DATA.user.email;
                }
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

$('body').on('click', '[data-restore-password-button]', function (e) {
    var RESTORE_PASS_CLICKED = true;

    $('#login-popup').modal('hide');

    $('#login-popup').on('hidden.bs.modal', function () {
        if (RESTORE_PASS_CLICKED)
        {
            $('[data-restore-password]').modal();
        }
        RESTORE_PASS_CLICKED = false;
    });
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

        $('.open-drop-profile-nav').on('focusin', function () {
            $('.drop-nav-profile').slideDown(300);
        });

        $('.open-drop-profile-nav').on('focusout', function () {
            $('.drop-nav-profile').slideUp(300);
        });

    });

$(window).load(function () {
    if (window.FFShop && window.FFShop.social_email && window.FFShop.social_email.isEmail == false)
    {
        $('[data-social-email]').modal();
        // $('[data-popup]').modal();
    }

    if (window.FFShop && window.FFShop.isOrderCreated && window.FFShop.isOrderCreated == true)
    {
        showPopup(ORDER_CREATED_MESSAGE);
    }
});

