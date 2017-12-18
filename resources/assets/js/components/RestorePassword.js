var restorePasswordEmailValidator;

new Vue({
    el: '[data-restore-password]',
    data: {
        email: ''
    },
    mounted: function () {
        var _this = this;
        // `this` указывает на экземпляр vm

        restorePasswordEmailValidator = new RegExValidatingInput($('[data-restore-email-input]'), {
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

            restorePasswordEmailValidator.Validate();
            if (!restorePasswordEmailValidator.IsValid())
            {
                isValid = false;
            }

            if (isValid)
            {
                _this.restorePassword();
            }
        },
        restorePassword() {
            var _this = this;

            showLoader();

            $.ajax({
                type: 'post',
                url: '/user/restore-password',
                data: {
                    email: _this.email,
                    language: LANGUAGE
                },
                success: function (data) {
                    hideLoader();

                    var LOADED = true;

                    if (data.status == 'success')
                    {
                        $('[data-restore-password]').modal('hide');

                        $('[data-restore-password]').on('hidden.bs.modal', function () {
                            if (LOADED)
                            {
                                showPopup(RESTORE_SUCCESS);
                                LOADED = false;
                            }
                        });
                    }

                    if (data.status == 'error')
                    {
                        if (data.failed == 'email')
                        {
                            $('[data-restore-password]').modal('hide');

                            $('[data-restore-password]').on('hidden.bs.modal', function () {
                                if (LOADED)
                                {
                                    showPopup(EMAIL_NOT_EXISTS);
                                    LOADED = false;
                                }
                            });
                        }

                        if (data.failed == 'server')
                        {
                            $('[data-restore-password]').modal('hide');

                            $('[data-restore-password]').on('hidden.bs.modal', function () {
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

                    $('[data-restore-password]').modal('hide');

                    var LOADED = true;

                    $('[data-restore-password]').on('hidden.bs.modal', function () {
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