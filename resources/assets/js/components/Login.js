if (document.getElementById('login-popup'))
{
    
    new Vue({
        el: '#login-popup',
        data: {
            email: '',
            password: ''
        },
        mounted: function () {
            var _this = this;
            // `this` указывает на экземпляр vm
            
            emailValidator = new RegExValidatingInput($('[data-login-email]'), {
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

            passwordValidator = new RegExValidatingInput($('[data-login-password]'), {
                expression: RegularExpressions.PASSWORD,
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

                emailValidator.Validate();
                if (!emailValidator.IsValid())
                {
                    isValid = false;
                }

                passwordValidator.Validate();
                if (isValid && !passwordValidator.IsValid())
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
                    type: 'get',
                    url: '/user/login',
                    data: {
                        email: _this.email,
                        password: _this.password,
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
                                $('#login-popup').modal('hide');

                                $('#login-popup').on('hidden.bs.modal', function () {
                                    if (LOADED)
                                    {
                                        showPopup(EMAIL_NOT_EXISTS);
                                        LOADED = false;
                                    }
                                });
                            }

                            if (data.failed == 'active')
                            {
                                $('#login-popup').modal('hide');

                                $('#login-popup').on('hidden.bs.modal', function () {
                                    if (LOADED)
                                    {
                                        showPopup(EMAIL_CONFIRM_NOT_VALID);
                                        LOADED = false;
                                    }
                                });
                            }

                            if (data.failed == 'password')
                            {
                                $('[data-login-password]').val('').addClass(INCORRECT_FIELD_CLASS).attr("placeholder", INCORRECT_FIELD_TEXT);
                            }
                        }
                    },
                    error: function (error) {
                        hideLoader();

                        $('#login-popup').modal('hide');

                        var LOADED = true;

                        $('#login-popup').on('hidden.bs.modal', function () {
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
    
}