if (document.getElementById('personal-info'))
{
    let profileNameValidator, profileEmailValidator, profilePhoneValidator;
    
    new Vue({
        el: '#personal-info',
        data: {
            name: window.FFShop.auth.user.name,
            email: window.FFShop.auth.user.email,
            phone: window.FFShop.auth.profile.phone_number
        },
        mounted: function () {
            let _this = this;
            // `this` указывает на экземпляр vm
            profileNameValidator = new RegExValidatingInput($('[data-profile-name]'), {
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
            
            profileEmailValidator = new RegExValidatingInput($('[data-profile-email]'), {
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

            profilePhoneValidator = new RegExValidatingInput($('[data-profile-phone]'), {
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
        },
        methods: {
            validateBeforeSubmit() {
                let _this = this;

                let isValid = true;

                profileNameValidator.Validate();
                if (!profileNameValidator.IsValid()) {
                    isValid = false;
                }

                profileEmailValidator.Validate();
                if (isValid && !profileEmailValidator.IsValid()) {
                    isValid = false;
                }

                profilePhoneValidator.Validate();
                if (isValid && !profilePhoneValidator.IsValid()) {
                    isValid = false;
                }

                if (isValid) {
                    _this.savePersonalInfo();
                }
            },

            savePersonalInfo() {
                let _this = this;

                showLoader();

                $.ajax({
                    type: 'post',
                    url: '/profile/save-personal-info',
                    data: {
                        name: _this.name,
                        email: _this.email,
                        phone: _this.phone,
                        language: LANGUAGE
                    },
                    success: function (data) {
                        hideLoader();

                        if (data.status === 'success')
                        {
                            if (data.emailChanged == true)
                            {
                                showPopup(EMAIL_CHANGED_MESSAGE);
                            }
                            else
                            {
                                showPopup(PERSONAL_INFO_SAVED);
                                window.location.reload(true);
                            }
                        }

                        if (data.status == 'error')
                        {
                            if (data.isNewEmailValid == false)
                            {
                                showPopup(EMAIL_NOT_VALID);
                            }

                            if (data.failed == 'server')
                            {
                                showPopup(SERVER_ERROR);
                            }
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