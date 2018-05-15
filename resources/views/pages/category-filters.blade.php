@extends('layout')

@section('content')
    <article class="margin-after-header">
        @if($model->categoryProducts->count() > 0)

            {{--CATEGORY PRODUCT PREVIEW--}}
            <div id="category-product-preview">
                <section class="modal fade  popups-wrap popups-light" id="prod-preview-test"
                         tabindex="-1"
                         role="dialog"
                         aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <button aria-label="Close"
                                    data-dismiss="modal"
                                    class="close close-btn popup-cls"
                                    type="button">
                                <i class="fa-times fa"></i>
                            </button>
                            <div class="block-inline  product-modal">
                                <!-- Single Products Slider Starts -->
                                <div class="col-md-5 col-sm-12 single-prod-slider sync-sliedr">
                                    <div class="owl-carousel sync1 pb-25 product-preview-images-big">
                                        <div class="item" v-for="image in categoryProductPreview.product.images">
                                            <img v-bind:src="image.big" v-bind:alt="categoryProductPreview.product.name">

                                            <div v-if="categoryProductPreview.product.promotions != null && categoryProductPreview.product.promotions.length > 0 && categoryProductPreview.product.promotions[0].priority == 1"
                                                 class="prod-tag-1 font-2">
                                                {{--<span> -@{{ categoryProductPreview.product.price[0].discount }}% </span>--}}
                                                <span> SALE </span>
                                            </div>
                                            <div v-if="categoryProductPreview.product.promotions != null && categoryProductPreview.product.promotions.length > 0 && categoryProductPreview.product.promotions[0].priority == 2"
                                                 class="prod-tag-1 font-2 prod-tag-green">
                                                <span> NEW </span>
                                            </div>
                                            <div v-if="categoryProductPreview.product.promotions != null && categoryProductPreview.product.promotions.length > 0 && categoryProductPreview.product.promotions[0].priority == 3"
                                                 class="prod-tag-1 font-2 prod-tag-violet">
                                                <span> TOP </span>
                                            </div>

                                            <a v-bind:href="image.original"
                                               v-bind:rel="categoryProductPreview.rel"
                                               v-bind:title="categoryProductPreview.product.name"
                                               class="caption-link meta-icon">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="owl-carousel single-prod-thumb sync2 nav-2 product-preview-images-small">
                                        <div class="item" v-for="image in categoryProductPreview.product.images">
                                            <img v-bind:src="image.small" v-bind:alt="categoryProductPreview.product.name">
                                        <span class="transparent">
                                            <img src="/img/template/icons/plus.png" alt="view">
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Products Slider Ends -->
                                <div class="ptb-40 clearfix visible-sm visible-xs"></div>
                                <!-- Products Description Starts -->
                                <div class="col-md-7 col-sm-12">
                                    <div class="prod-details">
                                        <div class="prod-title">
                                            <a :href="'/product/' + categoryProductPreview.product.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'">
                                                @{{ categoryProductPreview.product.name }}
                                            </a>
                                        </div>
                                        <div class="block-inline">
                                            <div class="rating pull-right">
                                                <span v-for="i in 5" v-if="i <= categoryProductPreview.product.rating" class="star active"></span>
                                                <span v-else class="star"></span>
                                            </div>
                                            <div class="prod-price font-2 pull-left fsz-16">
                                                <ins>@{{ categoryProductPreview.product.price[0].price }} грн</ins>

                                                <del v-if="categoryProductPreview.product.promotions != null && categoryProductPreview.product.promotions.length > 0 && categoryProductPreview.product.promotions[0].priority == 3">
                                                    @{{ categoryProductPreview.product.price[0].old_price }} грн
                                                </del>

                                            </div>
                                        </div>
                                        <div class="discriptions pt-20">
                                            <ul>
                                                <li>{{ trans('product.stock') }}:
                                                <span v-cloak v-for="productSize in categoryProductPreview.product.product_sizes"
                                                      v-if="productSize.size_id == categoryProductPreview.currentSizeId">
                                                    <span v-if="productSize.stocks[0].stock > 0" class="product-in-stock">
                                                        {{ trans('product.product_in_stock') }}
                                                    </span>
                                                    <span v-else class="product-not-in-stock">
                                                        {{ trans('product.product_not_in_stock') }}
                                                    </span>
                                                </span>
                                                </li>
                                                <li v-for="property in categoryProductPreview.product.properties" v-if="property.slug != 'razmer'">
                                                    @{{ property.property_name }}: @{{ property.property_value }}
                                                </li>
                                                <li>Артикул: @{{ categoryProductPreview.product.vendor_code }}</li>
                                            </ul>
                                        </div>
                                        <div class="prod-attributes">
                                            <ul class="choose-clr list-inline border-hover">
                                                <div class="prod-color_title">
                                                    {{ trans('email.color') }} : <span v-cloak>@{{ categoryProductPreview.product.color.name }}</span>
                                                </div>
                                                <li v-for="relatedProduct in categoryProductPreview.product.product_group.products">
                                                    <a v-if="relatedProduct.color.id === categoryProductPreview.product.color.id"
                                                       class="active ttip"
                                                       v-bind:title="relatedProduct.color.name"
                                                       :style="{'background-color': '' + relatedProduct.color.html_code + ''}"
                                                       v-bind:href="'/product/' + relatedProduct.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'"></a>
                                                    <a class="ttip"
                                                       v-bind:title="relatedProduct.color.name"
                                                       v-else :style="{'background-color': '' + relatedProduct.color.html_code + ''}"
                                                       v-bind:href="'/product/' + relatedProduct.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'"></a>
                                                </li>
                                            </ul>
                                            <ul class="choose-size list-inline border-hover">
                                                <div class="prod-size_title">
                                                    {{ trans('email.size') }} :
                                                    <span v-for="size in categoryProductPreview.product.sizes" v-if="size.id == categoryProductPreview.currentSizeId" v-cloak>
                                                        @{{ size.name }}
                                                    </span>
                                                </div>
                                                <li v-for="(size, index) in categoryProductPreview.product.sizes">
                                                    <a v-on:click.prevent="changeCurrentSizeId(size.id)"
                                                        :class="{active : categoryProductPreview.currentSizeId == size.id}"
                                                        href="#">
                                                        @{{ size.name }}
                                                    </a>
                                                </li>
                                            </ul>
                                            <ul class="prod-btns prod-meta">
                                                <li>
                                                    <div class="quantity">
                                                        <button class="btn minus" v-on:click="decrement()">-</button>
                                                        <input type="number"
                                                               name="product-preview-quantity"
                                                               v-model.number="categoryProductPreview.count"
                                                               v-on:change="toInteger(categoryProductPreview.count)"
                                                               class="form-control qty"
                                                               title="{{ trans('cart.qty') }}">
                                                        <button class="btn plus" v-on:click="increment()">+</button>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a class="theme-btn btn-black small-btn"
                                                       v-on:click.prevent="addToCart(categoryProductPreview.product.id, categoryProductPreview.currentSizeId, categoryProductPreview.count)"
                                                       href="#">
                                                        <span v-cloak v-if=" ! categoryProductPreview.inStock">
                                                            {{ trans('layout.notify') }}
                                                        </span>
                                                        <span v-cloak
                                                            v-else-if="!findWhere(cartItems, {'productId': categoryProductPreview.product.id, 'sizeId': categoryProductPreview.currentSizeId})">
                                                            {{ trans('layout.add_to_cart') }}
                                                        </span>
                                                        <span v-cloak v-else>
                                                            {{ trans('layout.in_cart') }}
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    @if(auth()->check())
                                                        <a v-cloak
                                                           v-if="!findWhere(wishListItems, {'productId': categoryProductPreview.product.id, 'sizeId': categoryProductPreview.currentSizeId})"
                                                           class="fa fa-heart meta-icon"
                                                           v-on:click.prevent="addToWishList(categoryProductPreview.product.id, categoryProductPreview.currentSizeId, wishList.id)"
                                                           href="#"></a>
                                                        <a v-cloak v-else
                                                           class="fa fa-check meta-icon meta-icon-in-wish"
                                                           href="{{ url_wish_list($model->language) }}"></a>
                                                    @else
                                                        <a class="fa fa-heart meta-icon"
                                                           data-toggle="modal"
                                                           data-target="#login-popup"
                                                           href="#">
                                                        </a>
                                                    @endif
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Products Description Ends -->
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!--Breadcrumb Section Start-->
            <section class="breadcrumb-bg">
                <div class="theme-container container ">
                    <div class="site-breadcumb">

                        <h1 class="section-title fsz-36">
                            {{ $model->currentCategory->name }}
                        </h1>
                    <span class="category-prod_count fsz-36">
                            {{ $model->countCategoryProducts }}
                        </span>
                    </div>

                </div>
            </section>
            <!--Breadcrumb Section End-->

            <!-- Page Starts-->
            <div class="container theme-container ptb-70 category-product-container">
                <div class="row">

                    <!-- Sidebar Starts -->
                    <aside class="col-md-3 col-sm-4 sidebar" id="sidebar-selected-filters">
                        <button class="dropdown-div-btn show-filters-btn theme-btn btn-black">
                            {{ trans('layout.show_filters_btn') }}
                        </button>
                        <div class="widget-wrap">

                            @foreach($model->filters as $filterName => $filterValues)
                                <div class="dropdown-div-btn">
                                    <h2 class="widget-title"><span class="filter-name">{{ $filterName }}</span><span class="plus-icon"> - </span> </h2>
                                </div>
                                <div class="dropdown-div-content">
                                    <div class="widget-box">
                                        <ul>
                                            @php($valueCounter = 0)
                                            @foreach($filterValues as $filterValue)
                                                <li>
                                                    <label class="checkbox-inline"
                                                           v-on:click.prevent="setCheck('{{ $filterName }}', '{{ $valueCounter }}')">
                                                        <input type="checkbox"
                                                               v-model="filters['{{ $filterName }}']['{{ $valueCounter }}'].isChecked">
                                                        <span class="square-box"></span>
                                                    </label>
                                                    <a class="checkbox-inline filter-value-link"
                                                       href="{{ url_category_filters($model->currentCategory->slug, $model->filtersParam, $filterValue->filter_name_slug, $filterValue->filter_value_slug, $model->language)  }}">
                                                    <span class="" :class="{checkactive: filters['{{ $filterName }}']['{{ $valueCounter }}'].isChecked}">
                                                        {{ $filterValue->filter_value_title }}
                                                    </span>
                                                    </a>
                                                <span class="filter-count-to-right"
                                                      :class="{checkactive: filters['{{ $filterName }}']['{{ $valueCounter }}'].isChecked}">
                                                    {{ $filterValue->filter_products_count }}
                                                </span>
                                                </li>
                                                @php($valueCounter++)
                                            @endforeach
                                            <transition name="slide">
                                                <a v-cloak class="theme-btn btn-black apply-filters-btn"
                                                   v-if="isCheckSelected('{{$filterName}}')"
                                                   v-bind:href="filterUrl">
                                                    {{ trans('layout.submit') }}
                                                </a>
                                            </transition>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach

                            <div class="dropdown-div-btn">
                                <h2 class="widget-title"> {{ trans('layout.price') }}  <span class="plus-icon"> - </span> </h2>
                            </div>
                            <div class="dropdown-div-content">
                                <div class="widget-box">

                                    <div class="widget-content pb-35">
                                        <div id="price-range"></div>
                                        <div class="block-inline range-wrap">
                                            <span id="price-min"></span> - <span id="price-max"></span>
                                        </div>
                                    </div>
                                    <transition name="slide">
                                        <a v-cloak class="theme-btn btn-black apply-filters-btn"
                                           v-if="priceMin && priceMax && (oldPriceMin != priceMin || oldPriceMax != priceMax)"
                                           v-bind:href="filterUrl">
                                            {{ trans('layout.submit') }}
                                        </a>
                                    </transition>
                                </div>
                            </div>

                            <a v-cloak class="theme-btn btn-black apply-filters-btn" style="margin-top: 30px"
                               href="{{ url_category($model->currentCategory->slug, $model->language) }}">
                                {{ trans('layout.throw_filters') }}
                            </a>
                        </div>
                    </aside>
                    <!-- Sidebar Ends -->

                    {{--<div class="visible-xs pt-70"></div>--}}

                    <!-- Product Details Starts-->
                    <aside class="col-md-9 col-sm-8">
                        <div class="sorter-bar block-inline">
                            <div class="col-md-6 col-sm-7 no-padding sorter-date">


                                <div class="site-breadcumb white-clr">
                                    <ol class="breadcrumb breadcrumb-menubar">
                                        <li>
                                            <a href="{{ url_home($model->language) }}">
                                                {{ trans('profile.home') }}
                                            </a>
                                            {{ $model->currentCategory->name }}
                                        </li>
                                    </ol>
                                </div>


                            </div>

                            <div class="col-md-6 col-sm-5 show-result no-padding">
                                    <label> {{ trans('layout.sort') }} </label>
                                    <div class="search-selectpicker selectpicker-wrapper">
                                        @php($selectedSortItem = 'default')
                                        @foreach($model->sortItems->items as $sortItem)
                                            @if ($sortItem->isSelected)
                                                @php($selectedSortItem = $sortItem->name)
                                            @endif
                                        @endforeach
                                        <select id="sort-select" class="selectpicker input-price"
                                                data-width="100%" data-toggle="tooltip"
                                                title="{{ $model->sort == 'default' ? trans('layout.default') : $selectedSortItem }}">
                                            @foreach($model->sortItems->items as $sortItem)
                                                <option data-url="{{ $sortItem->url_filters }}" {{$sortItem->isSelected ? 'disabled' : ''}}>
                                                    {{ $sortItem->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                        </div>

                        <div class="sorter-bar selected-filters-bar">

                            @php($filterCounter = 0)
                            @foreach($model->filters as $filterName => $filterValue)
                                @foreach($filterValue as $filter)
                                    @if($filter->isChecked)
                                        <div class="selected-filter-container">
                                            <div class="filter-span-container">
                                                <b>{{ $filter->filter_name_title }}:</b>
                                                <span>{{ $filter->filter_value_title }}</span>
                                            </div>
                                            <a href="{{ url_category_filters_without_param($model->currentCategory->slug, $model->filtersParam, $filter->filter_name_slug, $filter->filter_value_slug, null, null, $model->language) }}" class="filter-close">&times;</a>
                                        </div>
                                        @php($filterCounter++)
                                    @endif
                                @endforeach
                            @endforeach

                            @if($model->priceMin && $model->priceMax)
                                <div class="selected-filter-container">
                                    <div class="filter-span-container">
                                         <b>{{ trans('layout.price') }}:</b>
                                        <span>{{ $model->priceMin }} - {{ $model->priceMax }}</span>
                                    </div>
                                    <a href="{{ url_category_filters_without_param($model->currentCategory->slug, $model->filtersParam, null, null, $model->priceMin, $model->priceMax, $model->language) }}" class="filter-close">&times;</a>
                                </div>
                                @php($filterCounter++)
                            @endif

                            @if($filterCounter > 1)
                                <div class="selected-filter-container">
                                    <div class="filter-span-container">
                                        <span>{{ trans('layout.throw_filters') }}</span>
                                    </div>
                                    <a href="{{ url_category($model->currentCategory->slug, $model->language) }}"
                                       class="filter-close"><i class="fa fa-refresh"></i></a>
                                </div>
                            @endif
                        </div>

                        <div class="tab-content">

                            <!-- Product Grid View Starts -->
                            <div id="grid-view" class="tab-pane fade active in" role="tabpanel">
                                <div class="row">

                                    @php($counter = 0)
                                    @foreach($model->categoryProducts as $categoryProduct)

                                        @php($relatedProducts = $categoryProduct->product_group->products)

                                        <div class="col-lg-4 col-sm-12 prod-wrap-cont">
                                            <div class="prod-wrap-absolute clearfix">
                                                <div class="product_item prod-wrap">
                                                    <div class="product_img">
                                                        <div class="prod-img">
                                                            <a class="img-hover"
                                                               href="{{ url_product($categoryProduct->slug, $model->language) }}">
                                                                <div class="photo-cat_fit">
                                                                    <img alt="{{ $categoryProduct->name }}"
                                                                         src="{{ $categoryProduct->images[0]->medium }}">
                                                                </div>

                                                            </a>

                                                            @if($categoryProduct->promotions != null && $categoryProduct->promotions->count() > 0)
                                                                @if($categoryProduct->promotions[0]->priority == 3)
                                                                    <div class="prod-tag-1 font-2">
                                                                         {{--<span> -{{ $categoryProduct->price[0]->discount }}% </span>  --}}
                                                                        <span> SALE </span>
                                                                    </div>
                                                                @endif
                                                                @if($categoryProduct->promotions[0]->priority == 1)
                                                                    <div class="prod-tag-1 font-2 prod-tag-green">
                                                                        <span> NEW </span>
                                                                    </div>
                                                                @endif
                                                                @if($categoryProduct->promotions[0]->priority == 2)
                                                                    <div class="prod-tag-1 font-2 prod-tag-violet">
                                                                        <span> TOP </span>
                                                                    </div>
                                                                @endif
                                                            @endif

                                                            <a class="caption-link meta-icon"
                                                               href="#"
                                                               v-on:click.prevent="changeCategoryProductPreview({{$counter}})">
                                                                <span class="fa fa-eye"></span> {{ trans('product.fast_see') }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="product_info">
                                                        <h2 class="prod-title">
                                                            <a href="{{ url_product($categoryProduct->slug, $model->language) }}">
                                                                {{ $categoryProduct->name }}
                                                            </a>
                                                        </h2>
                                                        <div class="block-inline">
                                                            <div class="prod-price font-2">
                                                                <ins>{{ $categoryProduct->price[0]->price }} грн</ins>

                                                                @if($categoryProduct->promotions != null && $categoryProduct->promotions->count() > 0)
                                                                    @if($categoryProduct->promotions[0]->priority == 3)
                                                                        <del>{{ $categoryProduct->price[0]->old_price }} грн</del>
                                                                    @endif
                                                                @endif

                                                            </div>
                                                            <div class="rating">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    @if($categoryProduct->rating != null)
                                                                        @if($i <= $categoryProduct->rating)
                                                                            <span class="star active"></span>
                                                                        @else
                                                                            <span class="star"></span>
                                                                        @endif
                                                                    @else
                                                                        <span class="star"></span>
                                                                    @endif
                                                                @endfor
                                                            </div>

                                                        </div>
                                                        <div class="block-inline">
                                                            <ul class="prod-meta">
                                                                <li>
                                                                    <a class="theme-btn btn-black"
                                                                       v-on:click.prevent="addToCart({{$categoryProduct->id}}, categoryProducts[{{$counter}}].currentSizeId, 1, {{$counter}})"
                                                                       href="#">
                                                                        <span v-cloak v-if=" ! categoryProducts[{{$counter}}].inStock">
                                                                            {{ trans('layout.notify') }}
                                                                        </span>
                                                                        <span v-cloak
                                                                            v-else-if="!findWhere(cartItems, {'productId': {{$categoryProduct->id}}, 'sizeId': categoryProducts[{{$counter}}].currentSizeId})">
                                                                            {{ trans('layout.add_to_cart') }}
                                                                        </span>
                                                                        <span v-cloak v-else>
                                                                            {{ trans('layout.in_cart') }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    @if(auth()->check())
                                                                        <a v-cloak
                                                                           v-if="!findWhere(wishListItems, {'productId': {{$categoryProduct->id}}, 'sizeId': categoryProducts[{{$counter}}].currentSizeId})"
                                                                           class="fa fa-heart meta-icon"
                                                                           v-on:click.prevent="addToWishList({{$categoryProduct->id}}, categoryProducts[{{$counter}}].currentSizeId, wishList.id)"
                                                                           href="#"></a>
                                                                        <a v-cloak v-else
                                                                           class="fa fa-check meta-icon meta-icon-in-wish"
                                                                           href="{{ url_wish_list($model->language) }}"></a>
                                                                    @else
                                                                        <a class="fa fa-heart meta-icon"
                                                                           data-toggle="modal"
                                                                           data-target="#login-popup"
                                                                           href="#">
                                                                        </a>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="testProd">
                                                            <div class="prod-attributes absolute-pror-attr">
                                                                <ul class="choose-clr list-inline border-hover">
                                                                    @foreach($relatedProducts as $relatedProduct)
                                                                        <li>
                                                                            @if($categoryProduct->color->id == $relatedProduct->color->id)
                                                                                <a class="active ttip" href="{{ url_product($relatedProduct->slug, $model->language) }}"
                                                                                   title="{{  $relatedProduct->color->name }}"
                                                                                   style="background-color: {{ $relatedProduct->color->html_code }}"></a>
                                                                            @else
                                                                                <a href="{{ url_product($relatedProduct->slug, $model->language) }}"
                                                                                   class="ttip"
                                                                                   title="{{  $relatedProduct->color->name }}"
                                                                                   style="background-color: {{ $relatedProduct->color->html_code }}"></a>
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                                <ul class="choose-size list-inline border-hover">
                                                                    @php($counterSize = 0)
                                                                    @foreach($categoryProduct->sizes as $size)
                                                                        <li>
                                                                            @if($counterSize == 0)
                                                                                <a v-on:click.prevent="changeCurrentSizeId({{$counter}}, {{$size->id}})"
                                                                                   :class="{active : categoryProducts[{{$counter}}].currentSizeId == {{$size->id}}}"
                                                                                   href="#">
                                                                                    {{ $size->name }}
                                                                                </a>
                                                                            @else
                                                                                <a href="#"
                                                                                   v-on:click.prevent="changeCurrentSizeId({{$counter}}, {{$size->id}})"
                                                                                   :class="{active : categoryProducts[{{$counter}}].currentSizeId == {{$size->id}}}">
                                                                                    {{ $size->name }}
                                                                                </a>
                                                                            @endif
                                                                        </li>
                                                                        @php($counterSize++)
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @php($counter++)
                                @endforeach
                                <!-- Pagination Starts -->
                                @include('partial.category-filters-page.pagination')
                                <!-- Pagination Ends -->
                                </div>
                            </div>
                            <!-- Product Grid View Ends -->
                        </div>
                    </aside>
                    <!-- Product Details Ends -->

                </div>
            </div>
            <!-- / Page Ends -->
        @else
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="no_prod-filters">
                            <h1 style="text-align: center">{{ trans('layout.no_products') }}</h1>
                            <div class="no_prod-filters-links">
                                <a href="{{ redirect()->getUrlGenerator()->previous() }}">
                                    <i class="fa fa-chevron-left" aria-hidden="true"></i> Назад
                                </a>
                                <a href="{{ url_home($model->language) }}">
                                    <i class="fa fa-home" aria-hidden="true"></i> {{ trans('layout.go_home') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </article>
@endsection