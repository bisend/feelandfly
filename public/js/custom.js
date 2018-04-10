// JClientValidation library created by Mukola Shabarovskiy in 2014.
// This library was created for inputs validation

// Regular expressions for validated inputs
// You can to add new item and use it in parameters
var RegularExpressions = {
	NAME: /^[а-яА-ЯёЁіІїЇa-zA-Z]{2,30}$/,                                             // For example "Nicholas" (one word)
	FULL_NAME: /^[а-яА-ЯёЁіІїЇa-zA-Z'`\s,.-]{2,100}$/,                                  // For example "Nicholas Brick" (two words)
	PASSWORD: /^\S{6,20}$/,															// For example word.pass123123 (difficult password)
	SIMPLE_PASSWORD: /^[\w.]{6,20}$/,                                               // For example 123123 (similar password)
	EMAIL: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,	 // For example nicholas.brick@mail.com
	PHONE_NUMBER: /^[0-9\-\(\)\+ ]{5,30}$/,											// For example +38(012) 345-67-89
	PHONE_NUMBER_MOBILE: /^[0-9\-\(\)\+ ]{15,30}$/,											// For example +38(012) 345-67-89
	URL_LINK: /^http:+|https:+.+$/,                                                 // For example http://fs.to
	LETTERS_ONLY: /^[а-яА-ЯёЁіІїЇa-zA-Z]+$/,                                          // Letters only
	SIMPLE_TEXT: /.{2,}\s*/,                                                        // Just simple text (more than two symbols)
	MIN_TEXT: /.{1,}\s*/,                                                           // Just simple text (more than one symbol)
	FILE_PATH: /^[а-яА-ЯёЁіІїЇa-zA-Z]{2,200}$/,                                       // For example drive:\dir\dir\file.ext
	DATE_TIME_R: /^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/,         // For example 2016-04-13 09:41:46
	DATE_RANGE: /^([0-9]{2}\/[0-9]{2}\/[0-9]{4})|([0-9]{2}\/[0-9]{2}\/[0-9]{4} \- [0-9]{2}\/[0-9]{2}\/[0-9]{4})$/, // For example 04/25/2016 or 04/25/2016 - 05/26/2017
	OKPO_CODE: /.{2,}\s*/,                                                          // OKPO code
	POSITIVE_DIGITS: /^[1-9][0-9]*$/,												// Digits greater than 0.
	DIGITS_ONLY: /^[0-9]{1,20}$/                                                    // For digits only
};

// options = {
//      expression : RegExp,                                // Regular expression for validation
//      ChangeOnValid : func(input),                        // Performs when state has been changed on valid
//      ChangeOnInvalid : func(input),                      // Performs when state has been changed on invalid
//      showErrors : boolean,                               // Show errors in placeholder 
//      requiredErrorMessage : string,
//      regExErrorMessage : string,
//      required : boolean                                  // If an input is required
//      autoValidating : boolean                            // Validation on focus out ( blur )
//}
function RegExValidatingInput(input, options) {
	// The context of this object
	var context = this;

	// Input for validation
	this.input = input;

	// Settings object
	this.options = options;

	// Input validation state
	this.isValid = true;

	// Value in memory (for place holder validation)
	this.memoryValue = undefined;

	// Initial placeholder for restore
	this.initialPlaceHolder = undefined;

	// Initial input value for restore
	this.initialValue = this.input.val();

	// Constructor function (initialize object)
	this.Init = function () {
		// Sets default values if they are not set
		context.CheckOptions();

		// FocusOut handler
		context.input.focusout(function () {
			if (context.GetValue().length > 0 && context.options.autoValidating) {
				context.Validate();
			}
		});

		// KeyUp handler
		context.input.on('keyup', function () {
			if (context.GetValue().length == 0) {
				context.input.attr("placeholder", context.initialPlaceHolder);
				if (context.options.ChangeOnValid != undefined) {
					context.options.ChangeOnValid(context.input);
				}
			}
			context.memoryValue = context.input.val();
		});

		// FocusIn handler
		context.input.focusin(function () {
			if (context.options.showErrors == true) {
				if (context.memoryValue != undefined) {
					if (context.memoryValue != undefined) {
						context.input.val(context.memoryValue);
					}
				}
			}
			if (context.options.ChangeOnValid != undefined) {
				context.options.ChangeOnValid(context.input);
			}
			context.input.attr("placeholder", context.initialPlaceHolder);
		});

		// Sets initial placeholder
		context.initialPlaceHolder = context.input.attr("placeholder");
		context.initialPlaceHolder = (context.initialPlaceHolder != undefined ? context.initialPlaceHolder : "");
	};

	// General validation function
	this.Validate = function () {
		// Gets value of input
		var value = context.input.val();

		if (context.options.required) {
			if (context.IsValueCorrect(value, context.options.expression)) {
				context.SetValidState();
			} else {
				context.SetInvalidState();
			}
		} else {
			if (value != "") {
				if (context.IsValueCorrect(value, context.options.expression)) {
					context.SetValidState();
				} else {
					context.SetInvalidState();
				}
			} else {
				context.SetValidState();
			}
		}
	};

	// Idle validation function ( without callbacks )
	this.IdleValidate = function () {
		// Gets value of input
		var value = context.input.val();

		if (context.options.required) {
			if (context.IsValueCorrect(value, context.options.expression)) {
				context.isValid = true;
			} else {
				context.isValid = false;
			}
		} else {
			if (value != "") {
				if (context.IsValueCorrect(value, context.options.expression)) {
					context.isValid = true;
				} else {
					context.isValid = false;
				}
			} else {
				context.isValid = true;
			}
		}
	};

	// Sets valid state of input
	this.SetValidState = function () {
		// Sets valid state
		context.isValid = true;
		// Clears memory value
		context.memoryValue = undefined;
		// Performs handler for valid state
		if (context.options.ChangeOnValid != undefined) {
			context.options.ChangeOnValid(context.input);
		}
	};

	// Sets invalid state of input
	this.SetInvalidState = function () {
		// Sets invalid state
		context.isValid = false;

		// If placeholder mode enabled, we add the message
		if (context.options.showErrors == true) {
			// Sets value to memory
			if (context.memoryValue == undefined) {
				context.memoryValue = context.input.val();
			}

			if (context.input.val() == "" && !context.HasMemorized()) {
				context.input.attr("placeholder", context.options.requiredErrorMessage);
			} else {
				context.input.attr("placeholder", context.options.regExErrorMessage);
			}
			context.SetValue("");
		}

		// Performs handler for invalid state
		if (context.options.ChangeOnInvalid != undefined) {
			context.options.ChangeOnInvalid(context.input);
		}
	};

	// Gets value from input
	this.GetValue = function () {
		return context.input.val();
	};

	// Sets value in input
	this.SetValue = function (value) {
		context.input.val(value);
	};

	// Returns validation state
	this.IsValid = function () {
		return context.isValid;
	};

	// Validate value by regular expression
	this.IsValueCorrect = function (value, regExp) {
		if (value.search(regExp) !== -1) {
			return true;
		}
		return false;
	};

	// Checks options and sets default
	this.CheckOptions = function () {
		if (context.options.expression == undefined) {
			context.options.expression = RegularExpressions.LETTERS_ONLY;
		}
		if (context.options.isValidateInRealTime == undefined) {
			context.options.isValidateInRealTime = false;
		}
		if (context.options.showErrors == undefined) {
			context.options.showErrors = false;
		}
		if (context.options.requiredErrorMessage == undefined) {
			context.options.requiredErrorMessage = "Required field";
		}
		if (context.options.regExErrorMessage == undefined) {
			context.options.regExErrorMessage = "Incorrect data";
		}
		if (context.options.required == undefined) {
			context.options.required = true;
		}
		if (context.options.autoValidating == undefined) {
			context.options.autoValidating = true;
		}
	};

	// Checks memorized value
	this.HasMemorized = function () {
		return (context.memoryValue !== undefined && context.memoryValue !== "");
	};

	// Sets input state to default
	this.ResetToDefault = function () {
		context.input.attr("placeholder", context.initialPlaceHolder);
		context.input.val(context.initialValue);
		if (context.options.ChangeOnValid != undefined) {
			context.options.ChangeOnValid(context.input);
		}
	};

	// Performs method of initialization
	this.Init();
}

// options = {
//      compareValue : string,                              // The value for compare
//      ChangeOnValid : func(input),                        // Performs when state has been changed on valid
//      ChangeOnInvalid : func(input),                      // Performs when state has been changed on invalid
//      showErrors : boolean,                               // Show errors in placeholder 
//      requiredErrorMessage : string,
//      errorMessage : string,
//      required : boolean                                  // If an input is required
//      autoValidating : boolean                            // Validation on focus out or blur
//}
function EqualValidatingInput(input, options) {
	// The context of this object
	var context = this;

	// Input for validation
	this.input = input;

	// Settings object
	this.options = options;

	// Input validation state
	this.isValid = false;

	// Value in memory (for place holder validation)
	this.memoryValue = undefined;

	// Initial placeholder for restore
	this.initialPlaceHolder = undefined;

	// Initial input value for restore
	this.initialValue = this.input.val();

	// Constructor function (initialize object)
	this.Init = function () {
		// Sets default values if they are not set
		context.CheckOptions();

		// FocusOut handler
		context.input.focusout(function () {
			if (context.GetValue().length > 0 && context.options.autoValidating) {
				context.Validate();
			}
		});

		// KeyUp handler
		context.input.on('keyup', function () {
			if (context.GetValue().length == 0) {
				context.ResetToDefault();
			}
			context.memoryValue = context.input.val();
		});

		// FocusIn handler
		context.input.focusin(function () {
			if (context.options.showErrors == true) {
				if (context.memoryValue != undefined) {
					if (context.memoryValue != undefined) {
						context.input.val(context.memoryValue);
					}
				}
			}
			if (context.options.ChangeOnValid != undefined) {
				context.options.ChangeOnValid(context.input);
			}
			context.input.attr("placeholder", context.initialPlaceHolder);
		});

		// Sets initial placeholder
		context.initialPlaceHolder = context.input.attr("placeholder");
	};

	// General validation function
	this.Validate = function () {
		// Gets value of input
		var value = context.input.val();

		if (context.options.required) {
			if (context.options.compareValue == value) {
				context.SetValidState();
			} else {
				context.SetInvalidState();
			}
		} else {
			if (value != "") {
				if (context.IsValueCorrect(value, context.options.expression)) {
					context.SetValidState();
				} else {
					context.SetInvalidState();
				}
			} else {
				context.SetValidState();
			}
		}
	};

	// Sets valid state of input
	this.SetValidState = function () {
		// Sets valid state
		context.isValid = true;
		// Clears memory value
		context.memoryValue = undefined;
		// Performs handler for valid state
		if (context.options.ChangeOnValid != undefined) {
			context.options.ChangeOnValid(context.input);
		}
	};

	// Sets invalid state of input
	this.SetInvalidState = function () {
		// Sets invalid state
		context.isValid = false;

		// If placeholder mode enabled, we add the message
		if (context.options.showErrors == true) {
			// Sets value to memory
			if (context.memoryValue == undefined) {
				context.memoryValue = context.input.val();
			}

			if (context.input.val() == "" && !context.HasMemorized()) {
				context.input.attr("placeholder", context.options.requiredErrorMessage);
			} else {
				context.input.attr("placeholder", context.options.errorMessage);
			}
			context.SetValue("");
		}

		// Performs handler for invalid state
		if (context.options.ChangeOnInvalid != undefined) {
			context.options.ChangeOnInvalid(context.input);
		}
	};

	// Gets value from input
	this.GetValue = function () {
		return context.input.val();
	};

	// Sets value in input
	this.SetValue = function (value) {
		context.input.val(value);
	};

	// Returns validation state
	this.IsValid = function () {
		return context.isValid;
	};

	// Checks options and sets default
	this.CheckOptions = function () {
		if (context.options.showErrors == undefined) {
			context.options.showErrors = false;
		}
		if (context.options.requiredErrorMessage == undefined) {
			context.options.requiredErrorMessage = "Required field";
		}
		if (context.options.errorMessage == undefined) {
			context.options.errorMessage = "Data not equal";
		}
		if (context.options.required == undefined) {
			context.options.required = true;
		}
		if (context.options.autoValidating == undefined) {
			context.options.autoValidating = true;
		}
	};

	// Checks memorized value
	this.HasMemorized = function () {
		return (context.memoryValue == undefined || context.memoryValue == "");
	};

	// Sets input state to default
	this.ResetToDefault = function () {
		context.input.attr("placeholder", context.initialPlaceHolder);
		context.input.val(context.initialValue);
		if (context.options.ChangeOnValid != undefined) {
			context.options.ChangeOnValid(context.input);
		}
	};

	// Sets compare value
	this.SetCompareValue = function (value) {
		context.options.compareValue = value;
	};

	// Performs method of initialization
	this.Init();
}

/**
 * Created by vlad_ on 13.10.2017.
 */
var LANGUAGE = $('html').attr('lang'),
    DEFAULT_LANGUAGE = 'ru';

var INIT_CART_WS;

const NOVA_POSHTA_API_KEY = 'b44f0a86753950ac8f5484c2030cde2d';

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
    REVIEW_ADDED = (LANGUAGE == DEFAULT_LANGUAGE) ? 'Спасибо! Модератор пересмотрит Ваш отзыв, после чего он появится на сайте.' : 'Дякуємо! Модератор перегляне Ваш відгук, після чого він з`явиться на сайті.',
    SHOW_FILTERS_BTN = (LANGUAGE == DEFAULT_LANGUAGE) ? 'Показать фильтры' : 'Показати фільтри',
    HIDE_FILTERS_BTN = (LANGUAGE == DEFAULT_LANGUAGE) ? 'Скрыть фильтры' : 'Сховати фільтри',
    DEFAULT_COUNTRY = (LANGUAGE == DEFAULT_LANGUAGE) ? {name: 'Украина', code: 'UA'} : {name: 'Україна', code: 'UA'};

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

// Force page reload on browser back button click
if (!!window.performance && window.performance.navigation.type === 2)
{
    // value 2 means "The page was accessed by navigating into the history"
    window.location.reload(); // reload whole page
}


$.ajaxSetup({
    beforeSend: function (request) {
        request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
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
        deliveryId: '',
        delivery: (window.FFShop.delivery == null ? null : window.FFShop.delivery),
        deliveryType: (window.FFShop.deliveryType == null ? null : window.FFShop.deliveryType),
        deliveryTypes: window.FFShop.deliveryTypes,
        deliveries: window.FFShop.deliveries,
        country: (window.FFShop.country == null ? DEFAULT_COUNTRY : window.FFShop.country),
        city: null,
        warehouse: null,
        aStreet: (window.FFShop.selectedStreet == null ? '' : window.FFShop.selectedStreet),
        aLand: (window.FFShop.selectedLand == null ? '' : window.FFShop.selectedLand),
        aCity: (window.FFShop.selectedCity == null ? '' : window.FFShop.selectedCity),
        aIndex: (window.FFShop.selectedIndex == null ? '' : window.FFShop.selectedIndex),
        cities: [],
        countries: window.FFShop.countries,
        warehouses: [],
        disableWarehouse: true,
        checkoutPoints: (window.FFShop.checkoutPoints == null ? [] : window.FFShop.checkoutPoints),
        checkoutPoint: (window.FFShop.checkoutPoint == null ? null : window.FFShop.checkoutPoint),
        selectedCityRef: (window.FFShop.selectedCityRef == null ? null : window.FFShop.selectedCityRef),
        selectedWarehouseRef: (window.FFShop.selectedWarehouseRef == null ? null : window.FFShop.selectedWarehouseRef),
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

    mainSliderPreview: {
        product: [],
        currentSizeId: '',
        count: '',
        rel: ''
    },
    mainSliderProducts: [],

    saleProductPreview: {
        product: [],
        currentSizeId: '',
        count: '',
        rel: ''
    },
    salesProducts: [],
    
    topProductPreview: {
        product: [],
        currentSizeId: '',
        count: '',
        rel: ''
    },
    topProducts: [],
    
    newProductPreview: {
        product: [],
        currentSizeId: '',
        count: '',
        rel: ''
    },
    newProducts: [],

    DEFAULT_COUNTRY: [DEFAULT_COUNTRY],
    INIT_CART_ENDED: false,
    IS_DATA_PROCESSING: false,
    isMainSliderProductsInited: false,
    timer: undefined,
    user: null,
    profile: null,
    wishList: null,
    userTypeId: 1,
    lang: LANGUAGE
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
                        GLOBAL_DATA.orderConfirm.deliveryName = data.profile.delivery.name;
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

var searchWasHidden = false;
var searchBtnClicked = false;

$(document).ready(function () {

    $('.open-search').click(function() {
        searchBtnClicked = true;

        if (searchBtnClicked)
        {
            var i = $(this).find('i');

            if ($('#search').css('display') === 'none')
            {
                $('.open-search').css('border', '2px solid #000');
                $('.navbar-nav').hide(50);
                $('.profile-search-smoll').stop().show().animate({
                    width: '600px'
                });
                $('.profile-search-smoll input').focus();

                i.removeClass('fa-search').addClass('fa-times');

                searchWasHidden =! searchWasHidden;

            }
            else
            {
                $('#search').find('input').val('');
            }

            searchBtnClicked = false;
        }
    });

    $('.open-drop-profile-nav').on('click', function () {
        $('.drop-nav-profile').stop(true, true).slideDown(300, function () {
            $('.open-drop-profile-nav').addClass('prof-drop-opened');
        });
    });

    $('body').on('click', function (e) {
        let _this = $(e.target);
        if (!_this.hasClass('.drop-nav-profile') &&
            _this.closest('.drop-nav-profile').length === 0 &&
            !_this.hasClass('.open-drop-profile-nav') && $('.open-drop-profile-nav').hasClass('prof-drop-opened'))
        {
            $('.drop-nav-profile').stop(true, true).slideUp(300, function () {
                $('.open-drop-profile-nav').removeClass('prof-drop-opened');
            });
        }
    });

    $(document).keydown(function(e) {
        if( e.keyCode === 27 ) {
            if ($('.open-drop-profile-nav').hasClass('prof-drop-opened'))
            {
                $('.drop-nav-profile').stop(true, true).slideUp(300, function () {
                    $('.open-drop-profile-nav').removeClass('prof-drop-opened');
                });
            }
        }
    });


});

$(window).load(function () {
    $(function() {
        $('.prod-title').matchHeight();
        $('.topic').matchHeight();
    });

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


'use strict';

$(window).load(function ()
{
    //Custom Scroll Style
    if ($(window).width() < 767) {
        if ($(".header-wrap").length > 0) {
            $(".navigation").mCustomScrollbar({
                theme: "dark-2",
                scrollButtons: {
                    enable: false
                }
            });
        }
        if ($(".cate-wrap").length > 0) {
            $(".cate-wrap > nav").mCustomScrollbar({
                theme: "dark-2",
                scrollButtons: {
                    enable: false
                }
            });
        }
        if ($(".product-table").length > 0) {
            $(".product-table").mCustomScrollbar({
                theme: "dark-2",
                axis: "x",
                scrollButtons: {
                    enable: false
                }
            });
        }
    }
});

$(document).ready(function ()
{
    /*------------------- Menu JS Starts  -------------------*/
    if ($('.wrapper > header').length > 0) {

        // Submenu Position Change on window size
        if ($(window).width() > 767) {
            $("ul.primary-navbar li li").mouseover(function () {
                if ($(this).children('ul').length == 1) {
                    var parent = $(this);
                    var child_menu = $(this).children('ul');
                    if ($(parent).offset().left + $(parent).width() + $(child_menu).width() > $(window).width()) {
                        $(child_menu).css('left', '-' + $(parent).width() + 'px');
                    } else {
                        $(child_menu).css('left', $(parent).width() + 'px');
                    }
                }
            });
        }


        if ($(window).width() < 767) {
            /*------------------- Header Offcanvas Add  -------------------*/
            $(".nav-trigger").on("click", function (e) {
                e.stopPropagation();
                $(".header-wrap .navigation").toggleClass("off-canvas");
                return false;
            });

            /*------------------- Category Menu -------------------*/
            $('.cate-toggle').on('click', function () {
                $('.cate-wrap').slideToggle();
                return false;
            });
        }

        // $(".mega-dropdown-slider").owlCarousel({
        //     dots: false,
        //     loop: true,
        //     autoplay: false,
        //     autoplayHoverPause: true,
        //     smartSpeed: 100,
        //     nav: true,
        //     margin: 30,
        //     responsive: {
        //         0: {items: 1},
        //         1200: {items: 2},
        //         992: {items: 2},
        //         768: {items: 2},
        //         568: {items: 2}
        //     },
        //     navText: [
        //         "<i class='fa fa-angle-left'></i>",
        //         "<i class='fa fa-angle-right'></i>"
        //     ]
        // });


    }
    /*------------------- Menu JS Ends  -------------------*/


// owlCarousel Slider //


    /*------------------- Product Slider -------------------*/
    // if ($('#prod-slider-1, #prod-slider-2').length > 0) {
    //     $("#prod-slider-1, #prod-slider-2").owlCarousel({
    //         dots: false,
    //         loop: false,
    //         autoplay: false,
    //         autoplayHoverPause: true,
    //         smartSpeed: 100,
    //         nav: true,
    //         margin: 30,
    //         responsive: {
    //             0: {items: 1},
    //             1201: {items: 2},
    //             768: {items: 1},
    //             568: {items: 2}
    //         },
    //         navText: [
    //             "<i class='fa fa-angle-left'></i>",
    //             "<i class='fa fa-angle-right'></i>"
    //         ]
    //     });
    // }

    /*------------------- Product  Slider -------------------*/
    // if ($('#deal-slider, #prod-featured-slider').length > 0) {
    //     $("#deal-slider, #prod-featured-slider").owlCarousel({
    //         dots: false,
    //         //loop: true,
    //         autoplay: true,
    //         autoplayHoverPause: true,
    //         smartSpeed: 100,
    //         nav: true,
    //         margin: 30,
    //         responsive: {
    //             0: {items: 1},
    //             1201: {items: 4},
    //             1024: {items: 3},
    //             768: {items: 2},
    //             568: {items: 2}
    //         },
    //         navText: [
    //             "<i class='fa fa-angle-left'></i>",
    //             "<i class='fa fa-angle-right'></i>"
    //         ]
    //     });
    // }

    /*------------------- Testimonial Slider -------------------*/
    // if ($('#testimonial-1').length > 0) {
    //     $("#testimonial-1").owlCarousel({
    //         dots: true,
    //         loop: true,
    //         autoplay: false,
    //         autoplayHoverPause: true,
    //         smartSpeed: 100,
    //         nav: false,
    //         margin: 30,
    //         responsive: {
    //             0: {items: 1}
    //         }
    //     });
    // }

    /*------------------- Brand Slider -------------------*/
    // if ($('#brand-slider').length > 0) {
    //     $("#brand-slider").owlCarousel({
    //         dots: true,
    //         loop: true,
    //         autoplay: true,
    //         autoplayHoverPause: true,
    //         smartSpeed: 100,
    //         nav: false,
    //         margin: 30,
    //         responsive: {
    //             0: {items: 1},
    //             1200: {items: 6},
    //             992: {items: 5},
    //             480: {items: 3}
    //         }
    //     });
    // }

    /*------------------- Blog Slider -------------------*/
    // if ($('#blog-slider-1').length > 0) {
    //     $("#blog-slider-1").owlCarousel({
    //         dots: true,
    //         loop: true,
    //         autoplay: true,
    //         autoplayHoverPause: true,
    //         smartSpeed: 100,
    //         nav: true,
    //         margin: 30,
    //         responsive: {
    //             0: {items: 1},
    //             1200: {items: 3},
    //             992: {items: 2},
    //             568: {items: 2}
    //         },
    //         navText: [
    //             "<i class='fa fa-angle-left'></i>",
    //             "<i class='fa fa-angle-right'></i>"
    //         ]
    //     });
    // }

    /*------------------- Realated Blog Slider -------------------*/
    // if ($('#rel-blog-slider').length > 0) {
    //     $("#rel-blog-slider").owlCarousel({
    //         dots: true,
    //         loop: true,
    //         autoplay: false,
    //         autoplayHoverPause: true,
    //         smartSpeed: 100,
    //         nav: false,
    //         margin: 30,
    //         responsive: {
    //             0: {items: 1},
    //             1024: {items: 2},
    //             768: {items: 1},
    //             568: {items: 2}
    //         }
    //     });
    // }

    /*------------------- Brand Slider -------------------*/
    // if ($('#brand-slider-2').length > 0) {
    //     $("#brand-slider-2").owlCarousel({
    //         dots: false,
    //         loop: true,
    //         autoplay: true,
    //         autoplayHoverPause: true,
    //         smartSpeed: 100,
    //         nav: false,
    //         margin: 30,
    //         responsive: {
    //             0: {items: 1},
    //             992: {items: 5},
    //             768: {items: 4},
    //             568: {items: 3},
    //             380: {items: 2}
    //         }
    //     });
    // }

    /*------------------- Related Product Slider -------------------*/
    // if ($('#rel-prod-slider').length > 0) {
    //     $("#rel-prod-slider").owlCarousel({
    //         dots: false,
    //         loop: false,
    //         autoplay: false,
    //         autoplayHoverPause: true,
    //         smartSpeed: 100,
    //         nav: true,
    //         margin: 30,
    //         responsive: {
    //             0: {items: 1},
    //             1200: {items: 4},
    //             992: {items: 3},
    //             768: {items: 2},
    //             568: {items: 1}
    //         },
    //         navText: [
    //             "<i class='fa fa-angle-left'></i>",
    //             "<i class='fa fa-angle-right'></i>"
    //         ]
    //     });
    // }

    /*------------------- Widget Slider -------------------*/
    // if ($('#widget-best-seller').length > 0) {
    //     $("#widget-best-seller").owlCarousel({
    //         dots: false,
    //         loop: true,
    //         autoplay: false,
    //         autoplayHoverPause: true,
    //         smartSpeed: 100,
    //         nav: true,
    //         margin: 30,
    //         responsive: {
    //             0: {items: 1},
    //             600: {items: 2},
    //             768: {items: 1}
    //         },
    //         navText: [
    //             "<i class='fa fa-angle-left'></i>",
    //             "<i class='fa fa-angle-right'></i>"
    //         ]
    //     });
    // }

    //Resize carousels in modal
    // if ($('.sync2:not(.product-preview-images-small)').length > 0) {
    //     $(document).on('shown.bs.modal', function () {
    //         $(this).find('.sync1, .sync2').each(function () {
    //             $(this).data('owlCarousel') ? $(this).data('owlCarousel').onResize() : null;
    //         });
    //     });
    //
    //     var sync1 = $(".sync1");
    //     var sync2 = $(".sync2");
    //     var sliderthumb = $(".single-prod-thumb");
    //     var homethumb = $(".home-slide-thumb");
    //     var navSpeedThumbs = 500;
    //
    //     sliderthumb.owlCarousel({
    //         rtl: false,
    //         items: 3,
    //         //loop: true,
    //         nav: true,
    //         margin: 20,
    //         navSpeed: navSpeedThumbs,
    //         responsive: {
    //             992: {items: 3},
    //             767: {items: 4},
    //             480: {items: 3},
    //             320: {items: 2}
    //         },
    //         responsiveRefreshRate: 200,
    //         navText: [
    //             "<i class='fa fa-angle-left'></i>",
    //             "<i class='fa fa-angle-right'></i>"
    //         ]
    //     });
    //
    //     sync1.owlCarousel({
    //         rtl: false,
    //         items: 1,
    //         navSpeed: 1000,
    //         nav: false,
    //         onChanged: syncPosition,
    //         responsiveRefreshRate: 200
    //
    //     });
    //
    //     homethumb.owlCarousel({
    //         rtl: false,
    //         items: 5,
    //         nav: true,
    //         //loop: true,
    //         navSpeed: navSpeedThumbs,
    //         responsive: {
    //             1500: {items: 5},
    //             1024: {items: 4},
    //             768: {items: 3},
    //             600: {items: 4},
    //             480: {items: 3},
    //             320: {items: 2,
    //                 nav: false
    //             }
    //         },
    //         responsiveRefreshRate: 200,
    //         navText: [
    //             "<i class='fa fa-long-arrow-left'></i>",
    //             "<i class='fa fa-long-arrow-right'></i>"
    //         ]
    //     });
    // }
    //
    // function syncPosition(el) {
    //     var current = this._current;
    //     $(".sync2")
    //             .find(".owl-item")
    //             .removeClass("synced")
    //             .eq(current)
    //             .addClass("synced");
    //     center(current);
    // }
    //
    // $(".sync2:not(.product-preview-images-small)").on("click", ".owl-item", function (e) {
    //     e.preventDefault();
    //     var number = $(this).index();
    //     sync1.trigger("to.owl.carousel", [number, 1000]);
    //     return false;
    // });
    //
    // function center(num) {
    //
    //     var sync2visible = sync2.find('.owl-item.active').map(function () {
    //         return $(this).index();
    //     });
    //
    //     if ($.inArray(num, sync2visible) === -1) {
    //         if (num > sync2visible[sync2visible.length - 1]) {
    //             sync2.trigger("to.owl.carousel", [num - sync2visible.length + 2, navSpeedThumbs, true]);
    //         } else {
    //             sync2.trigger("to.owl.carousel", Math.max(0, num - 1));
    //         }
    //     } else if (num === sync2visible[sync2visible.length - 1]) {
    //         sync2.trigger("to.owl.carousel", [sync2visible[1], navSpeedThumbs, true]);
    //     } else if (num === sync2visible[0]) {
    //         sync2.trigger("to.owl.carousel", [Math.max(0, num - 1), navSpeedThumbs, true]);
    //     }
    // }
//
// owlCarousel Slider End //

    /*------------------- Scroll To Top Animate -------------------*/
    $('#to-top').on('click', function () {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });

    // /*------------------- Sidebar Filter Range -------------------*/
    // var priceSliderRange = $('#price-range');
    // if ($.ui) {
    //     if ($(priceSliderRange).length) {
    //         $(priceSliderRange).slider({
    //             range: true,
    //             min: 0,
    //             max: 1000,
    //             values: [120, 540],
    //             slide: function (event, ui) {
    //                 //$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
    //                 $("#price-min").html(ui.values[0] + " грн");
    //                 $("#price-max").html(ui.values[1]+ " грн" );
    //                 console.log(ui);
    //             }
    //         });
    //         $("#price-min").html($("#price-range").slider("values", 0) + " грн");
    //         $("#price-max").html($("#price-range").slider("values", 1) + " грн");
    //     }
    // }

    // prettyPhoto
    // ---------------------------------------------------------------------------------------    
    if ($('.caption-link').length > 0) {
        $("a[rel^='prettyPhoto[single-product]']").prettyPhoto({
            theme: 'facebook',
            slideshow: 5000,
            autoplay_slideshow: false,
            social_tools:false,
            deeplinking:false
        });
    }

});

$(window).scroll(function () {
    /*------------------- Sticky Header Starts  -------------------*/
    if ($('#headerstyle').length === 0) {
        if ($(this).scrollTop() > 5) {
            $('.main-header').addClass('is-sticky');
        }
        else {
            $('.main-header').removeClass('is-sticky');
        }
    }
    
    /*------------------- Scroll To Top Animate -------------------*/
    if ($(this).scrollTop() > 100) {
        $('#to-top').css({bottom: '55px'});
    }
    else {
        $('#to-top').css({bottom: '-150px'});
    }
});


/*------ 12.01.2018  -------*/
/*------------------- lookbook Slider -------------------*/
if ($('#lookbook-slider').length > 0) {
    $("#lookbook-slider").owlCarousel({
        dots: true,
        loop: true,
        autoplay: true,
        autoplayHoverPause: true,
        smartSpeed: 300,
        nav: true,
        margin: 30,
        responsive: {
            0: {items: 1},
            1200: {items: 1},
            992: {items: 1},
            568: {items: 1}
        },
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ]
    });
}

/*------------------- category Slider -------------------*/
if ($('#slider-category').length > 0) {
    $("#slider-category").owlCarousel({
        dots: true,
        loop: true,
        autoplay: true,
        autoplayHoverPause: true,
        smartSpeed: 100,
        nav: true,
        margin: 30,
        responsive: {
            0: {items: 1},
            1200: {items: 4},
            992: {items: 3},
            568: {items: 2},
            400: {items: 1}
        },
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ]
    });
}

/*------------------- category Slider -------------------*/
if ($('#slider-category').length > 0) {
    $("#slider-category").owlCarousel({
        dots: true,
        loop: true,
        autoplay: true,
        autoplayHoverPause: true,
        smartSpeed: 100,
        nav: true,
        margin: 30,
        responsive: {
            0: {items: 1},
            1200: {items: 4},
            992: {items: 3},
            568: {items: 2},
            400: {items: 1}
        },
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ]
    });
}

if ($('#home-slider-category').length > 0) {
    $('#home-slider-category').owlCarousel({
        dots: true,
        loop: true,
        autoplay: true,
        autoplayHoverPause: true,
        smartSpeed: 100,
        nav: false,
        margin: 30,
        responsive: {
            0: {items: 1},
            1200: {items: 4},
            992: {items: 3},
            568: {items: 2},
            400: {items: 1}
        }
    });
}
/* left slide bar */
function openNav(e) {
    $('#mySidenav').animate({
        marginLeft: '0px'
    }, 250, 'swing', function () {
        $('body').css('overflow-x', 'hidden');
        $('body').css('overflow-y', 'hidden');
    });

    setTimeout(function () {
        $('.nav-sidebar-bg').fadeIn(150);
    }, 100);
}

function closeNav(e) {
    $('body').css('overflow-x', 'auto');
    $('body').css('overflow-y', 'auto');
    $('.nav-sidebar-bg').fadeOut(250);
    $('#mySidenav').animate({
        marginLeft: '-290px'
    }, 250, 'swing');

}

$(document).ready(function () {
    var menuOpenLink = '[data-menu-open-link]',
        menuCloseLink = '[data-menu-close-link]',
        isMenuOpened = false;

    $('body').on('click touchend', menuOpenLink, function (e) {
        e.stopPropagation();
        openNav(e);

        isMenuOpened = true;
    });

    $('body').on('click', menuCloseLink, function (e) {
        e.stopPropagation();
        closeNav(e);

        isMenuOpened = false;
    });

    $('body').on('click', '[data-close-sidebar-nav]', function (e) {
        closeNav(e);

        isMenuOpened = false;
    });

    $(document).on('click', 'body', function (e) {
        var $target = $(e.target);

        if (isMenuOpened && ($target.attr('id') != 'mySidenav' && $target.closest('#mySidenav').length === 0))
        {
            closeNav(e);
            isMenuOpened = false;
        }
    });
});
/* left slide bar END */

var SHOW_HEADER_TOP_BAR = false;

/*--- SLICK  NAVBAR  ----*/
$(window).load(function() {

    if ($(window).width() > 991)
    {
        SHOW_HEADER_TOP_BAR = true;
    }
    else
    {
        $('.header-topbar').css('display', 'none');
    }

    var objToStick = $(".header-main"); //Получаем нужный объект
    var topOfObjToStick = $(objToStick).offset().top; //Получаем начальное расположение нашего блока
    $(window).scroll(function () {
        var windowScroll = $(window).scrollTop(); //Получаем величину, показывающую на сколько прокручено окно

        if (SHOW_HEADER_TOP_BAR)
        {
            if (windowScroll > topOfObjToStick)
            { // Если прокрутили больше, чем расстояние до блока, то приклеиваем его
                $('.header-topbar').slideUp(200, function() {
                    $(objToStick).addClass("topWindow");
                });
            }
            else
            {
                $('.header-topbar').slideDown(400);
                $(objToStick).removeClass("topWindow");
            }
        }
    });




});
/*--- SLICK  NAVBAR  END ----*/

$( window ).resize(function() {
    if ($(window).width() <= 991)
    {
        SHOW_HEADER_TOP_BAR = false;
        $('.header-topbar').css('display', 'none');
    }
    else
    {
        SHOW_HEADER_TOP_BAR = true;
        $('.header-topbar').slideDown(400);
        $(".header-main").removeClass("topWindow");
    }
});

/*LANG header*/
$(document).ready(function() {
    $('.general-leng').click(function () {
        $('.ather-lang').stop(100,100).fadeToggle(100);
    });
});
/*LANG cart header END*/
///////
$('body').on('click', '.dropdown-div-btn', function () {
    var i = $(this).find('.plus-icon');
    var display =  $(this).next().css('display');

    var isFilterBtn = false;

    if ($(this).hasClass('show-filters-btn'))
    {
        isFilterBtn = true;
    }

    i.css('lineHeight', '17px');
    switch (display){
        case 'none': {
            i.html('-');
            i.css('lineHeight', '17px');
            if (isFilterBtn)
            {
                $(this).html(HIDE_FILTERS_BTN);
            }
            break;
        }
        case 'block': {
            i.html('+');
            i.css('lineHeight', '20px');
            if (isFilterBtn)
            {
                $(this).html(SHOW_FILTERS_BTN);
            }
            // $(this).css('borderBottom', 'none')
            // $(this).html($(this).html().replace('Сховати','Показати'))
            break
        }
        default: {
            break
        }
    }
    $(this).next().stop().slideToggle(300);
});
/* DROPDOWN - BLOCK END*/

/* select  */

$('body').on('click', '.drop-menu-select:not(.disableDiv)', function () {

    if ($(this).find('#mu-list').length > 0 && $('#data-values #GoodId').val() > 0) {
        event.preventDefault();
        return false;
    }

    $(this).attr('tabindex', 1).focus();
    $(this).toggleClass('active');
    $(this).find('.dropeddown').stop(true, true).slideToggle(300);
    $(this).css({
        color: '#555',
        fontWeight: '500',
        border: '2px solid #000'
    });
});
$('body').on('focusout', '.drop-menu-select', function () {
    $(this).removeClass('active');
    $(this).find('.dropeddown').stop(true, true).slideUp(300);
});
$('body').on('click','.drop-menu-select .dropeddown li:not(.select-multi)', function () {
    $(this).parents('.drop-menu-select').find('.select span').text($(this).text());
    $(this).parents('.drop-menu-select').find('input').attr('value', $(this).attr('id'));
});

/* select end */