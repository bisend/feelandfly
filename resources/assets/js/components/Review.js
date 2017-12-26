if (document.getElementById('single-product-review'))
{
    var reviewNameValidator, reviewEmailValidator, reviewTextValidator;

    GLOBAL_DATA.totalReviewsCount = window.FFShop.reviewsCount;
    GLOBAL_DATA.reviews = window.FFShop.reviews;

    new Vue({
        el: '#single-product-review',
        data: GLOBAL_DATA,
        mounted: function () {
            var _this = this;
            // `this` указывает на экземпляр vm

            GLOBAL_DATA.reviewsPages = _this.createPagination(GLOBAL_DATA.reviewsCurrentPage, 5, GLOBAL_DATA.totalReviewsCount);

            reviewNameValidator = new RegExValidatingInput($('[data-review-name]'), {
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
            
            reviewEmailValidator = new RegExValidatingInput($('[data-review-email]'), {
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
            
            reviewTextValidator = new RegExValidatingInput($('[data-review-text]'), {
                expression: RegularExpressions.SIMPLE_TEXT,
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
        watch: {
            reviewsCurrentPage: function () {
                var _this = this;

                GLOBAL_DATA.reviewsPages = _this.createPagination(GLOBAL_DATA.reviewsCurrentPage, 5, GLOBAL_DATA.totalReviewsCount);

                _this.getReviews();
            }
        },
        methods: {
            range: function(low, high, step) {
                var matrix = [];
                var inival, endval, plus;
                var walker = step || 1;
                var chars  = false;

                if ( !isNaN ( low ) && !isNaN ( high ) ) {
                    inival = low;
                    endval = high;
                } else if ( isNaN ( low ) && isNaN ( high ) ) {
                    chars = true;
                    inival = low.charCodeAt ( 0 );
                    endval = high.charCodeAt ( 0 );
                } else {
                    inival = ( isNaN ( low ) ? 0 : low );
                    endval = ( isNaN ( high ) ? 0 : high );
                }

                plus = ( ( inival > endval ) ? false : true );
                if ( plus ) {
                    while ( inival <= endval ) {
                        matrix.push ( ( ( chars ) ? String.fromCharCode ( inival ) : inival ) );
                        inival += walker;
                    }
                } else {
                    while ( inival >= endval ) {
                        matrix.push ( ( ( chars ) ? String.fromCharCode ( inival ) : inival ) );
                        inival -= walker;
                    }
                }

                return matrix;
            },
            createPagination: function (page, itemsPerPage, totalItemsCount) {
                var _this = this;
                var maxElements = 7;
                var pages = [];
                var lastPage = Math.ceil(totalItemsCount / itemsPerPage);
                var minMiddle;
                var maxMiddle;
                var pagesPerBothSides;
                var min;
                var max;
                var pagesPerLeftSide;
                var pagesPerRightSide;

                if (maxElements >= lastPage)
                {
                    pages = _this.range(1, lastPage);
                }
                else
                {
                    minMiddle = Math.ceil(maxElements / 2);
                    maxMiddle = Math.ceil(lastPage - maxElements / 2);

                    if (page > minMiddle)
                    {
                        pages.push(1);
                        pages.push('...');
                    }

                    if (page > minMiddle && page < maxMiddle) {
                        pagesPerBothSides = Math.floor(maxElements / 4);
                        min = page - pagesPerBothSides;
                        max = page + pagesPerBothSides;
                        for (var i = min; i <= max; i++) {
                            pages.push(i);
                        }
                    }
                    else if (page <= minMiddle)
                    {
                        pagesPerLeftSide = maxElements - 2;
                        for (i = 1; i <= pagesPerLeftSide; i++)
                        {
                            pages.push(i);
                        }
                    }
                    else if (page >= maxMiddle)
                    {
                        pagesPerRightSide = maxElements - 3;
                        min = lastPage - pagesPerRightSide;
                        for (i = min; i <= lastPage; i++)
                        {
                            pages.push(i);
                        }
                    }

                    if (page < maxMiddle) {
                        pages.push('...');
                        pages.push(lastPage);
                    }
                }

                if (page == 1) {
                    pages.unshift(false);
                } else {
                    pages.unshift(true);
                }

                if (page == lastPage) {
                    pages.push(false);
                } else {
                    pages.push(true);
                }

                /////////
                GLOBAL_DATA.reviewIsPrev = pages.shift();
                GLOBAL_DATA.reviewIsNext = pages.pop();

                return pages;
            },
            setPage: function (page) {
                GLOBAL_DATA.reviewsCurrentPage = page;
            },
            getReviews() {
                var _this = this;

                showLoader();

                $.ajax({
                    type: 'post',
                    url: '/get-reviews',
                    data: {
                        productId: GLOBAL_DATA.singleProduct.productId,
                        page: GLOBAL_DATA.reviewsCurrentPage,
                        language: LANGUAGE
                    },
                    success: function (data) {
                        GLOBAL_DATA.reviews = data.reviews;
                        hideLoader();
                    },
                    error: function (error) {
                        hideLoader();
                        console.log(error);
                        showPopup(SERVER_ERROR);
                    }
                });
            },
            validateBeforeSubmit() {
                var _this = this;

                var isValid = true;

                reviewNameValidator.Validate();
                if (!reviewNameValidator.IsValid())
                {
                    isValid = false;
                }

                reviewEmailValidator.Validate();
                if (isValid && !reviewEmailValidator.IsValid())
                {
                    isValid = false;
                }
                
                reviewTextValidator.Validate();
                if (isValid && !reviewTextValidator.IsValid())
                {
                    isValid = false;
                }

                if (GLOBAL_DATA.review.rating < 1)
                {
                    isValid = false;
                    GLOBAL_DATA.review.validatedFalse = true;
                }

                if (isValid)
                {
                    _this.saveReview();
                }
            },
            saveReview() {
                var _this = this;

                showLoader();

                $.ajax({
                    type: 'post',
                    url: '/add-review',
                    data: {
                        productId: GLOBAL_DATA.singleProduct.productId,
                        review: GLOBAL_DATA.review.text,
                        name: GLOBAL_DATA.review.name,
                        email: GLOBAL_DATA.review.email,
                        rating: GLOBAL_DATA.review.rating,
                        language: LANGUAGE
                    },
                    success: function (data) {
                        hideLoader();

                        if (data.status == 'success')
                        {
                            GLOBAL_DATA.review.text = '';
                            GLOBAL_DATA.review.rating = 0;
                            GLOBAL_DATA.review.hoverRating = 0;
                            GLOBAL_DATA.review.tempRating = 0;
                            showPopup(REVIEW_ADDED);
                        }

                        if (data.status == 'error')
                        {
                            showPopup(SERVER_ERROR);
                        }
                    },
                    error: function (error) {
                        hideLoader();
                        console.log(error);
                        showPopup(SERVER_ERROR);
                    }
                });
            },
            hoverStars(rating) {
                GLOBAL_DATA.review.tempRating = GLOBAL_DATA.review.rating;
                GLOBAL_DATA.review.hoverRating = rating;
                GLOBAL_DATA.review.rating = GLOBAL_DATA.review.hoverRating;
            },
            mouseLeave() {
                GLOBAL_DATA.review.rating = GLOBAL_DATA.review.tempRating;
                GLOBAL_DATA.review.hoverRating = GLOBAL_DATA.review.rating;
            },
            clickStars(rating) {
                GLOBAL_DATA.review.rating = rating;
                GLOBAL_DATA.review.tempRating = rating;
                GLOBAL_DATA.review.validatedFalse = false;
            },
            scrollToReview() {
                $('html, body').animate({
                    scrollTop: ($("[data-review-form]").offset().top) - 150
                }, 600);
            }
        }
    });
}