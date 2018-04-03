if (document.getElementById('profile-payment-delivery'))
{
    // let profileAddressValidator;

    new Vue({
        el: '#profile-payment-delivery',
        data: {
            deliveries: window.FFShop.deliveries,
            delivery: window.FFShop.delivery,
            selectedDeliveryId: window.FFShop.selectedDeliveryId,
            deliveryType: null,
        },
        mounted: function () {
            // profileAddressValidator = new RegExValidatingInput($('[data-profile-address]'), {
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
            delivery: () => {
                $('[data-profile-delivery]').find('.dropdown-toggle').css('border', '2px solid black');
            },
        },
        methods: {
            validateBeforeSubmit: function () {
                let _this = this;

                let isValid = true;

                // profileAddressValidator.Validate();
                // if (!profileAddressValidator.IsValid()) {
                //     isValid = false;
                // }

                // if (_this.selectedPaymentId == null) {
                //     isValid = false;
                //     $('[data-profile-payment]').css('border', '2px solid red');
                // }

                // if (_this.selectedDeliveryId == null) {
                //     isValid = false;
                //     $('[data-profile-delivery]').css('border', '2px solid red');
                // }

                if (_this.delivery == null)
                {
                    isValid = false;
                    $('[data-profile-delivery]').find('.dropdown-toggle').css('border', '2px solid red');
                }

                if (isValid) {
                    _this.savePaymentDelivery();
                }
            },
            savePaymentDelivery: function () {
                let _this = this;

                showLoader();

                $.ajax({
                    type: 'post',
                    url: '/profile/save-payment-delivery',
                    data: {
                        // paymentId: _this.selectedPaymentId,
                        deliveryId: _this.delivery.id,
                        address: _this.address,
                        language: LANGUAGE
                    },
                    success: function (data) {
                        hideLoader();

                        if (data.status === 'success')
                        {
                            showPopup(PERSONAL_INFO_SAVED);
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