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

                _this.url = '/search';

                if (_this.series !== '')
                {
                    _this.url += '/' + buildSearchUrl(_this.series);

                    if (LANGUAGE !== DEFAULT_LANGUAGE)
                    {
                        _this.url += '/' + LANGUAGE;
                    }

                    window.location.href = _this.url;
                }
            },
            searchAjax: _.debounce(function () {
                var _this = this;

                _this.urlAjax = '/search/async';

                _this.url = '/search';

                if (_this.series === '')
                {
                    _this.showNoResult = false;
                    _this.showResult = false;
                }

                if (_this.series !== '')
                {
                    _this.urlAjax += '/' + buildSearchUrl(_this.series);

                    if (LANGUAGE !== DEFAULT_LANGUAGE)
                    {
                        _this.urlAjax += '/' + LANGUAGE;
                    }

                    _this.url += '/' + buildSearchUrl(_this.series);

                    if (LANGUAGE !== DEFAULT_LANGUAGE)
                    {
                        _this.url += '/' + LANGUAGE;
                    }

                    _this.showNoResult = false;

                    _this.showResult = true;

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
                }
            }, 450),
            onEsc: function() {
                var _this = this;

                $('#search').find('input').blur();

                _this.series = '';
            },
            onBlur: function(event) {
                var _this = this;

                _this.series = '';

                var i = $('button.open-search').find('i');

                if(i.hasClass('fa-times') &&
                    !searchBtnClicked &&
                    !$(event.relatedTarget).hasClass('result-item-link') &&
                    !$(event.relatedTarget).hasClass('all-search-results-btn'))
                {
                    i.removeClass('fa-times').addClass('fa-search');
                    $('.profile-search-smoll').animate({
                        width: '0'
                    }, function(){
                        $('.navbar-nav').show(50);
                        $('.open-search-this-none').fadeIn(100);
                        $('.profile-search-smoll').stop().hide();
                        $('.open-search').css('border', 'none');
                    });

                    searchWasHidden = !searchWasHidden;
                }
            }
        }
    });
}