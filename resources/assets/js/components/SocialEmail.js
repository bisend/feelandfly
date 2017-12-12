var socialEmailValidator;

new Vue({
    el: '[data-social-email]',
    data: {
        email: ''
    },
    mounted: function () {
        var _this = this;
        // `this` указывает на экземпляр vm

        socialEmailValidator = new RegExValidatingInput($('[data-social-email-input]'), {
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
        validateBeforeSubmit() {
            var _this = this;

            var isValid = true;

            socialEmailValidator.Validate();
            if (!socialEmailValidator.IsValid())
            {
                isValid = false;
            }

            if (isValid)
            {
                _this.loginUser();
            }
        },
        loginUser: function () {
            var _this = this;

            showLoader();

            $.ajax({
                type: 'post',
                url: '/user/social-email',
                data: {
                    email: _this.email,
                    language: LANGUAGE
                },
                success: function (data) {
                    hideLoader();

                    var LOADED = true;

                    if (data.status == 'success')
                    {
                        window.location.reload(true);
                    }

                    if (data.status == 'error')
                    {
                        if (data.failed == 'email')
                        {
                            $('[data-social-email]').modal('hide');

                            $('[data-social-email]').on('hidden.bs.modal', function () {
                                if (LOADED)
                                {
                                    showPopup(EMAIL_NOT_VALID);
                                    LOADED = false;
                                }
                            });
                        }
                        
                    }
                },
                error: function (error) {
                    hideLoader();

                    $('[data-social-email]').modal('hide');

                    var LOADED = true;

                    $('[data-social-email]').on('hidden.bs.modal', function () {
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