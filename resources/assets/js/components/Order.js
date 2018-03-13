import vSelect from 'vue-select';
import _ from 'lodash';
Vue.component('v-select', vSelect);

if (document.getElementById('order-confirm'))
{
    let orderNameValidator, orderPhoneValidator, orderEmailValidator, orderAddressValidator;

    GLOBAL_DATA.orderConfirm.countries = FFShop.countries;
    GLOBAL_DATA.orderConfirm.deliveries = FFShop.deliveries;

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
            
            // orderAddressValidator = new RegExValidatingInput($('[data-order-address]'), {
            //     expression: RegularExpressions.MIN_TEXT,
            //     ChangeOnValid: function (input) {
            //         input.removeClass(INCORRECT_FIELD_CLASS);
            //     },
            //     ChangeOnInvalid: function (input) {
            //         input.addClass(INCORRECT_FIELD_CLASS);
            //     },
            //     showErrors: true,
            //     requiredErrorMessage: REQUIRED_FIELD_TEXT,
            //     regExErrorMessage: INCORRECT_FIELD_TEXT
            // });

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
                }

                if (GLOBAL_DATA.orderConfirm.deliveryType == null)
                {
                    isValid = false;
                    $('[data-order-delivery-type]').find('.dropdown-toggle').css('border', '2px solid red');
                }

                if (GLOBAL_DATA.orderConfirm.country == null
                    || GLOBAL_DATA.orderConfirm.country === '')
                {
                    isValid = false;
                    $('[data-order-country]').find('.dropdown-toggle').css('border', '2px solid red');
                }

                if (GLOBAL_DATA.orderConfirm.city == null
                    || GLOBAL_DATA.orderConfirm.city === '')
                {
                    isValid = false;
                    $('[data-order-city]').find('.dropdown-toggle').css('border', '2px solid red');
                }

                if (GLOBAL_DATA.orderConfirm.city != null && GLOBAL_DATA.orderConfirm.warehouse == null
                    || GLOBAL_DATA.orderConfirm.warehouse === '')
                {
                    isValid = false;
                    $('[data-order-warehouse]').find('.dropdown-toggle').css('border', '2px solid red');
                }

                // orderAddressValidator.Validate();
                // if (isValid && !orderAddressValidator.IsValid()) {
                //     isValid = false;
                // }

                // if (GLOBAL_DATA.orderConfirm.deliveryId == '') {
                //     isValid = false;
                //     $('[data-order-delivery]').css('border', '2px solid red');
                // }

                // if (GLOBAL_DATA.orderConfirm.paymentId == '') {
                //     isValid = false;
                //     $('[data-order-payment]').css('border', '2px solid red');
                // }

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

                showLoader();

                $.ajax({
                    type: 'post',
                    url: '/order/create',
                    data: {
                        name: GLOBAL_DATA.orderConfirm.name,
                        phone: GLOBAL_DATA.orderConfirm.phone,
                        email: GLOBAL_DATA.orderConfirm.email,
                        // paymentId: GLOBAL_DATA.orderConfirm.paymentId,
                        deliveryId: GLOBAL_DATA.orderConfirm.deliveryId,
                        // address: GLOBAL_DATA.orderConfirm.address,
                        comment: GLOBAL_DATA.orderConfirm.comment,
                        language: LANGUAGE
                    },
                    success: function (data) {
                        hideLoader();
                        
                        if (data.status == 'success')
                        {
                            if (LANGUAGE == 'uk')
                            {
                                window.location.href = '/uk';
                            }
                            else
                            {
                                window.location.href = '/';
                            }
                        }

                        if (data.status == 'error')
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