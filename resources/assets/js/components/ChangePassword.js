if (document.getElementById('change-password'))
{
    var profileOldPasswordValidator, profileNewPasswordValidator, profileConfirmNewPasswordValidator;

    new Vue({
        el: '#change-password',
        data: {
            oldPassword: '',
            newPassword: '',
            confirmNewPassword: ''
        },
        mounted: function () {
            var _this = this;
            // `this` указывает на экземпляр vm
            profileOldPasswordValidator = new RegExValidatingInput($('[data-profile-old-password]'), {
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

            profileNewPasswordValidator = new RegExValidatingInput($('[data-profile-new-password]'), {
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

            profileConfirmNewPasswordValidator = new RegExValidatingInput($('[data-profile-confirm-new-password]'), {
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

                profileOldPasswordValidator.Validate();
                if (!profileOldPasswordValidator.IsValid()) {
                    isValid = false;
                }

                profileNewPasswordValidator.Validate();
                if (isValid && !profileNewPasswordValidator.IsValid()) {
                    isValid = false;
                }

                profileConfirmNewPasswordValidator.Validate();
                if (isValid && !profileConfirmNewPasswordValidator.IsValid()) {
                    isValid = false;
                }

                if (_this.newPassword != _this.confirmNewPassword)
                {
                    $('[data-profile-new-password]').addClass(INCORRECT_FIELD_CLASS);
                    $('[data-profile-confirm-new-password]').addClass(INCORRECT_FIELD_CLASS);
                    isValid = false;
                }

                if (isValid) {
                    _this.changePassword();
                }
            },
            changePassword() {
                var _this = this;

                showLoader();

                $.ajax({
                    type: 'post',
                    url: '/profile/change-password',
                    data: {
                        oldPassword: _this.oldPassword,
                        newPassword: _this.newPassword,
                        language: LANGUAGE
                    },
                    success: function (data) {
                        hideLoader();

                        if (data.status == 'success')
                        {
                            if (data.message == 'goodPass')
                            {
                                showPopup(PASSWORD_CHANGED_MESSAGE);

                                window.location.reload(true);
                            }
                        }

                        if (data.status == 'error')
                        {
                            if (data.message == 'badPass')
                            {
                                showPopup(WRONG_OLD_PASSWORD);
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