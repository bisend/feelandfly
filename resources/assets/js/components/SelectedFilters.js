if (document.getElementById('sidebar-selected-filters'))
{
    var FILTERS = window.FFShop.filters;

    var SHOW_APPLY_BTN = {};

    for (var fName in FILTERS)
    {
        SHOW_APPLY_BTN[fName] = false;
    }

    var FILTERS_DATA = {
        filters: FILTERS,
        isStateChanged: false,
        show_btn: SHOW_APPLY_BTN,
        categorySlug: window.FFShop.categorySlug,
        filterUrl: '',
        initialPriceMin: Math.floor(window.FFShop.initialPriceMin),
        initialPriceMax: Math.round(window.FFShop.initialPriceMax),
        oldPriceMin: Math.floor(window.FFShop.priceMin),
        oldPriceMax: Math.round(window.FFShop.priceMax),
        priceMin: Math.floor(window.FFShop.priceMin),
        priceMax: Math.round(window.FFShop.priceMax)
    };

    new Vue({
        el: '#sidebar-selected-filters',
        data: FILTERS_DATA,
        mounted: function () {
            var _this = this;

            this.$nextTick(function () {
                /*------------------- Sidebar Filter Range -------------------*/
                var priceSliderRange = $('#price-range');
                if ($.ui) {
                    if ($(priceSliderRange).length) {
                        $(priceSliderRange).slider({
                            range: true,
                            min: FILTERS_DATA.initialPriceMin,
                            max: FILTERS_DATA.initialPriceMax,
                            values: [FILTERS_DATA.priceMin ? FILTERS_DATA.priceMin : FILTERS_DATA.initialPriceMin, FILTERS_DATA.priceMax ? FILTERS_DATA.priceMax : FILTERS_DATA.initialPriceMax],
                            slide: function (event, ui) {
                                //$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                                $("#price-min").html(ui.values[0] + " грн");
                                $("#price-max").html(ui.values[1] + " грн" );
                                // console.log(ui.values);
                                FILTERS_DATA.priceMin = ui.values[0];
                                FILTERS_DATA.priceMax = ui.values[1];

                                _this.buildSelectedFiltersArray();
                            }
                        });
                        $("#price-min").html($("#price-range").slider("values", 0) + " грн");
                        $("#price-max").html($("#price-range").slider("values", 1) + " грн");
                    }
                }
            })
        },
        methods: {
            setCheck: function (filterName, valueCounter) {
                var _this = this;

                _this.isStateChanged = false;

                FILTERS[filterName][valueCounter].isChecked = !FILTERS[filterName][valueCounter].isChecked;

                SHOW_APPLY_BTN[[filterName]] = false;

                for (var fName in FILTERS)
                {
                    FILTERS[fName].forEach(function (fValue) {

                        if (fValue.isChecked != fValue.initialState)
                        {
                            _this.isStateChanged = true;
                            SHOW_APPLY_BTN[[fName]] = true;
                        }
                    });
                }

                _this.buildSelectedFiltersArray();
            },
            isCheckSelected: function (filterName) {
                return (SHOW_APPLY_BTN[[filterName]] ? true : false);
            },
            buildSelectedFiltersArray: function () {
                var _this = this;
                var url = '/category/' + _this.categorySlug;
                var arrayOfPairs = [];

                for (var fName in FILTERS)
                {
                    var values = [];

                    var valuesStr = '';

                    var filterName = '';

                    FILTERS[fName].forEach(function (fValue) {
                        if (fValue.isChecked)
                        {
                            filterName = fValue.filter_name_slug;
                            values.push(fValue.filter_value_slug);
                        }
                    });

                    valuesStr = values.join();

                    if (valuesStr.length > 0)
                    {
                        arrayOfPairs.push(filterName + '=' + valuesStr);
                    }
                }

                if (arrayOfPairs.length > 0)
                {
                    url += '/' + arrayOfPairs.join(';');
                }

                // if (FILTERS_DATA.initialPriceMin != FILTERS_DATA.priceMin || FILTERS_DATA.initialPriceMax != FILTERS_DATA.priceMax)
                if (FILTERS_DATA.priceMin && FILTERS_DATA.priceMax && (FILTERS_DATA.initialPriceMin != FILTERS_DATA.priceMin || FILTERS_DATA.initialPriceMax != FILTERS_DATA.priceMax))
                {
                    if (arrayOfPairs.length > 0)
                    {
                        url += ';price-range=' + FILTERS_DATA.priceMin + ',' + FILTERS_DATA.priceMax;
                    }
                    else
                    {
                        url += '/price-range=' + FILTERS_DATA.priceMin + ',' + FILTERS_DATA.priceMax;
                    }
                }

                if (LANGUAGE != DEFAULT_LANGUAGE)
                {
                    url += '/' + LANGUAGE;
                }

                _this.filterUrl = url;
            }
        }
    });
}