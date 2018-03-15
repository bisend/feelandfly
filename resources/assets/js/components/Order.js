import vSelect from 'vue-select';
import _ from 'lodash';
Vue.component('v-select', vSelect);

if (document.getElementById('order-confirm'))
{
    let orderNameValidator,
        orderPhoneValidator,
        orderEmailValidator,
        orderAddressValidator,
        orderAStreetValidator,
        orderALandValidator,
        orderACityValidator;

    GLOBAL_DATA.orderConfirm.countries = FFShop.countries;
    GLOBAL_DATA.orderConfirm.deliveries = FFShop.deliveries;
    GLOBAL_DATA.orderConfirm.checkoutPoints = ['Point 1', 'Point 2'];

    new Vue({
        el: '#order-confirm',
        data: GLOBAL_DATA,
        mounted: function () {
            let _this = this;

            $('body').on('click', '.selected-tag', function (e) {
                $(this).siblings('input').focus();
            });

            // `this` указывает на экземпляр vm
            orderNameValidator = new RegExValidatingInput($('[data-order-name]'), {
                expression: RegularExpressions.FULL_NAME,
                ChangeOnValid: function (input) {
                    input.removeClass(INCORRECT_FIELD_CLASS);
                },
                ChangeOnInvalid: function (input) {
                    input.addClass(INCORRECT_FIELD_CLASS);
                },
                showErrors: true,
                requiredErrorMessage: REQUIRED_FIELD_TEXT,
                regExErrorMessage: INCORRECT_FIELD_TEXT
            });
            
            orderPhoneValidator = new RegExValidatingInput($('[data-order-phone]'), {
                expression: RegularExpressions.PHONE_NUMBER_MOBILE,
                ChangeOnValid: function (input) {
                    input.removeClass(INCORRECT_FIELD_CLASS);
                },
                ChangeOnInvalid: function (input) {
                    input.addClass(INCORRECT_FIELD_CLASS);
                },
                showErrors: true,
                requiredErrorMessage: REQUIRED_FIELD_TEXT,
                regExErrorMessage: INCORRECT_FIELD_TEXT
            });
            
            orderEmailValidator = new RegExValidatingInput($('[data-order-email]'), {
                expression: RegularExpressions.EMAIL,
                ChangeOnValid: function (input) {
                    input.removeClass(INCORRECT_FIELD_CLASS);
                },
                ChangeOnInvalid: function (input) {
                    input.addClass(INCORRECT_FIELD_CLASS);
                },
                showErrors: true,
                requiredErrorMessage: REQUIRED_FIELD_TEXT,
                regExErrorMessage: INCORRECT_FIELD_TEXT
            });

        },
        watch: {
            // эта функция запускается при любом изменении count
            totalCount: function () {
                if (GLOBAL_DATA.totalCount === 0)
                {
                    window.location.reload(true);
                }
            },
            'orderConfirm.city': () => {
                if (GLOBAL_DATA.orderConfirm.city !== '' && GLOBAL_DATA.orderConfirm.city != null)
                {
                    $('[data-order-city]').find('.dropdown-toggle').css('border', '2px solid black');
                    GLOBAL_DATA.orderConfirm.disableWarehouse = false;
                }
                else
                {
                    GLOBAL_DATA.orderConfirm.disableWarehouse = true;
                }
            },
            'orderConfirm.delivery': () => {
                if (GLOBAL_DATA.orderConfirm.delivery)
                {
                    $('[data-order-delivery]').find('.dropdown-toggle').css('border', '2px solid black');
                }
            },
            'orderConfirm.deliveryType': () => {
                if (GLOBAL_DATA.orderConfirm.deliveryType === 'Номер отделения'
                    || GLOBAL_DATA.orderConfirm.deliveryType === 'Номер відділення')
                {
                    GLOBAL_DATA.orderConfirm.country = DEFAULT_COUNTRY;
                }

                orderAStreetValidator = new RegExValidatingInput($('[data-order-a-street]'), {
                    expression: RegularExpressions.MIN_TEXT,
                    ChangeOnValid: function (input) {
                        input.removeClass(INCORRECT_FIELD_CLASS);
                    },
                    ChangeOnInvalid: function (input) {
                        input.addClass(INCORRECT_FIELD_CLASS);
                    },
                    showErrors: true,
                    requiredErrorMessage: REQUIRED_FIELD_TEXT,
                    regExErrorMessage: INCORRECT_FIELD_TEXT
                });

                orderALandValidator = new RegExValidatingInput($('[data-order-a-land]'), {
                    expression: RegularExpressions.MIN_TEXT,
                    ChangeOnValid: function (input) {
                        input.removeClass(INCORRECT_FIELD_CLASS);
                    },
                    ChangeOnInvalid: function (input) {
                        input.addClass(INCORRECT_FIELD_CLASS);
                    },
                    showErrors: true,
                    requiredErrorMessage: REQUIRED_FIELD_TEXT,
                    regExErrorMessage: INCORRECT_FIELD_TEXT
                });

                orderACityValidator = new RegExValidatingInput($('[data-order-a-city]'), {
                    expression: RegularExpressions.MIN_TEXT,
                    ChangeOnValid: function (input) {
                        input.removeClass(INCORRECT_FIELD_CLASS);
                    },
                    ChangeOnInvalid: function (input) {
                        input.addClass(INCORRECT_FIELD_CLASS);
                    },
                    showErrors: true,
                    requiredErrorMessage: REQUIRED_FIELD_TEXT,
                    regExErrorMessage: INCORRECT_FIELD_TEXT
                });

                $('[data-order-delivery-type]').find('.dropdown-toggle').css('border', '2px solid black');
            },
            'orderConfirm.country': () => {
                if (GLOBAL_DATA.orderConfirm.country)
                {
                    $('[data-order-country]').find('.dropdown-toggle').css('border', '2px solid black');
                }
            },
            'orderConfirm.warehouse': () => {
                if (GLOBAL_DATA.orderConfirm.warehouse)
                {
                    $('[data-order-warehouse]').find('.dropdown-toggle').css('border', '2px solid black');
                }
            },
            'orderConfirm.checkoutPoint': () => {
                if (GLOBAL_DATA.orderConfirm.checkoutPoint)
                {
                    $('[data-order-points]').find('.dropdown-toggle').css('border', '2px solid black');
                }
            },
        },
        methods: {
            searchCity: _.debounce((search, loading) => {

                $.ajax({
                    async: true,
                    crossDomain: true,
                    url: 'https://api.novaposhta.ua/v2.0/json/',
                    method: 'POST',
                    processData: false,
                    data: JSON.stringify({
                        apiKey: NOVA_POSHTA_API_KEY,
                        modelName: 'Address',
                        calledMethod: 'getCities',
                        methodProperties: {
                            FindByString: search.trim().toLowerCase()
                        },
                    }),
                    beforeSend: function (request) {
                        loading(true);
                        request.setRequestHeader("Content-Type", "application/json");
                    },
                    success: function (data) {
                        console.log(data);

                        if (data != undefined &&
                            data.data != undefined &&
                            data.data.length > 0)
                            // data.data[0] != undefined &&
                            // data.data[0].Addresses != undefined &&
                            // data.data[0].Addresses.length > 0)
                        {
                            // GLOBAL_DATA.orderConfirm.cities = data.data[0].Addresses;
                            GLOBAL_DATA.orderConfirm.cities = data.data;
                        }
                        else
                        {
                            GLOBAL_DATA.orderConfirm.cities = [];
                        }
                    },
                    complete: function () {
                        loading(false);
                    },
                    error: function (error) {
                        loading(false);
                        console.log(error);
                    }
                });

            }, 350),
            searchWarehouses: (value) => {
                GLOBAL_DATA.orderConfirm.warehouse = null;

                GLOBAL_DATA.orderConfirm.city = value;

                console.log('search warehouses');

                if (GLOBAL_DATA.orderConfirm.city != null &&
                    GLOBAL_DATA.orderConfirm.city != '')
                {
                    $.ajax({
                        async: true,
                        crossDomain: true,
                        url: 'https://api.novaposhta.ua/v2.0/json/',
                        method: 'POST',
                        processData: false,
                        data: JSON.stringify({
                            apiKey: NOVA_POSHTA_API_KEY,
                            modelName: 'Address',
                            calledMethod: 'getWarehouses',
                            methodProperties: {
                                CityRef: value.Ref
                            },
                        }),
                        beforeSend: function (request) {
                            request.setRequestHeader("Content-Type", "application/json");
                        },
                        success: function (data) {

                            console.log(data);

                            if (data != undefined &&
                                data.data != undefined &&
                                data.data.length > 0)
                            {
                                GLOBAL_DATA.orderConfirm.warehouses = data.data;
                            }
                            else
                            {
                                GLOBAL_DATA.orderConfirm.warehouses = [];
                            }
                        },
                        complete: function () {
                            // loading(false);///dsd
                        },
                        error: function (error) {
                            loading(false);
                            console.log(error);
                        }
                    });
                }
            },
            validateBeforeSubmit() {
                let _this = this;

                let isValid = true;

                orderNameValidator.Validate();
                if (!orderNameValidator.IsValid()) {
                    isValid = false;
                }

                orderPhoneValidator.Validate();
                if (isValid && !orderPhoneValidator.IsValid()) {
                    isValid = false;
                }

                orderEmailValidator.Validate();
                if (isValid && !orderEmailValidator.IsValid()) {
                    isValid = false;
                }

                if (GLOBAL_DATA.orderConfirm.delivery == null)
                {
                    isValid = false;
                    $('[data-order-delivery]').find('.dropdown-toggle').css('border', '2px solid red');
                    console.log('dostavka');
                }
                else
                {
                    //CASE SELF CHECKOUT
                    if (GLOBAL_DATA.orderConfirm.delivery.name === 'Самовывоз' || GLOBAL_DATA.orderConfirm.delivery.name === 'Самовивіз')
                    {
                        if (GLOBAL_DATA.orderConfirm.checkoutPoint == null)
                        {
                            isValid = false;
                            $('[data-order-points]').find('.dropdown-toggle').css('border', '2px solid red');
                            console.log('NP checkout');
                        }
                    }
                    //SELF CHECKOUT END

                    // CASE NOVA POSHTA
                    if (GLOBAL_DATA.orderConfirm.delivery.name === 'Новая почта' || GLOBAL_DATA.orderConfirm.delivery.name === 'Нова пошта')
                    {
                        //VALIDATE DELIVERY TYPE
                        if (GLOBAL_DATA.orderConfirm.deliveryType == null)
                        {
                            isValid = false;
                            $('[data-order-delivery-type]').find('.dropdown-toggle').css('border', '2px solid red');
                            console.log('dostavka tip');
                        }
                        //VALIDATE DELIVERY TYPE END

                        if (GLOBAL_DATA.orderConfirm.deliveryType != null)
                        {
                            //CASE ADDRESS DELIVERY
                            if (GLOBAL_DATA.orderConfirm.deliveryType === 'Адресная доставка' || GLOBAL_DATA.orderConfirm.deliveryType === 'Адресна доставка')
                            {
                                //VALIDATE COUNTRY
                                if (GLOBAL_DATA.orderConfirm.country == null || GLOBAL_DATA.orderConfirm.country === '')
                                {
                                    isValid = false;
                                    $('[data-order-country]').find('.dropdown-toggle').css('border', '2px solid red');
                                    console.log('dostavka country');
                                }
                                //VALIDATE COUNTRY END
                                else
                                {
                                    // VALIDATE STREET
                                    orderAStreetValidator.Validate();
                                    if (!orderAStreetValidator.IsValid()) {
                                        isValid = false;
                                        console.log('A street');
                                    }

                                    // VALIDATE LAND
                                    orderALandValidator.Validate();
                                    if (!orderALandValidator.IsValid()) {
                                        isValid = false;
                                        console.log('A land');
                                    }

                                    // VALIDATE CITY
                                    orderACityValidator.Validate();
                                    if (!orderACityValidator.IsValid()) {
                                        isValid = false;
                                        console.log('A city');
                                    }
                                }
                            }
                            //CASE ADDRESS DELIVERY END

                            //CASE NUMBER WAREHOUSE
                            if (GLOBAL_DATA.orderConfirm.deliveryType === 'Номер отделения' || GLOBAL_DATA.orderConfirm.deliveryType === 'Номер відділення')
                            {
                                //VALIDATE NP CITY
                                if (GLOBAL_DATA.orderConfirm.city == null || GLOBAL_DATA.orderConfirm.city === '')
                                {
                                    isValid = false;
                                    $('[data-order-city]').find('.dropdown-toggle').css('border', '2px solid red');
                                    console.log('NP city');
                                }
                                //VALIDATE NP CITY END
                                else
                                {
                                    //VALIDATE NP WAREHOUSE
                                    if (GLOBAL_DATA.orderConfirm.warehouse == null || GLOBAL_DATA.orderConfirm.warehouse === '')
                                    {
                                        isValid = false;
                                        $('[data-order-warehouse]').find('.dropdown-toggle').css('border', '2px solid red');
                                        console.log('NP warehouse');
                                    }
                                    //VALIDATE NP WAREHOUSE END
                                }
                            }
                            //CASE NUMBER WAREHOUSE END
                        }
                    }
                    // CASE NOVA POSHTA END
                }

                console.log(isValid);

                if (isValid) {
                    _this.createOrder();
                }
            },
            setDelivery(deliveryId, deliveryName) {
                let _this = this;
                
                GLOBAL_DATA.orderConfirm.deliveryId = deliveryId;
                GLOBAL_DATA.orderConfirm.deliveryName = deliveryName;
            },
            setPaymentId(paymentId) {
                let _this = this;

                GLOBAL_DATA.orderConfirm.paymentId = paymentId;
            },
            createOrder() {
                let _this = this;

                let checkoutPoint = null,
                    npDeliveryType = null,
                    country = null,
                    npCity = null,
                    npCityRef = null,
                    npWarehouse = null,
                    npWarehouseRef = null,
                    aStreet = null,
                    aLand = null,
                    aCity = null,
                    postIndex = null;

                if (GLOBAL_DATA.orderConfirm.delivery.name === 'Самовывоз' || GLOBAL_DATA.orderConfirm.delivery.name === 'Самовивіз')
                {
                    checkoutPoint = GLOBAL_DATA.orderConfirm.checkoutPoint;
                }

                if (GLOBAL_DATA.orderConfirm.delivery.name === 'Новая почта' || GLOBAL_DATA.orderConfirm.delivery.name === 'Нова пошта')
                {
                    if (GLOBAL_DATA.orderConfirm.deliveryType === 'Адресная доставка' || GLOBAL_DATA.orderConfirm.deliveryType === 'Адресна доставка')
                    {
                        country = GLOBAL_DATA.orderConfirm.country;
                        aStreet = GLOBAL_DATA.orderConfirm.aStreet;
                        aLand = GLOBAL_DATA.orderConfirm.aLand;
                        aCity = GLOBAL_DATA.orderConfirm.aCity;
                        postIndex = GLOBAL_DATA.orderConfirm.aIndex;
                    }

                    if (GLOBAL_DATA.orderConfirm.deliveryType === 'Номер отделения' || GLOBAL_DATA.orderConfirm.deliveryType === 'Номер відділення')
                    {
                        npCity = (LANGUAGE === DEFAULT_LANGUAGE) ? GLOBAL_DATA.orderConfirm.city.DescriptionRu : GLOBAL_DATA.orderConfirm.city.Description;
                        npCityRef = GLOBAL_DATA.orderConfirm.city.Ref;
                        npWarehouse = (LANGUAGE === DEFAULT_LANGUAGE) ? GLOBAL_DATA.orderConfirm.warehouse.DescriptionRu : GLOBAL_DATA.orderConfirm.warehouse.Description;
                        npWarehouseRef = GLOBAL_DATA.orderConfirm.warehouse.Ref;
                    }

                    npDeliveryType = GLOBAL_DATA.orderConfirm.deliveryType;
                }


                showLoader();

                $.ajax({
                    type: 'post',
                    url: '/order/create',
                    data: {
                        name: GLOBAL_DATA.orderConfirm.name,
                        phone: GLOBAL_DATA.orderConfirm.phone,
                        email: GLOBAL_DATA.orderConfirm.email,
                        deliveryId: GLOBAL_DATA.orderConfirm.delivery.id,
                        checkoutPoint: checkoutPoint,
                        npDeliveryType: npDeliveryType,
                        country: country,
                        npCity: npCity,
                        npCityRef: npCityRef,
                        npWarehouse: npWarehouse,
                        npWarehouseRef: npWarehouseRef,
                        aStreet: aStreet,
                        aLand: aLand,
                        aCity: aCity,
                        postIndex: postIndex,
                        comment: GLOBAL_DATA.orderConfirm.comment,
                        language: LANGUAGE
                    },
                    success: function (data) {
                        hideLoader();
                        
                        if (data.status === 'success')
                        {
                            if (LANGUAGE === 'uk')
                            {
                                // window.location.href = '/uk';
                            }
                            else
                            {
                                // window.location.href = '/';
                            }
                        }

                        if (data.status === 'error')
                        {
                            showPopup(SERVER_ERROR);
                        }
                    },
                    error: function (error) {
                        hideLoader();
                        showPopup(SERVER_ERROR);
                        console.log(error);
                    }
                });
            }
        }
    });
}