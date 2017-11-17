if (document.getElementById('sidebar-filters'))
{
    var FILTERS = window.FFShop.filters;

    var SHOW_APPLY_BTN = {};

    for (var fName in FILTERS)
    {
        SHOW_APPLY_BTN[fName] = false;
    }

    new Vue({
        el: '#sidebar-filters',
        data: {
            filters: FILTERS,
            isStateChanged: false,
            show_btn: SHOW_APPLY_BTN
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

                        if (fValue.isChecked)
                        {
                            _this.isStateChanged = true;
                            SHOW_APPLY_BTN[[fName]] = true;
                        }
                    });
                }
            },
            isCheckSelected: function (filterName) {
                return (SHOW_APPLY_BTN[[filterName]] ? true : false);
            },
            buildFilterArray: function (filterNameSlug, filterValueSlug) {
                console.log(filterNameSlug, filterValueSlug);
            }
        }
    });
}