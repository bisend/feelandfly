if (document.getElementById('register-popup'))
{
    var nameValidator = {};
    var emailValidator = {};
    var passwordValidator = {};
    var confirmValidator = {};

    new Vue({
        el: '#register-popup',
        data: {
            name: '',
            email: '',
            password: '',
            confirmPassword: '',
            isConfirmInvalid: false
        },
        mounted: function () {
            var _this = this;
            // `this` указывает на экземпляр vm
            nameValidator = new RegExValidatingInput($('[data-register-name]'), {
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
            
            emailValidator = new RegExValidatingInput($('[data-register-email]'), {
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
            
            passwordValidator = new RegExValidatingInput($('[data-register-password]'), {
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
            
            confirmValidator = new RegExValidatingInput($('[data-register-confirm]'), {
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

                nameValidator.Validate();
                if (!nameValidator.IsValid())
                {
                    isValid = false;
                }

                emailValidator.Validate();
                if (isValid && !emailValidator.IsValid())
                {
                    isValid = false;
                }

                passwordValidator.Validate();
                if (isValid && !passwordValidator.IsValid())
                {
                    isValid = false;
                }

                confirmValidator.Validate();
                if (isValid && !confirmValidator.IsValid())
                {
                    isValid = false;
                }

                if (_this.password != _this.confirmPassword)
                {
                    $('[data-register-confirm]').addClass(INCORRECT_FIELD_CLASS);
                    isValid = false;
                    _this.isConfirmInvalid = true;
                }
                else
                {
                    _this.isConfirmInvalid = false;
                }

                if (isValid)
                {
                    _this.registerUser();
                }
            },
            registerUser: function () {
                var _this = this;
                
                showLoader();
                
                $.ajax({
                    type: 'post',
                    url: '/user/register',
                    data: {
                        name: _this.name,
                        email: _this.email,
                        password: _this.password,
                        language: LANGUAGE
                    },
                    success: function (data) {
                        hideLoader();

                        var LOADED = true;

                        $('#register-popup').modal('hide');

                        if (data.status == 'success')
                        {
                            $('#register-popup').on('hidden.bs.modal', function () {
                                if (LOADED)
                                {
                                    showPopup(REGISTER_SUCCESS);
                                    LOADED = false;
                                }
                            });
                        }

                        if (data.status == 'error')
                        {
                            if (data.failed == 'email')
                            {
                                $('#register-popup').on('hidden.bs.modal', function () {
                                    if (LOADED)
                                    {
                                        showPopup(EMAIL_NOT_VALID);
                                        LOADED = false;
                                    }
                                });
                            }

                            if (data.failed == 'server')
                            {
                                $('#register-popup').on('hidden.bs.modal', function () {
                                    if (LOADED)
                                    {
                                        showPopup(SERVER_ERROR);
                                        LOADED = false;
                                    }
                                });
                            }
                        }
                    },
                    error: function (error) {
                        hideLoader();

                        $('#register-popup').modal('hide');

                        var LOADED = true;

                        $('#register-popup').on('hidden.bs.modal', function () {
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