if (document.getElementById('sidebar-selected-filters'))
{
    var FILTERS = window.FFShop.filters;

    var SHOW_APPLY_BTN = {};

    for (var fName in FILTERS)
    {
        SHOW_APPLY_BTN[fName] = false;
    }

    new Vue({
        el: '#sidebar-selected-filters',
        data: {
            filters: FILTERS,
            isStateChanged: false,
            show_btn: SHOW_APPLY_BTN,
            categorySlug: window.FFShop.categorySlug,
            filterUrl: ''
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

                if (LANGUAGE != DEFAULT_LANGUAGE)
                {
                    url += '/' + LANGUAGE;
                }

                _this.filterUrl = url;
            }
        }
    });
}