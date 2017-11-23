@php($pages = \App\Helpers\Paginator::createPagination($model->page, $model->categoryProductsLimit, $model->countCategoryProducts))
@php($isPrev = array_shift($pages))
@php($isNext = array_pop($pages))
@if($model->countCategoryProducts >= $model->categoryProductsLimit)
    <div class="block-inline pagination-wrap text-center">
        <ul class="pagination-1">

            {{--PREV PAGE--}}
            @if($isPrev)
                <li class="prv">
                    <a href="{{ url_category_filters_per_page($model->currentCategory->slug, $model->filtersParam . ($model->sort == 'default' ? '' : '/' . $model->sort), $model->page - 1, $model->language) }}"
                       class="disabled">
                        <i class="fa fa-long-arrow-left"></i>
                    </a>
                </li>
            @else
                <li class="prv">
                    <a>
                        <i class="fa fa-long-arrow-left"></i>
                    </a>
                </li>
            @endif

            {{--MAIN LINKS--}}
            @foreach($pages as $page)
                <li>
                    @if($page == '...')
                        <a>
                            {{ $page }}
                        </a>
                    @else
                        @if($page == $model->page)
                            <a class="{{ $page == $model->page ? 'active' : '' }}">
                                {{ $page }}
                            </a>
                        @else
                            <a href="{{ url_category_filters_per_page($model->currentCategory->slug, $model->filtersParam . ($model->sort == 'default' ? '' : '/' . $model->sort), $page, $model->language) }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endif

                </li>
            @endforeach

            {{--NEXT PAGE--}}
            @if($isNext)
                <li class="nxt">
                    <a href="{{ url_category_filters_per_page($model->currentCategory->slug, $model->filtersParam . ($model->sort == 'default' ? '' : '/' . $model->sort), $model->page + 1, $model->language) }}">
                        <i class="fa fa-long-arrow-right"></i>
                    </a>
                </li>
            @else
                <li class="nxt">
                    <a>
                        <i class="fa fa-long-arrow-right"></i>
                    </a>
                </li>
            @endif

        </ul>
    </div>
@endif