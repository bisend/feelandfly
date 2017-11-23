@extends('layout')

@section('content')
    <article>

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
                                        <img v-bind:src="image.big">
                                        <a v-bind:href="image.original"
                                           v-bind:rel="categoryProductPreview.rel"
                                           v-bind:title="categoryProductPreview.product.name"
                                           class="caption-link meta-icon">
                                            <i class="fa fa-arrows-alt"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="owl-carousel single-prod-thumb sync2 nav-2 product-preview-images-small">
                                    <div class="item" v-for="image in categoryProductPreview.product.images">
                                        <img v-bind:src="image.small">
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
                                    <div class="prod-title">@{{ categoryProductPreview.product.name }}</div>
                                    <div class="block-inline">
                                        <div class="rating pull-right">
                                            <span v-for="i in 5" v-if="i <= categoryProductPreview.product.rating" class="star active"></span>
                                            <span v-else class="star"></span>
                                        </div>
                                        <div class="prod-price font-2 pull-left fsz-16">
                                            <ins>@{{ categoryProductPreview.product.price[0].price }} грн</ins>
                                        </div>
                                    </div>
                                    <div class="discriptions pt-20">
                                        <ul>
                                            <li>Наличие: </li>
                                            <li>Материал: Полиэстер с водоотталкивающей и полиуретановой
                                                пропиткой для терморегуляции, удерживает влагу 1000 мм/вод.ст;</li>
                                            <li>Полиэстеровая 210 г/м2 сверхлегкая фирменная принтованная подкладка;</li>
                                            <li>Металлические нержавеющие молнии;</li>
                                            <li>Два боковых, один внутренний, один карман на молнии на плече;</li>
                                            <li>Сверху и снизу расположена трикотажная резинка с компонентом эластана,
                                                что позволяет резинке не терять с временем форму и не закатываться;</li>
                                            <li>На бомбере расположены три вышитых патча;</li>
                                            <li>Весенний / Летний сезон.</li>
                                            <li>Артикул: @{{ categoryProductPreview.product.vendor_code }}</li>
                                        </ul>
                                    </div>
                                    <div class="prod-attributes">
                                        <ul class="choose-clr list-inline border-hover">
                                            <li v-for="relatedProduct in categoryProductPreview.product.product_group.products">
                                                {{--<a v-bind:href="related_product.color.slug" class="black-bg"></a>--}}
                                                <a v-if="relatedProduct.color.id === categoryProductPreview.product.color.id"
                                                   class="active"
                                                   :style="{'background-color': '' + relatedProduct.color.html_code + ''}"
                                                   v-bind:href="'/product/' + relatedProduct.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'"></a>
                                                <a v-else :style="{'background-color': '' + relatedProduct.color.html_code + ''}"
                                                   v-bind:href="'/product/' + relatedProduct.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'"></a>
                                            </li>
                                        </ul>
                                        <ul class="choose-size list-inline border-hover">
                                            <li v-for="(size, index) in categoryProductPreview.product.sizes">
                                                <a
                                                   v-on:click="changeCurrentSizeId(size.id)"
                                                   :class="{active : categoryProductPreview.currentSizeId == size.id}"
                                                   href="javascript:void(0);">
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
                                                           title="Количество">
                                                    <button class="btn plus" v-on:click="increment()">+</button>
                                                </div>
                                            </li>
                                            <li>
                                                <a class="theme-btn btn-black small-btn"
                                                   v-on:click="addToCart(categoryProductPreview.product.id, categoryProductPreview.currentSizeId, categoryProductPreview.count)"
                                                   href="javascript:void(0);">
                                                    <span v-cloak
                                                          v-if="!findWhere(cartItems, {'productId': categoryProductPreview.product.id, 'sizeId': categoryProductPreview.currentSizeId})">
                                                        Добавить в корзину
                                                    </span>
                                                    <span v-cloak v-else>
                                                        В корзине
                                                    </span>
                                                </a>
                                            </li>
                                            <li> <a class="fa fa-heart meta-icon" href="#"></a> </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Products Description Ends -->
                        </div>
                    </div>
                </div>
            </section>
            {{--<img v-bind:src="path" alt="">--}}
        </div>





        <!--Breadcrumb Section Start-->
        <section class="breadcrumb-bg">
            <div class="theme-container container ">
                <div class="site-breadcumb white-clr">
                    <h2 class="section-title wht fsz-36">
                        {{ $model->currentCategory->name }} {{ $model->countCategoryProducts }}
                    </h2>
                </div>
            </div>
        </section>
        <!--Breadcrumb Section End-->

        <!-- Page Starts-->
        <div class="container theme-container ptb-70">
            <div class="row">

                <!-- Sidebar Starts -->
                <aside class="col-md-3 col-sm-4 sidebar" id="sidebar-filters">
                    <div class="widget-wrap">

                        {{--<div class="dropdown-div-btn">--}}
                            {{--<h2 class="widget-title"> Тип  <span class="plus-icon"> - </span> </h2>--}}
                        {{--</div>--}}
                        {{--<div class="dropdown-div-content">--}}
                            {{--<div class="widget-box">--}}
                                {{--<ul>--}}
                                    {{--TODO FILTERS......--}}
                                    {{--@foreach($model->categories as $category)--}}
                                        {{--<li>--}}
                                            {{--<label class="checkbox-inline">--}}
                                                {{--<input type="checkbox" value="">--}}
                                                {{--<span class="square-box"></span>--}}
                                            {{--<span>--}}
                                                {{--{{ $category->name }}--}}
                                            {{--</span>--}}
                                            {{--</label>--}}
                                        {{--</li>--}}
                                    {{--@endforeach--}}
                                    {{--<li>--}}
                                        {{--<label class="checkbox-inline">--}}
                                            {{--<input type="checkbox" value="" checked="checked">--}}
                                            {{--<span class="square-box"></span>--}}
                                            {{--<span class="checkactive">--}}
                                                {{--Верхняя одежда--}}
                                            {{--</span>--}}
                                        {{--</label>--}}
                                    {{--</li>--}}
                                    {{--<li><label class="checkbox-inline"><input type="checkbox" value=""> <span class="square-box"></span> <span>Свитшоты & Толстовки</span> </label> </li>--}}
                                    {{--<li><label class="checkbox-inline"><input type="checkbox" value=""> <span class="square-box"></span> <span> Штаны</span> </label> </li>--}}
                                    {{--<li><label class="checkbox-inline"><input type="checkbox" value=""> <span class="square-box"></span> <span>Шорты</span> </label> </li>--}}
                                    {{--<li><label class="checkbox-inline"><input type="checkbox" value=""> <span class="square-box"></span> <span> Аксессуары</span> </label> </li>--}}

                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        @foreach($model->filters as $filterName => $filterValues)
                            <div class="dropdown-div-btn">
                                <h2 class="widget-title">{{ $filterName }}<span class="plus-icon"> - </span> </h2>
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
                                                {{--<a class="checkbox-inline filter-value-link" href="{{ url_current($model->language) }}/{{ $filterValue->filter_name_slug }}={{ $filterValue->filter_value_slug }}">--}}
                                                <a class="checkbox-inline filter-value-link"
                                                   href="{{ url_category_filters($model->currentCategory->slug, null, $filterValue->filter_name_slug, $filterValue->filter_value_slug, $model->language)  }}">
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
                                                Применить
                                            </a>
                                        </transition>
                                    </ul>
                                </div>
                            </div>
                        @endforeach

                        {{--<div class="dropdown-div-btn">--}}
                            {{--<h2 class="widget-title"> Размер  <span class="plus-icon"> - </span> </h2>--}}
                        {{--</div>--}}
                        {{--<div class="dropdown-div-content">--}}
                            {{--<div class="widget-box">--}}
                                {{--<ul>--}}
                                    {{--<li><label class="checkbox-inline"><input type="checkbox" value=""> <span class="square-box"></span> <span>  XXS</span> </label> </li>--}}
                                    {{--<li><label class="checkbox-inline"><input type="checkbox" value=""> <span class="square-box"></span> <span> XS</span> </label> </li>--}}
                                    {{--<li><label class="checkbox-inline"><input type="checkbox" value=""> <span class="square-box"></span> <span> S</span> </label> </li>--}}
                                    {{--<li><label class="checkbox-inline"><input type="checkbox" value=""> <span class="square-box"></span> <span> M</span> </label> </li>--}}
                                    {{--<li><label class="checkbox-inline"><input type="checkbox" value=""> <span class="square-box"></span> <span> L</span> </label> </li>--}}
                                    {{--<li><label class="checkbox-inline"><input type="checkbox" value=""> <span class="square-box"></span> <span> XL</span> </label> </li>--}}
                                    {{--<li><label class="checkbox-inline"><input type="checkbox" value=""> <span class="square-box"></span> <span> XXL</span> </label> </li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="dropdown-div-btn">
                            <h2 class="widget-title"> Цена  <span class="plus-icon"> - </span> </h2>
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
                                       v-if="initialPriceMin != priceMin || initialPriceMax != priceMax"
                                       v-bind:href="filterUrl">
                                        Применить
                                    </a>
                                </transition>
                            </div>
                        </div>

                        {{--<div class="dropdown-div-btn">--}}
                            {{--<h2 class="widget-title"> Цвет  <span class="plus-icon"> - </span> </h2>--}}
                        {{--</div>--}}
                        {{--<div class="dropdown-div-content">--}}
                            {{--<div class="widget-box">--}}
                                {{--<ul class="choose-clr list-inline border-hover">--}}
                                    {{--<li> <a class="black-bg" href="#"></a> </li>--}}
                                    {{--<li> <a class="gray-bg" href="#"></a> </li>--}}
                                    {{--<li> <a class="red-bg" href="#"></a> </li>--}}
                                    {{--<li> <a class="yellow-bg active" href="#"></a> </li>--}}
                                    {{--<li> <a class="green1-bg" href="#"></a> </li>--}}
                                    {{--<li> <a class="blue1-bg" href="#"></a> </li>--}}
                                    {{--<li> <a class="blue2-bg" href="#"></a> </li>--}}
                                    {{--<li> <a class="violate-bg" href="#"></a> </li>--}}
                                    {{--<li> <a class="pink-bg" href="#"></a> </li>--}}
                                    {{--<li> <a class="green2-bg" href="#"></a> </li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </aside>
                <!-- Sidebar Ends -->

                <div class="visible-xs pt-70"></div>

                <!-- Product Details Starts-->
                <aside class="col-md-9 col-sm-8">
                    <div class="sorter-bar block-inline">
                        <div class="col-md-6 col-sm-7 no-padding sorter-date">


                            <div class="site-breadcumb white-clr">
                                <ol class="breadcrumb breadcrumb-menubar">
                                    <li>
                                        <a href="{{ url_home($model->language) }}">
                                            Главная
                                        </a>
                                        {{ $model->currentCategory->name }}
                                    </li>
                                </ol>
                            </div>


                        </div>

                        <div class="col-md-6 col-sm-5 show-result no-padding">
                            {{--<form action="#" class="form-sorter">--}}
                                <label>{{ trans('layout.sort') }}</label>
                                <div class="search-selectpicker selectpicker-wrapper">
                                    @php($selectedSortItem = 'default')
                                        @foreach($model->sortItems->items as $sortItem)
                                            @if ($sortItem->isSelected)
                                                @php($selectedSortItem = $sortItem->name)
                                            @endif
                                        @endforeach
                                    <select id="sort-select" class="selectpicker input-price"
                                            data-width="100%" data-toggle="tooltip"
                                            title="{{ $model->sort == 'default' ? trans('layout.how_to_sort') : $selectedSortItem }}">
                                        @foreach($model->sortItems->items as $sortItem)
                                            <option data-url="{{ $sortItem->url }}" {{$sortItem->isSelected ? 'disabled' : ''}}>
                                                {{ $sortItem->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            {{--</form>--}}
                        </div>
                    </div>

                    <div class="tab-content">

                        <!-- Product Grid View Starts -->
                        <div id="grid-view" class="tab-pane fade active in" role="tabpanel">
                            <div class="row">

                                {{--@foreach($model->categoryProducts as $categoryProduct)--}}
                                    {{--<div class="col-lg-4 col-sm-6 prod-wrap-cont">--}}

                                        {{--<div class="product_item prod-wrap">--}}
                                            {{--<div class="product_img">--}}
                                                {{--<div class="prod-img">--}}
                                                    {{--<a class="img-hover"--}}
                                                       {{--href="{{ url_product($categoryProduct->slug, $model->language) }}">--}}
                                                        {{--<img alt="product"--}}
                                                             {{--src="{{ $categoryProduct->images[0]->medium }}"></a>--}}
                                                    {{--<a class="caption-link meta-icon"--}}
                                                       {{--data-toggle="modal"--}}
                                                       {{--data-product-preview-show="{{ $categoryProduct->id }}"--}}
                                                       {{--href="javascript:void(0);"--}}
                                                       {{--href="#prod-preview-{{ $categoryProduct->id }}"--}}
                                                       {{-->--}}
                                                        {{--<span class="fa fa-eye"></span>--}}
                                                    {{--</a>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="product_info">--}}
                                                {{--<h2 class="prod-title">--}}
                                                    {{--<a href="{{ url_product($categoryProduct->slug, $model->language) }}">--}}
                                                        {{--{{ $categoryProduct->name }}--}}
                                                    {{--</a>--}}
                                                {{--</h2>--}}
                                                {{--<div class="block-inline">--}}
                                                    {{--<div class="prod-price font-2">--}}
                                                        {{--<ins>180.00 грн</ins> <del>360.00 грн</del>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="rating">--}}
                                                        {{--@for($i = 1; $i <= 5; $i++)--}}
                                                            {{--@if($categoryProduct->rating != null)--}}
                                                                {{--@if($i <= $categoryProduct->rating)--}}
                                                                    {{--<span class="star active"></span>--}}
                                                                {{--@else--}}
                                                                    {{--<span class="star"></span>--}}
                                                                {{--@endif--}}
                                                            {{--@else--}}
                                                                {{--<span class="star active"></span>--}}
                                                            {{--@endif--}}
                                                        {{--@endfor--}}
                                                    {{--</div>--}}

                                                {{--</div>--}}
                                                {{--<div class="block-inline">--}}
                                                    {{--<ul class="prod-meta">--}}
                                                        {{--<li>--}}
                                                            {{--<a class="theme-btn btn-black" href="javascript:void(0);">--}}
                                                                {{--Добавить в корзину--}}
                                                            {{--</a>--}}
                                                        {{--</li>--}}
                                                        {{--<li>--}}
                                                            {{--<a class="fa fa-heart meta-icon" href="javascript:void(0);"></a>--}}
                                                        {{--</li>--}}
                                                    {{--</ul>--}}
                                                {{--</div>--}}
                                                {{--<div class="testProd">--}}
                                                    {{--<div class="prod-attributes absolute-pror-attr">--}}
                                                        {{--<ul class="choose-clr list-inline border-hover">--}}
                                                            {{--<li> <a class="black-bg" href="#"></a> </li>--}}
                                                            {{--<li> <a class="gray-bg" href="#"></a> </li>--}}
                                                            {{--<li> <a class="red-bg" href="#"></a> </li>--}}
                                                            {{--<li> <a class="yellow-bg active" href="#"></a> </li>--}}
                                                            {{--<li> <a class="green1-bg" href="#"></a> </li>--}}
                                                        {{--</ul>--}}
                                                        {{--<ul class="choose-size list-inline border-hover">--}}
                                                            {{--<li> <a href="#"> S </a> </li>--}}
                                                            {{--<li> <a href="#" class="active"> M </a> </li>--}}

                                                        {{--</ul>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                    {{--</div>--}}
                                {{--@endforeach--}}
                                @php($counter = 0)
                                @foreach($model->categoryProducts as $categoryProduct)

                                    @php($relatedProducts = $categoryProduct->product_group->products)

                                    <div class="col-lg-4 col-sm-6 prod-wrap-cont">

                                        <div class="prod-wrap-absolute clearfix">
                                            <div class="product_item prod-wrap">
                                                <div class="product_img">
                                                    <div class="prod-img">
                                                        <a class="img-hover"
                                                           href="{{ url_product($categoryProduct->slug, $model->language) }}">
                                                            <img alt="product"
                                                                 src="{{ $categoryProduct->images[0]->medium }}"></a>
                                                        <a class="caption-link meta-icon"
                                                           {{--data-toggle="modal"--}}
                                                           {{--data-target="#prod-preview-test"--}}
                                                           href="javascript:void(0);"
                                                           v-on:click="changeCategoryProductPreview({{$counter}})">
                                                            <span class="fa fa-eye"></span>
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
                                                            <ins>{{ $categoryProduct->price[0]->price }} грн</ins> {{--<del>360.00 грн</del>--}}
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
                                                                    <span class="star active"></span>
                                                                @endif
                                                            @endfor
                                                        </div>

                                                    </div>
                                                    <div class="block-inline">
                                                        <ul class="prod-meta">
                                                            <li>
                                                                <a class="theme-btn btn-black"
                                                                   v-on:click="addToCart({{$categoryProduct->id}}, categoryProducts[{{$counter}}].currentSizeId, 1)"
                                                                   href="javascript:void(0);">
                                                                <span v-cloak
                                                                      v-if="!findWhere(cartItems, {'productId': {{$categoryProduct->id}}, 'sizeId': categoryProducts[{{$counter}}].currentSizeId})">
                                                                    Добавить в корзину
                                                                </span>
                                                                <span v-cloak v-else>
                                                                    В корзине
                                                                </span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="fa fa-heart meta-icon" href="javascript:void(0);"></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="testProd">
                                                        <div class="prod-attributes absolute-pror-attr">
                                                            <ul class="choose-clr list-inline border-hover">
                                                                @foreach($relatedProducts as $relatedProduct)
                                                                    <li>
                                                                        @if($categoryProduct->color->id == $relatedProduct->color->id)
                                                                            <a class="active" href="{{ url_product($relatedProduct->slug, $model->language) }}"
                                                                               style="background-color: {{ $relatedProduct->color->html_code }}"></a>
                                                                        @else
                                                                            <a href="{{ url_product($relatedProduct->slug, $model->language) }}"
                                                                               style="background-color: {{ $relatedProduct->color->html_code }}"></a>
                                                                        @endif
                                                                    </li>
                                                                @endforeach


                                                                {{--<li> <a class="black-bg" href="#"></a> </li>--}}
                                                                {{--<li> <a class="gray-bg" href="#"></a> </li>--}}
                                                                {{--<li> <a class="red-bg" href="#"></a> </li>--}}
                                                                {{--<li> <a class="yellow-bg active" href="#"></a> </li>--}}
                                                                {{--<li> <a class="green1-bg" href="#"></a> </li>--}}
                                                            </ul>
                                                            <ul class="choose-size list-inline border-hover">
                                                                @php($counterSize = 0)
                                                                @foreach($categoryProduct->sizes as $size)
                                                                    <li>
                                                                        @if($counterSize == 0)
                                                                            <a
                                                                                    v-on:click="changeCurrentSizeId({{$counter}}, {{$size->id}})"
                                                                                    :class="{active : categoryProducts[{{$counter}}].currentSizeId == {{$size->id}}}"
                                                                                    href="javascript:void(0);">
                                                                                {{ $size->name }}
                                                                            </a>
                                                                        @else
                                                                            <a href="javascript:void(0);"
                                                                               v-on:click="changeCurrentSizeId({{$counter}}, {{$size->id}})"
                                                                               :class="{active : categoryProducts[{{$counter}}].currentSizeId == {{$size->id}}}">
                                                                                {{ $size->name }}
                                                                            </a>
                                                                        @endif
                                                                    </li>
                                                                    @php($counterSize++)
                                                                @endforeach
                                                                {{--<li> <a href="#" class="active"> M </a> </li>--}}
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
                                @include('partial.category-page.pagination')
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
    </article>
@endsection

@push('js')
<script defer src="/template/js/main.js"></script>
<script defer src="/template/plugins/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
@endpush