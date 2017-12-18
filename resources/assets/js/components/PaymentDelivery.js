if (document.getElementById('profile-payment-delivery'))
{
    var profileAddressValidator;
    
    new Vue({
        el: '#profile-payment-delivery',
        data: {
            selectedPaymentId: window.FFShop.selectedPaymentId,
            selectedDeliveryId: window.FFShop.selectedDeliveryId,
            address: window.FFShop.address
        },
        mounted: function () {
            profileAddressValidator = new RegExValidatingInput($('[data-profile-address]'), {
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
        methods: {
            setSelectedPaymentId: function (paymentId) {
                var _this = this;
                
                _this.selectedPaymentId = paymentId;
            },
            setSelectedDeliveryId: function (deliveryId) {
                var _this = this;

                _this.selectedDeliveryId = deliveryId;
            },
            validateBeforeSubmit: function () {
                var _this = this;

                var isValid = true;

                profileAddressValidator.Validate();
                if (!profileAddressValidator.IsValid()) {
                    isValid = false;
                }

                if (_this.selectedPaymentId == null) {
                    isValid = false;
                    $('[data-profile-payment]').css('border', '2px solid red');
                }

                if (_this.selectedDeliveryId == null) {
                    isValid = false;
                    $('[data-profile-delivery]').css('border', '2px solid red');
                }

                if (isValid) {
                    _this.savePaymentDelivery();
                }
            },
            savePaymentDelivery: function () {
                var _this = this;

                showLoader();

                $.ajax({
                    type: 'post',
                    url: '/profile/save-payment-delivery',
                    data: {
                        paymentId: _this.selectedPaymentId,
                        deliveryId: _this.selectedDeliveryId,
                        address: _this.address,
                        language: LANGUAGE
                    },
                    success: function (data) {
                        hideLoader();

                        if (data.status == 'success')
                        {
                            showPopup(PERSONAL_INFO_SAVED);
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