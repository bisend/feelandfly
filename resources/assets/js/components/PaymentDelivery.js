if (document.getElementById('profile-payment-delivery'))
{
    // let profileAddressValidator;

    let profileAStreetValidator, profileALandValidator, profileACityValidator;

    new Vue({
        el: '#profile-payment-delivery',
        data: {
            lang: LANGUAGE,
            deliveries: window.FFShop.deliveries,
            delivery: (window.FFShop.delivery == null ? null : window.FFShop.delivery),

            deliveryTypes: window.FFShop.deliveryTypes,
            deliveryType: (window.FFShop.deliveryType == null ? null : window.FFShop.deliveryType),

            countries: window.FFShop.countries,
            DEFAULT_COUNTRY: [DEFAULT_COUNTRY],
            country: (window.FFShop.country == null ? DEFAULT_COUNTRY : window.FFShop.country),

            aStreet: '',
            aLand: '',
            aCity: '',
            aIndex: '',

            cities: [],
            selectedCityRef: (window.FFShop.selectedCityRef == null ? null : window.FFShop.selectedCityRef),
            city: null,

            warehouses: [],
            selectedWarehouseRef: (window.FFShop.selectedWarehouseRef == null ? null : window.FFShop.selectedWarehouseRef),
            warehouse: null,
            disableWarehouse: true,

            checkoutPoints: window.FFShop.checkoutPoints,
            checkoutPoint: (window.FFShop.checkoutPoint == null ? null : window.FFShop.checkoutPoint)
        },
        mounted: function () {

            if (this.selectedCityRef)
            {
                this.getCity(this.selectedCityRef);
            }
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

            $('body').on('click', '.selected-tag', function (e) {
                $(this).siblings('input').focus();
            });
        },
        watch: {
            delivery: function () {
                $('[data-profile-delivery]').find('.dropdown-toggle').css('border', '2px solid black');
            },
            deliveryType: function (newVal, oldVal) {
                if (newVal && (newVal.name === 'Номер отделения' || newVal.name === 'Номер відділення'))
                {
                    this.country = DEFAULT_COUNTRY;
                }

                profileAStreetValidator = new RegExValidatingInput($('[data-profile-a-street]'), {
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

                profileALandValidator = new RegExValidatingInput($('[data-profile-a-land]'), {
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

                profileACityValidator = new RegExValidatingInput($('[data-profile-a-city]'), {
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

                $('[data-profile-delivery-type]').find('.dropdown-toggle').css('border', '2px solid black');
            },
            city: function(newVal, oldVal) {
                if (this.city != null)
                {
                    $('[data-profile-city]').find('.dropdown-toggle').css('border', '2px solid black');
                    this.disableWarehouse = false;
                }
                else
                {
                    this.disableWarehouse = true;
                }
            },
        },
        methods: {
            getCity: function (selectedCityRef) {
                let _this = this;

                $.ajax({
                    async: true,
                    crossDomain: true,
                    url: 'https://api.novaposhta.ua/v2.0/json/',
                    method: 'POST',
                    processData: false,
                    data: JSON.stringify({
                        apiKey: NOVA_POSHTA_API_KEY,
                        modelName: 'Address',
                        calledMethod: 'getCities',
                        methodProperties: {
                            Ref: selectedCityRef
                        },
                    }),
                    beforeSend: function (request) {
                        request.setRequestHeader("Content-Type", "application/json");
                    },
                    success: function (data) {
                        console.log(data);

                        if (data &&
                            data.data &&
                            data.data.length > 0)
                        {
                            _this.city = data.data[0];
                            _this.cities = data.data;
                            _this.getWarehouse(_this.selectedWarehouseRef);
                        }
                        else
                        {
                            _this.cities = [];
                            _this.city = null;
                        }
                    },
                    complete: function () {
                        // loading(false);
                    },
                    error: function (error) {
                        // loading(false);
                        console.log(error);
                    }
                });
            },
            getWarehouse: function (selectedWarehouseRef) {
                let _this = this;

                $.ajax({
                    async: true,
                    crossDomain: true,
                    url: 'https://api.novaposhta.ua/v2.0/json/',
                    method: 'POST',
                    processData: false,
                    data: JSON.stringify({
                        apiKey: NOVA_POSHTA_API_KEY,
                        modelName: 'Address',
                        calledMethod: 'getWarehouses',
                        methodProperties: {
                            CityRef: _this.selectedCityRef,
                            // Ref: selectedWarehouseRef
                        },
                    }),
                    beforeSend: function (request) {
                        request.setRequestHeader("Content-Type", "application/json");
                    },
                    success: function (data) {

                        console.log(data);

                        if (data &&
                            data.data &&
                            data.data.length > 0)
                        {
                            data.data.forEach(function (item, i) {
                                if (item.Ref === selectedWarehouseRef)
                                {
                                    _this.warehouse = item;
                                }
                            });
                            _this.warehouses = data.data;
                        }
                        else
                        {
                            _this.warehouses = [];
                            _this.warehouse = null;
                        }
                    },
                    complete: function () {
                        // loading(false);///dsd
                    },
                    error: function (error) {
                        // loading(false);
                        console.log(error);
                    }
                });
            },
            searchCity: _.debounce(function(search, loading) {
                let _this = this;

                $.ajax({
                    async: true,
                    crossDomain: true,
                    url: 'https://api.novaposhta.ua/v2.0/json/',
                    method: 'POST',
                    processData: false,
                    data: JSON.stringify({
                        apiKey: NOVA_POSHTA_API_KEY,
                        modelName: 'Address',
                        calledMethod: 'getCities',
                        methodProperties: {
                            FindByString: search.trim().toLowerCase()
                        },
                    }),
                    beforeSend: function (request) {
                        loading(true);
                        request.setRequestHeader("Content-Type", "application/json");
                    },
                    success: function (data) {
                        console.log(data);

                        if (data &&
                            data.data &&
                            data.data.length > 0)
                        {
                            _this.cities = data.data;
                        }
                        else
                        {
                            _this.cities = [];
                        }
                    },
                    complete: function () {
                        loading(false);
                    },
                    error: function (error) {
                        loading(false);
                        console.log(error);
                    }
                });

            }, 350),
            searchWarehouses: function(value) {
                let _this = this;

                // _this.warehouse = null;

                _this.city = value;

                console.log('search warehouses');

                if (_this.city != null &&
                    _this.city !== '')
                {
                    $.ajax({
                        async: true,
                        crossDomain: true,
                        url: 'https://api.novaposhta.ua/v2.0/json/',
                        method: 'POST',
                        processData: false,
                        data: JSON.stringify({
                            apiKey: NOVA_POSHTA_API_KEY,
                            modelName: 'Address',
                            calledMethod: 'getWarehouses',
                            methodProperties: {
                                CityRef: value.Ref
                            },
                        }),
                        beforeSend: function (request) {
                            request.setRequestHeader("Content-Type", "application/json");
                        },
                        success: function (data) {

                            console.log(data);

                            if (data &&
                                data.data &&
                                data.data.length > 0)
                            {
                                _this.warehouses = data.data;
                            }
                            else
                            {
                                _this.warehouses = [];
                            }
                        },
                        complete: function () {
                            // loading(false);///dsd
                        },
                        error: function (error) {
                            loading(false);
                            console.log(error);
                        }
                    });
                }
            },
            validateBeforeSubmit: function () {
                let _this = this;

                let isValid = true;

                // profileAddressValidator.Validate();
                // if (!profileAddressValidator.IsValid()) {
                //     isValid = false;
                // }

                if (_this.delivery == null)
                {
                    isValid = false;
                    $('[data-profile-delivery]').find('.dropdown-toggle').css('border', '2px solid red');
                }
                else
                {
                    //CASE SELF CHECKOUT
                    if (_this.delivery.name === 'Самовывоз' || _this.delivery.name === 'Самовивіз')
                    {
                        if (_this.checkoutPoint == null)
                        {
                            isValid = false;
                            $('[data-profile-points]').find('.dropdown-toggle').css('border', '2px solid red');
                            console.log('NP checkout');
                        }
                    }
                    //SELF CHECKOUT END

                    // CASE NOVA POSHTA
                    if (_this.delivery.name === 'Новая почта' || _this.delivery.name === 'Нова пошта')
                    {
                        //VALIDATE DELIVERY TYPE
                        if (_this.deliveryType == null)
                        {
                            isValid = false;
                            $('[data-profile-delivery-type]').find('.dropdown-toggle').css('border', '2px solid red');
                            console.log('dostavka tip');
                        }
                        //VALIDATE DELIVERY TYPE END

                        if (_this.deliveryType != null)
                        {
                            //CASE ADDRESS DELIVERY
                            if (_this.deliveryType.name === 'Адресная доставка'
                                || _this.deliveryType.name === 'Адресна доставка')
                            {
                                //VALIDATE COUNTRY
                                if (_this.country == null || _this.country === '')
                                {
                                    isValid = false;
                                    $('[data-profile-country]').find('.dropdown-toggle').css('border', '2px solid red');
                                    console.log('dostavka country');
                                }
                                //VALIDATE COUNTRY END
                                else
                                {
                                    // VALIDATE STREET
                                    profileAStreetValidator.Validate();
                                    if (!profileAStreetValidator.IsValid()) {
                                        isValid = false;
                                        console.log('A street');
                                    }

                                    // VALIDATE LAND
                                    profileALandValidator.Validate();
                                    if (!profileALandValidator.IsValid()) {
                                        isValid = false;
                                        console.log('A land');
                                    }

                                    // VALIDATE CITY
                                    profileACityValidator.Validate();
                                    if (!profileACityValidator.IsValid()) {
                                        isValid = false;
                                        console.log('A city');
                                    }
                                }
                            }
                            //CASE ADDRESS DELIVERY END

                            //CASE NUMBER WAREHOUSE
                            if (_this.deliveryType.name === 'Номер отделения'
                                || _this.deliveryType.name === 'Номер відділення')
                            {
                                //VALIDATE NP CITY
                                if (_this.city == null || _this.city === '')
                                {
                                    isValid = false;
                                    $('[data-profile-city]').find('.dropdown-toggle').css('border', '2px solid red');
                                    console.log('NP city');
                                }
                                //VALIDATE NP CITY END
                                else
                                {
                                    //VALIDATE NP WAREHOUSE
                                    if (_this.warehouse == null || _this.warehouse === '')
                                    {
                                        isValid = false;
                                        $('[data-profile-warehouse]').find('.dropdown-toggle').css('border', '2px solid red');
                                        console.log('NP warehouse');
                                    }
                                    //VALIDATE NP WAREHOUSE END
                                }
                            }
                            //CASE NUMBER WAREHOUSE END
                        }
                    }
                    // CASE NOVA POSHTA END
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
                        deliveryId: _this.delivery.id,
                        deliveryTypeId: _this.deliveryType.id,
                        countryName: _this.country.name,
                        countryCode: _this.country.code,
                        cityRef: _this.city.Ref,
                        warehouseRef: _this.warehouse.Ref,
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