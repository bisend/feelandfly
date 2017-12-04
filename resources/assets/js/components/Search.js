if (document.getElementById('search'))
{
    new Vue({
        el: '#search',
        data: {
            showResult: false,
            showNoResult: false,
            series: '',
            url: '/search',
            urlAjax: '',
            searchProducts: [],
            countSearchProducts: 0,
            timer: undefined
        },
        methods: {
            search: function () {
                var _this = this;

                if (_this.series != '')
                {
                    _this.url += '/' + buildSearchUrl(_this.series);

                    if (LANGUAGE != DEFAULT_LANGUAGE)
                    {
                        _this.url += '/' + LANGUAGE;
                    }

                    window.location.href = _this.url;
                }
            },
            searchAjax: function () {
                var _this = this;

                _this.urlAjax = '/search/async';

                if (_this.series == '')
                {
                    _this.showNoResult = false;
                    _this.showResult = false;
                }

                if (_this.series != '')
                {
                    _this.urlAjax += '/' + buildSearchUrl(_this.series);

                    if (LANGUAGE != DEFAULT_LANGUAGE)
                    {
                        _this.urlAjax += '/' + LANGUAGE;
                    }

                    if (_this.timer) {
                        clearTimeout(_this.timer);
                        _this.timer = undefined;
                    }
                    _this.timer = setTimeout(function () {

                        _this.showNoResult = false;

                        _this.showResult = false;

                        $.ajax({
                            type: 'get',
                            url: _this.urlAjax,
                            success: function (data) {
                                _this.searchProducts = data.searchProducts;

                                _this.countSearchProducts = data.countSearchProducts;

                                _this.showNoResult = true;

                                _this.showResult = true;
                            },
                            error: function (error) {
                                _this.showNoResult = true;

                                _this.showResult = true;

                                console.log(error);
                            }
                        });

                    }, 400);
                }
            }
        }
    });
}