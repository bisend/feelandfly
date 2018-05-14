var notifyEmailValidator;

new Vue({
    'el': '[data-notify]',
    data: GLOBAL_DATA,
    mounted: function () {
        notifyEmailValidator = new RegExValidatingInput($('[data-notify-email]'), {
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
    methods: {
        //method handles onChange count input
        toInteger: function (count) {
            if (count < 1 || count == '') {
                GLOBAL_DATA.notify.count = 1;
            }

            if (count > 9999) {
                GLOBAL_DATA.notify.count = 9999;
            }
        },
        validateBeforeSubmit: function () {
            var _this = this;

            var isValid = true;

            notifyEmailValidator.Validate();
            if ( ! notifyEmailValidator.IsValid()) {
                isValid = false;
            }

            if (isValid) {
                _this.createNotify();
            }
        },
        createNotify: function () {
            var _this = this;

            showLoader();

            $.ajax({
                type: 'post',
                url: '/notify/create',
                data: {
                    email: GLOBAL_DATA.notify.email,
                    name: GLOBAL_DATA.notify.name,
                    count: GLOBAL_DATA.notify.count,
                    productId: GLOBAL_DATA.notify.productId,
                    sizeId: GLOBAL_DATA.notify.sizeId,
                    language: LANGUAGE
                },
                success: function (data) {
                    hideLoader();

                    var LOADED = true;

                    if (data.status == 'success')
                    {
                        $('[data-notify]').modal('hide');

                        $('[data-notify]').on('hidden.bs.modal', function () {
                            if (LOADED)
                            {
                                showPopup(NOTIFY_SUCCESS);
                                LOADED = false;
                            }
                        });
                    }
                },
                error: function (error) {
                    hideLoader();

                    $('[data-notify]').modal('hide');

                    var LOADED = true;

                    $('[data-notify]').on('hidden.bs.modal', function () {
                        if (LOADED)
                        {
                            showPopup(SERVER_ERROR);
                            LOADED = false;
                        }
                    });

                    console.log(error);
                }
            });
        }
    }
});