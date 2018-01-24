@extends('layout')

@section('content')
    <article class="margin-after-header">


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

                                        <div v-if="categoryProductPreview.product.promotions != null && categoryProductPreview.product.promotions.length > 0 && categoryProductPreview.product.promotions[0].id == 1"
                                             class="prod-tag-1 font-2">
                                            <span> -@{{ categoryProductPreview.product.price[0].discount }}% </span>
                                        </div>
                                        <div v-if="categoryProductPreview.product.promotions != null && categoryProductPreview.product.promotions.length > 0 && categoryProductPreview.product.promotions[0].id == 2"
                                             class="prod-tag-1 font-2 prod-tag-green">
                                            <span> NEW </span>
                                        </div>
                                        <div v-if="categoryProductPreview.product.promotions != null && categoryProductPreview.product.promotions.length > 0 && categoryProductPreview.product.promotions[0].id == 3"
                                             class="prod-tag-1 font-2 prod-tag-violet">
                                            <span> TOP </span>
                                        </div>

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

                                            <del v-if="categoryProductPreview.product.promotions != null && categoryProductPreview.product.promotions.length > 0 && categoryProductPreview.product.promotions[0].id == 1">
                                                @{{ categoryProductPreview.product.price[0].old_price }} грн
                                            </del>

                                        </div>
                                    </div>
                                    <div class="discriptions pt-20">
                                        <ul>
                                            <li>{{ trans('product.stock') }}:
                                                <span v-cloak v-for="productSize in categoryProductPreview.product.product_sizes"
                                                      v-if="productSize.size_id == categoryProductPreview.currentSizeId">
                                                {{--{{ $model->product->product_sizes[0]->stocks[0]->stock }}--}}
                                                    @{{ productSize.stocks[0].stock }}
                                                </span>
                                            </li>
                                            {{--<li>Материал: Полиэстер с водоотталкивающей и полиуретановой--}}
                                                {{--пропиткой для терморегуляции, удерживает влагу 1000 мм/вод.ст;</li>--}}
                                            {{--<li>Полиэстеровая 210 г/м2 сверхлегкая фирменная принтованная подкладка;</li>--}}
                                            {{--<li>Металлические нержавеющие молнии;</li>--}}
                                            {{--<li>Два боковых, один внутренний, один карман на молнии на плече;</li>--}}
                                            {{--<li>Сверху и снизу расположена трикотажная резинка с компонентом эластана,--}}
                                                {{--что позволяет резинке не терять с временем форму и не закатываться;</li>--}}
                                            {{--<li>На бомбере расположены три вышитых патча;</li>--}}
                                            {{--<li>Весенний / Летний сезон.</li>--}}
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
                                                <a v-on:click="changeCurrentSizeId(size.id)"
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
                                                           title="{{ trans('profile.qty') }}">
                                                    <button class="btn plus" v-on:click="increment()">+</button>
                                                </div>
                                            </li>
                                            <li>
                                                <a class="theme-btn btn-black small-btn"
                                                   v-on:click="addToCart(categoryProductPreview.product.id, categoryProductPreview.currentSizeId, categoryProductPreview.count)"
                                                   href="javascript:void(0);">
                                                    <span v-cloak
                                                          v-if="!findWhere(cartItems, {'productId': categoryProductPreview.product.id, 'sizeId': categoryProductPreview.currentSizeId})">
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
                                                       v-on:click="addToWishList(categoryProductPreview.product.id, categoryProductPreview.currentSizeId, wishList.id)"
                                                       href="javascript:void(0);"></a>
                                                    <a v-cloak v-else
                                                       class="fa fa-check meta-icon meta-icon-in-wish"
                                                       href="{{ url_wish_list($model->language) }}"></a>
                                                @else
                                                    <a class="fa fa-heart meta-icon"
                                                       data-toggle="modal"
                                                       data-target="#login-popup"
                                                       href="javascript:void(0);">
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
    {{--CATEGORY PRODUCT PREVIEW--}}




        <!--Breadcrumb Section Start-->
        <section class="breadcrumb-bg">
            <div class="theme-container container ">
                <div class="site-breadcumb">

                    <h1 class="section-title fsz-36">
                        {{ trans('layout.search_result') }} "{{ $model->seriesTitle }}"
                    </h1>
                        <span class="category-prod_count fsz-36">
                            {{ $model->countSearchProducts }}
                        </span>
                </div>
            </div>
        </section>
        <!--Breadcrumb Section End-->

        <!-- Page Starts-->
        <div class="container theme-container ptb-70">
            <div class="row">


                <div class="visible-xs pt-70"></div>

                <!-- Product Details Starts-->
                <aside class="col-md-12 col-sm-12">
                    <div class="sorter-bar block-inline">
                        <div class="col-md-6 col-sm-7 no-padding sorter-date">


                            <div class="site-breadcumb white-clr">
                                <ol class="breadcrumb breadcrumb-menubar">
                                    <li>
                                        <a href="{{ url_home($model->language) }}">
                                            {{ trans('profile.home') }}
                                        </a>
                                        <a>{{ trans('layout.search') }}</a>
                                        "{{ $model->seriesTitle }}"
                                    </li>
                                </ol>
                            </div>


                        </div>

                        <div class="col-md-6 col-sm-5 show-result no-padding">
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
                                        <option data-url="{{ $sortItem->url_search }}" {{$sortItem->isSelected ? 'disabled' : ''}}>
                                            {{ $sortItem->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content">

                        <!-- Product Grid View Starts -->
                        <div id="grid-view" class="tab-pane fade active in" role="tabpanel">
                            <div class="row">
                                @php($counter = 0)
                                @php($categoryProducts = $model->searchProducts)
                                @foreach($categoryProducts as $categoryProduct)

                                    @php($relatedProducts = $categoryProduct->product_group->products)

                                    <div class="col-lg-3 col-sm-3 prod-wrap-cont">

                                        <div class="prod-wrap-absolute clearfix">
                                            <div class="product_item prod-wrap">
                                                <div class="product_img">
                                                    <div class="prod-img">
                                                        <a class="img-hover"
                                                           href="{{ url_product($categoryProduct->slug, $model->language) }}">
                                                            <div class="photo-cat_fit">
                                                                <img alt="product"
                                                                     src="{{ $categoryProduct->images[0]->medium }}">
                                                            </div>

                                                        </a>

                                                        @if($categoryProduct->promotions != null && $categoryProduct->promotions->count() > 0)
                                                            @if($categoryProduct->promotions[0]->id == 1)
                                                                <div class="prod-tag-1 font-2">
                                                                    <span> -{{ $categoryProduct->price[0]->discount }}% </span>
                                                                </div>
                                                            @endif
                                                            @if($categoryProduct->promotions[0]->id == 2)
                                                                <div class="prod-tag-1 font-2 prod-tag-green">
                                                                    <span> NEW </span>
                                                                </div>
                                                            @endif
                                                            @if($categoryProduct->promotions[0]->id == 3)
                                                                <div class="prod-tag-1 font-2 prod-tag-violet">
                                                                    <span> TOP </span>
                                                                </div>
                                                            @endif
                                                        @endif

                                                        <a class="caption-link meta-icon"
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
                                                            <ins>{{ $categoryProduct->price[0]->price }} грн</ins>

                                                            @if($categoryProduct->promotions != null && $categoryProduct->promotions->count() > 0)
                                                                @if($categoryProduct->promotions[0]->pivot->promotion_id == 1)
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
                                                                       v-on:click="addToWishList({{$categoryProduct->id}}, categoryProducts[{{$counter}}].currentSizeId, wishList.id)"
                                                                       href="javascript:void(0);"></a>
                                                                    <a v-cloak v-else
                                                                       class="fa fa-check meta-icon meta-icon-in-wish"
                                                                       href="{{ url_wish_list($model->language) }}"></a>
                                                                @else
                                                                    <a class="fa fa-heart meta-icon"
                                                                       data-toggle="modal"
                                                                       data-target="#login-popup"
                                                                       href="javascript:void(0);">
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
                                                                            <a v-on:click="changeCurrentSizeId({{$counter}}, {{$size->id}})"
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
                            @include('partial.search-page.pagination')
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