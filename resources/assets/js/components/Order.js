if (document.getElementById('order-confirm'))
{
    var orderNameValidator, orderPhoneValidator, orderEmailValidator, orderAddressValidator;
    
    new Vue({
        el: '#order-confirm',
        data: GLOBAL_DATA,
        mounted: function () {
            var _this = this;
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
                expression: RegularExpressions.PHONE_NUMBER,
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
            
            orderAddressValidator = new RegExValidatingInput($('[data-order-address]'), {
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

            
        },
        watch: {
            // эта функция запускается при любом изменении count
            totalCount: function () {
                if (GLOBAL_DATA.totalCount == 0)
                {
                    window.location.reload(true);
                }
            }
        },
        methods: {
            validateBeforeSubmit() {
                var _this = this;

                var isValid = true;

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

                orderAddressValidator.Validate();
                if (isValid && !orderAddressValidator.IsValid()) {
                    isValid = false;
                }

                if (GLOBAL_DATA.orderConfirm.deliveryId == '') {
                    isValid = false;
                    $('[data-order-delivery]').css('border', '2px solid red');
                }

                if (GLOBAL_DATA.orderConfirm.paymentId == '') {
                    isValid = false;
                    $('[data-order-payment]').css('border', '2px solid red');
                }

                if (isValid) {
                    _this.createOrder();
                }
            },
            setDeliveryId(deliveryId) {
                var _this = this;
                
                GLOBAL_DATA.orderConfirm.deliveryId = deliveryId; 
            },
            setPaymentId(paymentId) {
                var _this = this;

                GLOBAL_DATA.orderConfirm.paymentId = paymentId;
            },
            createOrder() {
                var _this = this;

                showLoader();

                $.ajax({
                    type: 'post',
                    url: '/order/create',
                    data: {
                        name: GLOBAL_DATA.orderConfirm.name,
                        phone: GLOBAL_DATA.orderConfirm.phone,
                        email: GLOBAL_DATA.orderConfirm.email,
                        paymentId: GLOBAL_DATA.orderConfirm.paymentId,
                        deliveryId: GLOBAL_DATA.orderConfirm.deliveryId,
                        address: GLOBAL_DATA.orderConfirm.address,
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