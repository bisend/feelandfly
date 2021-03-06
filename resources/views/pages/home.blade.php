@extends('layout')

@section('content')
    <article class="light-bg-1 margin-after-header">

        @if(!is_null($model->mainSlider) && $model->mainSlider->count() > 0)
            <!-- Slider Start -->
            <section class="slider-section" id="main-slider-section">


                {{--MAIN SLIDER PRODUCT PREVIEW--}}
                @if(!is_null($model->mainSlider))
                    <div id="main-slider-product-preview">
                        <section v-if="isMainSliderProductsInited" class="modal fade  popups-wrap popups-light" id="main-slider-preview"
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
                                                <div class="item" v-for="image in mainSliderPreview.product.images">
                                                    <img v-bind:src="image.big" v-bind:alt="mainSliderPreview.product.name">

                                                    <div v-if="mainSliderPreview.product.promotions != null && mainSliderPreview.product.promotions.length > 0 && mainSliderPreview.product.promotions[0].priority == 3"
                                                         class="prod-tag-1 font-2">
                                                        {{--<span> -@{{ mainSliderPreview.product.price[0].discount }}% </span>--}}
                                                        <span> SALE </span>
                                                    </div>
                                                    <div v-if="mainSliderPreview.product.promotions != null && mainSliderPreview.product.promotions.length > 0 && mainSliderPreview.product.promotions[0].priority == 1"
                                                         class="prod-tag-1 font-2 prod-tag-green">
                                                        <span> NEW </span>
                                                    </div>
                                                    <div v-if="mainSliderPreview.product.promotions != null && mainSliderPreview.product.promotions.length > 0 && mainSliderPreview.product.promotions[0].priority == 2"
                                                         class="prod-tag-1 font-2 prod-tag-violet">
                                                        <span> TOP </span>
                                                    </div>


                                                    <a v-bind:href="image.original"
                                                       v-bind:rel="mainSliderPreview.rel"
                                                       v-bind:title="mainSliderPreview.product.name"
                                                       class="caption-link meta-icon">
                                                        <i class="fa fa-eye"></i>
                                                        <span class="zoom-text">{{ trans('product.zoom_picture') }}</span>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="owl-carousel single-prod-thumb sync2 nav-2 product-preview-images-small">
                                                <div class="item" v-for="image in mainSliderPreview.product.images">
                                                    <img v-bind:src="image.small" v-bind:alt="mainSliderPreview.product.name">
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
                                                    <a :href="'/product/' + mainSliderPreview.product.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'">
                                                        @{{ mainSliderPreview.product.name }}
                                                    </a>
                                                </div>
                                                <div class="block-inline">
                                                    <div class="rating pull-right">
                                                        <span v-for="i in 5" v-if="i <= mainSliderPreview.product.rating" class="star active"></span>
                                                        <span v-else class="star"></span>
                                                    </div>
                                                    <div class="prod-price font-2 pull-left fsz-16">
                                                        <ins>@{{ mainSliderPreview.product.price[0].price }} грн</ins>

                                                        <del v-if="mainSliderPreview.product.promotions != null && mainSliderPreview.product.promotions.length > 0 && mainSliderPreview.product.promotions[0].priority == 3">
                                                            @{{ mainSliderPreview.product.price[0].old_price }} грн
                                                        </del>

                                                    </div>
                                                </div>
                                                <div class="discriptions pt-20">
                                                    <ul>
                                                        <li>{{ trans('product.stock') }}:
                                                            <span v-cloak v-for="productSize in mainSliderPreview.product.product_sizes"
                                                                  v-if="productSize.size_id == mainSliderPreview.currentSizeId">
                                                                <span v-if="productSize.stocks[0].stock > 0" class="product-in-stock">
                                                                    {{ trans('product.product_in_stock') }}
                                                                </span>
                                                                <span v-else class="product-not-in-stock">
                                                                    {{ trans('product.product_not_in_stock') }}
                                                                </span>
                                                            </span>
                                                        </li>
                                                        <li v-for="property in mainSliderPreview.product.properties" v-if="property.slug != 'razmer'">
                                                            @{{ property.property_name }}: @{{ property.property_value }}
                                                        </li>
                                                        <li>Артикул: @{{ mainSliderPreview.product.vendor_code }}</li>
                                                    </ul>
                                                </div>
                                                <div class="prod-attributes">
                                                    <ul class="choose-clr list-inline border-hover">
                                                        <div class="prod-color_title">
                                                            {{ trans('email.color') }} : <span v-cloak>@{{ mainSliderPreview.product.color.name }}</span>
                                                        </div>
                                                        <li v-for="relatedProduct in mainSliderPreview.product.product_group.products">
                                                            <a v-if="relatedProduct.color.id === mainSliderPreview.product.color.id"
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
                                                            <span v-for="size in mainSliderPreview.product.sizes" v-if="size.id == mainSliderPreview.currentSizeId" v-cloak>
                                                            @{{ size.name }}
                                                        </span>
                                                        </div>
                                                        <li v-for="(size, index) in mainSliderPreview.product.sizes">
                                                            <a v-on:click.prevent="changeCurrentSizeId(size.id)"
                                                               :class="{active : mainSliderPreview.currentSizeId == size.id}"
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
                                                                       v-model.number="mainSliderPreview.count"
                                                                       v-on:change="toInteger(mainSliderPreview.count)"
                                                                       class="form-control qty"
                                                                       title="{{ trans('cart.qty') }}">
                                                                <button class="btn plus" v-on:click="increment()">+</button>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a class="theme-btn btn-black small-btn"
                                                               v-on:click.prevent="addToCart(mainSliderPreview.product.id, mainSliderPreview.currentSizeId, mainSliderPreview.count)"
                                                               href="#">
                                                                <span v-cloak v-if=" ! mainSliderPreview.inStock">
                                                                    {{ trans('layout.notify') }}
                                                                </span>
                                                                <span v-cloak
                                                                    v-else-if="!findWhere(cartItems, {'productId': mainSliderPreview.product.id, 'sizeId': mainSliderPreview.currentSizeId})">
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
                                                                   v-if="!findWhere(wishListItems, {'productId': mainSliderPreview.product.id, 'sizeId': mainSliderPreview.currentSizeId})"
                                                                   class="fa fa-heart meta-icon"
                                                                   v-on:click.prevent="addToWishList(mainSliderPreview.product.id, mainSliderPreview.currentSizeId, wishList.id)"
                                                                   href="#"></a>
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
                @endif
                {{--MAIN SLIDER PRODUCT PREVIEW--}}


                <div id="main-slider" class="main-slider nav-2">
                    @php($counter = 0)
                    @foreach($model->mainSlider as $slide)
                        <div class="item">
                            <a href="{{ !is_null($slide->url) ? $slide->url : '#' }}">
                                <div class="carousel-inner white-mask">
                                    <div class="big-slider-cover">
                                        <img src="{{ $slide->image }}" alt="slide{{ $counter }}">
                                        @if(!is_null($slide->markers) && $slide->markers->count() > 0)
                                            <div class="marker-box" data-marker-container>
                                                @foreach($slide->markers as $marker)
                                                    @if($marker->product != null)
                                                        @php($product = $marker->product)
                                                        <div data-marker-point="{{ $counter }}" class="marker-position" style="left: {{ $marker->position_x }}%; top: {{ $marker->position_y }}%;">
                                                            <a data-marker-link="{{$counter}}" class="pulse marker"></a>
                                                            <div data-marker-product="{{ $counter }}" class="prod-wrap-cont marker-product">
                                                                <div class="product_item prod-wrap">
                                                                    <div class="product_img">
                                                                        <div class="prod-img">
                                                                            <a class="img-hover" href="{{ url_product($product->slug, $model->language) }}">
                                                                                <div class="img-slide-fit">
                                                                                    <img alt="{{ $product->name }}" src="{{ $product->images[0]->medium }}">
                                                                                </div>
                                                                            </a>

                                                                            @if($product->promotions != null && $product->promotions->count() > 0)
                                                                                @if($product->promotions[0]->priority == 3)
                                                                                    <div class="prod-tag-1 font-2">
                                                                                        {{--<span> -{{ $product->price[0]->discount }}% </span>--}}
                                                                                        <span> SALE </span>
                                                                                    </div>
                                                                                @endif
                                                                                @if($product->promotions[0]->priority == 1)
                                                                                    <div class="prod-tag-1 font-2 prod-tag-green">
                                                                                        <span> NEW </span>
                                                                                    </div>
                                                                                @endif
                                                                                @if($product->promotions[0]->priority == 2)
                                                                                    <div class="prod-tag-1 font-2 prod-tag-violet">
                                                                                        <span> TOP </span>
                                                                                    </div>
                                                                                @endif
                                                                            @endif

                                                                            <a class="caption-link meta-icon"
                                                                               href="#"
                                                                               data-marker-product-preview="{{$counter}}">
                                                                                <span class="fa fa-eye"> </span> {{ trans('product.fast_see') }}
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product_info">
                                                                        <h2 class="prod-title">
                                                                            <a href="{{ url_product($product->slug, $model->language) }}">
                                                                                {{ $product->name }}
                                                                            </a>
                                                                        </h2>
                                                                        <div class="block-inline">
                                                                            <div class="prod-price font-2">
                                                                                <ins>{{ $product->price[0]->price }} грн</ins>

                                                                                @if($product->promotions != null && $product->promotions->count() > 0)
                                                                                    @if($product->promotions[0]->pivot->promotion_id == 1)
                                                                                        @if($product->promotions[0]->priority == 3)
                                                                                            <del>{{ $product->price[0]->old_price }} грн</del>
                                                                                        @endif
                                                                                    @endif
                                                                                @endif
                                                                            </div>
                                                                            <div class="rating">
                                                                                @for($i = 1; $i <= 5; $i++)
                                                                                    @if($product->rating != null)
                                                                                        @if($i <= $product->rating)
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
                                                                                    <a class="theme-btn btn-black min-width-270-px"
                                                                                       href="{{ url_product($product->slug, $model->language) }}">
                                                                                        {{ trans('home.detail') }}
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @php($counter++)
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
            <!-- / Slider Ends -->
        @endif

        @if(!is_null($model->salesProducts) && $model->salesProducts->count() > 0)
            <!-- SALES PRODUCTS Slider  Start -->
            <section class="sec-space" id="sales-products">

                {{--SALES PRODUCT PREVIEW--}}
                @if(!is_null($model->salesProducts))
                <div id="sales-product-preview">
                    <section class="modal fade  popups-wrap popups-light" id="sale-preview"
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
                                            <div class="item" v-for="image in saleProductPreview.product.images">
                                                <img v-bind:src="image.big" v-bind:alt="saleProductPreview.product.name">
                                                <div class="prod-tag-1 font-2">
                                                    {{--<span> -@{{ saleProductPreview.product.price[0].discount }}% </span>--}}
                                                    <span> SALE </span>
                                                </div>
                                                <a v-bind:href="image.original"
                                                   v-bind:rel="saleProductPreview.rel"
                                                   v-bind:title="saleProductPreview.product.name"
                                                   class="caption-link meta-icon">
                                                    <i class="fa fa-eye"></i>
                                                    <span class="zoom-text">{{ trans('product.zoom_picture') }}</span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="owl-carousel single-prod-thumb sync2 nav-2 product-preview-images-small">
                                            <div class="item" v-for="image in saleProductPreview.product.images">
                                                <img v-bind:src="image.small" v-bind:alt="saleProductPreview.product.name">
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
                                                <a :href="'/product/' + saleProductPreview.product.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'">
                                                    @{{ saleProductPreview.product.name }}
                                                </a>
                                            </div>
                                            <div class="block-inline">
                                                <div class="rating pull-right">
                                                    <span v-for="i in 5" v-if="i <= saleProductPreview.product.rating" class="star active"></span>
                                                    <span v-else class="star"></span>
                                                </div>
                                                <div class="prod-price font-2 pull-left fsz-16">
                                                    <ins>@{{ saleProductPreview.product.price[0].price }} грн</ins>
                                                    <del>@{{ saleProductPreview.product.price[0].old_price }} грн</del>
                                                </div>
                                            </div>
                                            <div class="discriptions pt-20">
                                                <ul>
                                                    <li>{{ trans('product.stock') }}:
                                                        <span v-cloak v-for="productSize in saleProductPreview.product.product_sizes"
                                                              v-if="productSize.size_id == saleProductPreview.currentSizeId">
                                                            <span v-if="productSize.stocks[0].stock > 0" class="product-in-stock">
                                                                {{ trans('product.product_in_stock') }}
                                                            </span>
                                                            <span v-else class="product-not-in-stock">
                                                                {{ trans('product.product_not_in_stock') }}
                                                            </span>
                                                        </span>
                                                    </li>
                                                    <li v-for="property in saleProductPreview.product.properties" v-if="property.slug != 'razmer'">
                                                        @{{ property.property_name }}: @{{ property.property_value }}
                                                    </li>
                                                    <li>Артикул: @{{ saleProductPreview.product.vendor_code }}</li>
                                                </ul>
                                            </div>
                                            <div class="prod-attributes">
                                                <ul class="choose-clr list-inline border-hover">
                                                    <div class="prod-color_title">
                                                        {{ trans('email.color') }} : <span v-cloak>@{{ saleProductPreview.product.color.name }}</span>
                                                    </div>
                                                    <li v-for="relatedProduct in saleProductPreview.product.product_group.products">
                                                        <a v-if="relatedProduct.color.id === saleProductPreview.product.color.id"
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
                                                        <span v-for="size in saleProductPreview.product.sizes" v-if="size.id == saleProductPreview.currentSizeId" v-cloak>
                                                            @{{ size.name }}
                                                        </span>
                                                    </div>
                                                    <li v-for="(size, index) in saleProductPreview.product.sizes">
                                                        <a v-on:click.prevent="changeCurrentSizeId(size.id)"
                                                           :class="{active : saleProductPreview.currentSizeId == size.id}"
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
                                                                   v-model.number="saleProductPreview.count"
                                                                   v-on:change="toInteger(saleProductPreview.count)"
                                                                   class="form-control qty"
                                                                   title="{{ trans('cart.qty') }}">
                                                            <button class="btn plus" v-on:click="increment()">+</button>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <a class="theme-btn btn-black small-btn"
                                                           v-on:click.prevent="addToCart(saleProductPreview.product.id, saleProductPreview.currentSizeId, saleProductPreview.count)"
                                                           href="#">
                                                            <span v-cloak v-if=" ! saleProductPreview.inStock">
                                                                {{ trans('layout.notify') }}
                                                            </span>
                                                            <span v-cloak
                                                                v-else-if="!findWhere(cartItems, {'productId': saleProductPreview.product.id, 'sizeId': saleProductPreview.currentSizeId})">
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
                                                               v-if="!findWhere(wishListItems, {'productId': saleProductPreview.product.id, 'sizeId': saleProductPreview.currentSizeId})"
                                                               class="fa fa-heart meta-icon"
                                                               v-on:click.prevent="addToWishList(saleProductPreview.product.id, saleProductPreview.currentSizeId, wishList.id)"
                                                               href="#"></a>
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
                {{--SALES PRODUCT PREVIEW--}}

                <div class="container">
                    <!-- Related Products Starts -->
                    <div class="block-inline pt-15 similar_prod-section">
                        <h2 class="section-title">
                            {{ trans('home.sale') }}
                        </h2>
                        <div id="sales-prod-slider" class="rel-prod-slider nav-1 padding-own">

                            @php($counter = 0)
                            @foreach($model->salesProducts as $saleProduct)
                                <div class="item similar_products">
                                    <div class="prod-wrap pt-50">
                                        <figure>
                                            <div class="prod-img">
                                                <a class="img-hover"
                                                   href="{{ url_product($saleProduct->slug, $model->language) }}">
                                                    <div class="img-slide-fit">
                                                        <img alt="{{ $saleProduct->name }}"
                                                             src="{{ $saleProduct->images[0]->medium }}">
                                                        </div>
                                                </a>
                                                <div class="prod-tag-1 font-2">
                                                    {{--<span> -{{ $saleProduct->price[0]->discount }}% </span>--}}
                                                    <span> SALE </span>
                                                </div>
                                                <a class="caption-link meta-icon"
                                                   href="#"
                                                   v-on:click.prevent="changeSalesProductPreview({{$counter}})">
                                                    <span class="fa fa-eye"></span> {{ trans('product.fast_see') }}
                                                </a>
                                            </div>
                                            <figcaption class="prod-content">
                                                <h2 class="prod-title">
                                                    <a href="{{ url_product($saleProduct->slug, $model->language) }}">
                                                        {{ $saleProduct->name }}
                                                    </a>
                                                </h2>
                                                <div class="block-inline">
                                                    <div class="rating">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($saleProduct->rating != null)
                                                                @if($i <= $saleProduct->rating)
                                                                    <span class="star active"></span>
                                                                @else
                                                                    <span class="star"></span>
                                                                @endif
                                                            @else
                                                                <span class="star"></span>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <div class="prod-price font-2">
                                                        <ins>{{ $saleProduct->price[0]->price }} грн</ins>
                                                        <del>{{ $saleProduct->price[0]->old_price }} грн</del>
                                                    </div>
                                                </div>
                                                <div class="block-inline">
                                                    <ul class="prod-meta">
                                                        <li>
                                                            <a href="{{ url_product($saleProduct->slug, $model->language) }}"
                                                               class="theme-btn btn-black min-width-270-px">
                                                                {{ trans('home.detail') }}
                                                            </a>
                                                        </li>
                                                        {{--<li>--}}
                                                            {{--@if(auth()->check())--}}
                                                                {{--<a v-cloak--}}
                                                                   {{--v-if="!findWhere(wishListItems, {'productId': {{$saleProduct->id}}, 'sizeId': salesProducts[{{$counter}}].currentSizeId})"--}}
                                                                   {{--class="fa fa-heart meta-icon"--}}
                                                                   {{--v-on:click="addToWishList({{$saleProduct->id}}, salesProducts[{{$counter}}].currentSizeId, wishList.id)"--}}
                                                                   {{--href="javascript:void(0);"></a>--}}
                                                                {{--<a v-cloak v-else--}}
                                                                   {{--class="fa fa-check meta-icon meta-icon-in-wish"--}}
                                                                   {{--href="{{ url_wish_list($model->language) }}"></a>--}}
                                                            {{--@else--}}
                                                                {{--<a class="fa fa-heart meta-icon"--}}
                                                                   {{--data-toggle="modal"--}}
                                                                   {{--data-target="#login-popup"--}}
                                                                   {{--href="javascript:void(0);">--}}
                                                                {{--</a>--}}
                                                            {{--@endif--}}
                                                        {{--</li>--}}
                                                    </ul>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </div>
                                @php($counter++)
                            @endforeach
                        </div>
                        <div class="sale-button-block">
                            <a href="{{ url_sale($model->language) }}" class="btn_link sale-button">{{ trans('home.all_sales') }} ({{ $model->salesProductsCount }})</a>
                        </div>
                    </div>
                    <!-- Related Products Ends -->


                </div>
                @endif
            </section>
            <!-- / SALES PRODUCTS Slider Ends -->
        @endif
        <!-- CATEGORIES SPECIAL Slider Starts-->
        {{--<section class="special-promo-sec black-mask">--}}
            {{--<div id="slider-category" class="blog-slider-1 category-slider">--}}
                {{--@foreach($model->categories as $category)--}}
                    {{--<div class="item">--}}
                        {{--<a href="{{ url_category($category->slug, $model->language) }}" class="promo">--}}
                            {{--<h2 class="section-title wht fsz-106 font-s-cat">--}}
                                {{--<img alt="{{ $category->name }}" src="{{ $category->icon }}" >--}}
                            {{--</h2>--}}
                            {{--<span class="sub-detail wht font-s-number"> {{ $category->name }} </span>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}
        {{--</section>--}}

            <section class="home-category-section">
                <div class="container">
                    <h2 class="section-title">
                        {{ trans('home.categories') }}
                    </h2>
                    <div id="home-slider-category" class="home-slider-category">
                        @foreach($model->categories as $category)
                            <div class="item category-slider-item">
                                <a href="{{ url_category($category->slug, $model->language) }}" class="category-inform">
                                    <div class="img">
                                        @if( ! is_null($category->icon))
                                            <img src="{{ $category->icon }}" alt="{{ $category->name }}">
                                        @else
                                            <img src="/img/product/big/no-photo.jpg" alt="{{ $category->name }}">
                                        @endif
                                    </div>
                                    <span class="category-title"> {{ $category->name }} </span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>


        <!-- / CATEGORIES SPECIAL Slider  Ends -->

        <!-- TOP AND NEW Sliders Start -->
        <section class="prod-slider-sec">
            <div class="container">
                <div class="row">
                    @if(!is_null($model->topProducts) && $model->topProducts->count() > 0)
                        <div class="col-md-12 shares-products" id="top-products">
                            <h2 class="section-title">
                                Топ продаж
                            </h2>

                            {{--TOP-PREVIEW--}}
                            <div id="top-product-preview">
                                <section class="modal fade  popups-wrap popups-light" id="top-preview"
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
                                                        <div class="item" v-for="image in topProductPreview.product.images">
                                                            <img v-bind:src="image.big" v-bind:alt="topProductPreview.product.name">
                                                            <div class="prod-tag-1 font-2 prod-tag-violet">
                                                                <span> TOP </span>
                                                            </div>
                                                            <a v-bind:href="image.original"
                                                               v-bind:rel="topProductPreview.rel"
                                                               v-bind:title="topProductPreview.product.name"
                                                               class="caption-link meta-icon">
                                                                <i class="fa fa-eye"></i>
                                                                <span class="zoom-text">{{ trans('product.zoom_picture') }}</span>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="owl-carousel single-prod-thumb sync2 nav-2 product-preview-images-small">
                                                        <div class="item" v-for="image in topProductPreview.product.images">
                                                            <img v-bind:src="image.small" v-bind:alt="topProductPreview.product.name">
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
                                                                <a :href="'/product/' + topProductPreview.product.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'">
                                                                @{{ topProductPreview.product.name }}
                                                            </a>
                                                        </div>
                                                        <div class="block-inline">
                                                            <div class="rating pull-right">
                                                                <span v-for="i in 5" v-if="i <= topProductPreview.product.rating" class="star active"></span>
                                                                <span v-else class="star"></span>
                                                            </div>
                                                            <div class="prod-price font-2 pull-left fsz-16">
                                                                <ins>@{{ topProductPreview.product.price[0].price }} грн</ins>
                                                            </div>
                                                        </div>
                                                        <div class="discriptions pt-20">
                                                            <ul>
                                                                <li>{{ trans('product.stock') }}:
                                                                    <span v-cloak v-for="productSize in topProductPreview.product.product_sizes"
                                                                          v-if="productSize.size_id == topProductPreview.currentSizeId">
                                                                        <span v-if="productSize.stocks[0].stock > 0" class="product-in-stock">
                                                                            {{ trans('product.product_in_stock') }}
                                                                        </span>
                                                                        <span v-else class="product-not-in-stock">
                                                                            {{ trans('product.product_not_in_stock') }}
                                                                        </span>
                                                                    </span>
                                                                </li>
                                                                <li v-for="property in topProductPreview.product.properties" v-if="property.slug != 'razmer'">
                                                                    @{{ property.property_name }}: @{{ property.property_value }}
                                                                </li>
                                                                <li>Артикул: @{{ topProductPreview.product.vendor_code }}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="prod-attributes">
                                                            <ul class="choose-clr list-inline border-hover">
                                                                <div class="prod-color_title">
                                                                    {{ trans('email.color') }} : <span v-cloak>@{{ topProductPreview.product.color.name }}</span>
                                                                </div>
                                                                <li v-for="relatedProduct in topProductPreview.product.product_group.products">
                                                                    <a v-if="relatedProduct.color.id === topProductPreview.product.color.id"
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
                                                                    <span v-for="size in topProductPreview.product.sizes" v-if="size.id == topProductPreview.currentSizeId" v-cloak>
                                                                        @{{ size.name }}
                                                                    </span>
                                                                </div>
                                                                <li v-for="(size, index) in topProductPreview.product.sizes">
                                                                    <a v-on:click.prevent="changeCurrentSizeId(size.id)"
                                                                       :class="{active : topProductPreview.currentSizeId == size.id}"
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
                                                                               v-model.number="topProductPreview.count"
                                                                               v-on:change="toInteger(topProductPreview.count)"
                                                                               class="form-control qty"
                                                                               title="{{ trans('cart.qty') }}">
                                                                        <button class="btn plus" v-on:click="increment()">+</button>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a class="theme-btn btn-black small-btn"
                                                                       v-on:click.prevent="addToCart(topProductPreview.product.id, topProductPreview.currentSizeId, topProductPreview.count)"
                                                                       href="#">
                                                                        <span v-cloak v-if=" ! topProductPreview.inStock">
                                                                            {{ trans('layout.notify') }}
                                                                        </span>
                                                                        <span v-cloak
                                                                            v-else-if="!findWhere(cartItems, {'productId': topProductPreview.product.id, 'sizeId': topProductPreview.currentSizeId})">
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
                                                                           v-if="!findWhere(wishListItems, {'productId': topProductPreview.product.id, 'sizeId': topProductPreview.currentSizeId})"
                                                                           class="fa fa-heart meta-icon"
                                                                           v-on:click.prevent="addToWishList(topProductPreview.product.id, topProductPreview.currentSizeId, wishList.id)"
                                                                           href="#"></a>
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
                            {{--TOP-PREVIEW--}}

                            <div id="prod-slider-1" class="prod-slider-1 nav-1">
                                @php($counter = 0)
                                @foreach($model->topProducts as $topProduct)
                                    <div class="item similar_products">
                                        <div class="prod-wrap pt-50">
                                            <figure>
                                                <div class="prod-img">
                                                    <a class="img-hover" href="{{ url_product($topProduct->slug, $model->language) }}">
                                                        <div class="img-slide-fit">
                                                            <img alt="{{ $topProduct->name }}" src="{{ $topProduct->images[0]->medium }}">
                                                        </div>

                                                    </a>
                                                    <div class="prod-tag-1 font-2 prod-tag-violet">
                                                        <span> TOP </span>
                                                    </div>
                                                    <a class="caption-link meta-icon"
                                                       data-toggle="modal"
                                                       href="#"
                                                       v-on:click.prevent="changeTopProductPreview({{$counter}})">
                                                        <span class="fa fa-eye"> </span> {{ trans('product.fast_see') }}
                                                    </a>
                                                </div>
                                                <figcaption class="prod-content">
                                                    <h2 class="prod-title">
                                                        <a href="{{ url_product($topProduct->slug, $model->language) }}">
                                                            {{ $topProduct->name }}
                                                        </a>
                                                    </h2>
                                                    <div class="block-inline">
                                                        <div class="rating">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                @if($topProduct->rating != null)
                                                                    @if($i <= $topProduct->rating)
                                                                        <span class="star active"></span>
                                                                    @else
                                                                        <span class="star"></span>
                                                                    @endif
                                                                @else
                                                                    <span class="star"></span>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <div class="prod-price font-2">
                                                            <ins>{{ $topProduct->price[0]->price }} грн</ins>
                                                        </div>
                                                    </div>
                                                    <div class="block-inline">
                                                        <ul class="prod-meta">
                                                            <li>
                                                                <a class="theme-btn btn-black min-width-270-px"
                                                                   href="{{ url_product($topProduct->slug, $model->language) }}">
                                                                    {{ trans('home.detail') }}
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                    @php($counter++)
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <section class="prod-slider-sec prod-slider-news pb-20">
            <div class="container">
                <div class="row">
                    @if(!is_null($model->newProducts) && $model->newProducts->count() > 0)
                        <div class="col-md-12 new-products" id="new-products">
                            <h2 class="section-title">
                                Новинки
                            </h2>

                            {{--NEW-PREVIEW--}}
                            <div id="new-product-preview">
                                <section class="modal fade  popups-wrap popups-light" id="new-preview"
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
                                                        <div class="item" v-for="image in newProductPreview.product.images">
                                                            <img v-bind:src="image.big" v-bind:alt="newProductPreview.product.name">
                                                            <div class="prod-tag-1 font-2 prod-tag-green">
                                                                <span> NEW </span>
                                                            </div>
                                                            <a v-bind:href="image.original"
                                                               v-bind:rel="newProductPreview.rel"
                                                               v-bind:title="newProductPreview.product.name"
                                                               class="caption-link meta-icon">
                                                                <i class="fa fa-eye"></i>
                                                                <span class="zoom-text">{{ trans('product.zoom_picture') }}</span>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="owl-carousel single-prod-thumb sync2 nav-2 product-preview-images-small">
                                                        <div class="item" v-for="image in newProductPreview.product.images">
                                                            <img v-bind:src="image.small" v-bind:alt="newProductPreview.product.name">
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
                                                            <a :href="'/product/' + newProductPreview.product.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'">
                                                                @{{ newProductPreview.product.name }}
                                                            </a>
                                                        </div>
                                                        <div class="block-inline">
                                                            <div class="rating pull-right">
                                                                <span v-for="i in 5" v-if="i <= newProductPreview.product.rating" class="star active"></span>
                                                                <span v-else class="star"></span>
                                                            </div>
                                                            <div class="prod-price font-2 pull-left fsz-16">
                                                                <ins>@{{ newProductPreview.product.price[0].price }} грн</ins>
                                                            </div>
                                                        </div>
                                                        <div class="discriptions pt-20">
                                                            <ul>
                                                                <li>{{ trans('product.stock') }}:
                                                                    <span v-cloak v-for="productSize in newProductPreview.product.product_sizes"
                                                                          v-if="productSize.size_id == newProductPreview.currentSizeId">
                                                                        <span v-if="productSize.stocks[0].stock > 0" class="product-in-stock">
                                                                            {{ trans('product.product_in_stock') }}
                                                                        </span>
                                                                        <span v-else class="product-not-in-stock">
                                                                            {{ trans('product.product_not_in_stock') }}
                                                                        </span>
                                                                    </span>
                                                                </li>
                                                                <li v-for="property in newProductPreview.product.properties" v-if="property.slug != 'razmer'">
                                                                    @{{ property.property_name }}: @{{ property.property_value }}
                                                                </li>
                                                                <li>Артикул: @{{ newProductPreview.product.vendor_code }}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="prod-attributes">
                                                            <ul class="choose-clr list-inline border-hover">
                                                                <div class="prod-color_title">
                                                                    {{ trans('email.color') }} : <span v-cloak>@{{ newProductPreview.product.color.name }}</span>
                                                                </div>
                                                                <li v-for="relatedProduct in newProductPreview.product.product_group.products">
                                                                    <a v-if="relatedProduct.color.id === newProductPreview.product.color.id"
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
                                                                    <span v-for="size in newProductPreview.product.sizes" v-if="size.id == newProductPreview.currentSizeId" v-cloak>
                                                                        @{{ size.name }}
                                                                    </span>
                                                                </div>
                                                                <li v-for="(size, index) in newProductPreview.product.sizes">
                                                                    <a v-on:click.prevent="changeCurrentSizeId(size.id)"
                                                                       :class="{active : newProductPreview.currentSizeId == size.id}"
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
                                                                               v-model.number="newProductPreview.count"
                                                                               v-on:change="toInteger(newProductPreview.count)"
                                                                               class="form-control qty"
                                                                               title="{{ trans('cart.qty') }}">
                                                                        <button class="btn plus" v-on:click="increment()">+</button>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a class="theme-btn btn-black small-btn"
                                                                       v-on:click.prevent="addToCart(newProductPreview.product.id, newProductPreview.currentSizeId, newProductPreview.count)"
                                                                       href="#">
                                                                        <span v-cloak v-if=" ! newProductPreview.inStock">
                                                                            {{ trans('layout.notify') }}
                                                                        </span>
                                                                        <span v-cloak
                                                                                v-else-if="!findWhere(cartItems, {'productId': newProductPreview.product.id, 'sizeId': newProductPreview.currentSizeId})">
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
                                                                           v-if="!findWhere(wishListItems, {'productId': newProductPreview.product.id, 'sizeId': newProductPreview.currentSizeId})"
                                                                           class="fa fa-heart meta-icon"
                                                                           v-on:click.prevent="addToWishList(newProductPreview.product.id, newProductPreview.currentSizeId, wishList.id)"
                                                                           href="#"></a>
                                                                        <a v-cloak v-else
                                                                           class="fa fa-check meta-icon meta-icon-in-wish"
                                                                           href="{{ url_wish_list($model->language) }}"></a>
                                                                    @else
                                                                        <a class="fa fa-heart meta-icon"
                                                                           data-toggle="modal"
                                                                           data-target="#login-popup"
                                                                           href="javascript:void(0);"></a>
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
                            {{--NEW-PREVIEW--}}

                            <div id="prod-slider-2" class="prod-slider-2 nav-1">
                                @php($counter = 0)
                                @foreach($model->newProducts as $newProduct)
                                    <div class="item similar_products">
                                        <div class="prod-wrap pt-50">
                                            <figure>
                                                <div class="prod-img">
                                                    <a class="img-hover" href="{{ url_product($newProduct->slug, $model->language) }}">
                                                        <div class="img-slide-fit">
                                                            <img alt="{{ $newProduct->name }}" src="{{ $newProduct->images[0]->medium }}">
                                                        </div>
                                                    </a>
                                                    <div class="prod-tag-1 font-2 prod-tag-green">
                                                        <span> NEW </span>
                                                    </div>
                                                    <a class="caption-link meta-icon"
                                                       href="#"
                                                       v-on:click.prevent="changeNewProductPreview({{$counter}})">
                                                        <span class="fa fa-eye"> </span> {{ trans('product.fast_see') }}
                                                    </a>
                                                </div>
                                                <figcaption class="prod-content">
                                                    <h2 class="prod-title">
                                                        <a href="{{ url_product($newProduct->slug, $model->language) }}">
                                                            {{ $newProduct->name }}
                                                        </a>
                                                    </h2>
                                                    <div class="block-inline">
                                                        <div class="rating">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                @if($newProduct->rating != null)
                                                                    @if($i <= $newProduct->rating)
                                                                        <span class="star active"></span>
                                                                    @else
                                                                        <span class="star"></span>
                                                                    @endif
                                                                @else
                                                                    <span class="star"></span>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <div class="prod-price font-2">
                                                            <ins>{{ $newProduct->price[0]->price }} грн</ins>
                                                        </div>
                                                    </div>
                                                    <div class="block-inline">
                                                        <ul class="prod-meta">
                                                            <li>
                                                                <a class="theme-btn btn-black min-width-270-px"
                                                                   href="{{ url_product($newProduct->slug, $model->language) }}">
                                                                    {{ trans('home.detail') }}
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                    @php($counter++)
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <!-- / TOP AND NEW Sliders Ends -->


        <!-- LOOKBOOK Start -->
        {{--<section class="sec-banner-1 clearfix lookbook-ban-col">--}}
            {{--<div class="container">--}}
                {{--<div class="title-wrap  pb-50">--}}
                    {{--<div class="my_title_link my_title_link-lookbook">--}}
                        {{--<a href="{{ url_all_lookbook($model->language) }}" class="title_link">{{ trans('home.see_all') }}</a>--}}
                        {{--<h2 class="section-title"> LookBook's </h2>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-8">--}}
                        {{--<div class="banner-1 box-hover text-center baner-big-home">--}}
                            {{--<div class="baner_img">--}}
                                {{--<img src="/img/template/lookbook/fylBan1.png" alt="banner">--}}
                            {{--</div>--}}

                            {{--<div class="banner-content tbl-wrp black-mask">--}}
                                {{--<div class="text-middle">--}}
                                    {{--<div class="tbl-cell">--}}
                                        {{--<h2 class="section-title wht fsz-45"> Everything you need </h2>--}}
                                        {{--<p class="sub-detail wht fsz-35">for your creative own shop</p>--}}
                                        {{--<p class="no-margin">  <a href="#" class="btn-white theme-btn"> view more </a> </p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-4">--}}
                        {{--<div class="col-md-12">--}}
                            {{--<div class="banner-1 box-hover baner-smoll-home">--}}
                                {{--<div class="banner-smol-home-img">--}}
                                    {{--<img src="/img/template/lookbook/fylBan3.png" alt="banner">--}}
                                {{--</div>--}}
                                {{--<div class="banner-content tbl-wrp black-mask">--}}
                                    {{--<div class="text-middle">--}}
                                        {{--<div class="tbl-cell">--}}
                                            {{--<h2 class="section-title wht fsz-48"> LookBook 2016 </h2>--}}
                                            {{--<p class="sub-detail wht">men’s style</p>--}}
                                            {{--<p class="no-margin">  <a href="#" class="btn-white theme-btn"> shop now </a> </p>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-12">--}}
                            {{--<div class="banner-1 box-hover baner-smoll-home">--}}
                                {{--<div class="banner-smol-home-img">--}}
                                    {{--<img src="/img/template/lookbook/fylBan3.png" alt="banner">--}}
                                {{--</div>--}}
                                {{--<div class="banner-content tbl-wrp black-mask">--}}
                                    {{--<div class="text-middle">--}}
                                        {{--<div class="tbl-cell">--}}
                                            {{--<h2 class="section-title wht fsz-48"> LookBook 2016 </h2>--}}
                                            {{--<p class="sub-detail wht">men’s style</p>--}}
                                            {{--<p class="no-margin">  <a href="#" class="btn-white theme-btn"> shop now </a> </p>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</section>--}}
        <!-- / LOOKBOOK Ends -->

        @if(null)
        <!-- Blog Starts-->
        <section class="blog-sec padding-b-30">
            <div class="container">
                <div class="title-wrap pb-20">
                    <div class="my_title_link my_title_link_blogs">
                        <a href="{{ url_all_blogs($model->language) }}" class="title_link">{{ trans('home.see_all') }}</a>
                        <h2 class="section-title">{{ trans('home.blogs') }}</h2>
                    </div>
                </div>
                <div id="blog-slider-1" class="blog-slider-1">
                    @foreach($model->blogs as $blog)
                        <div class="item">
                            <div class="blog-wrap img-effect">
                                <div class="blog-img">
                                    <a href="{{ url_blog_page($blog->slug, $model->language) }}" class="img-hover">
                                        <img src="{{ $blog->image->medium }}" alt="{{ $blog->title }}">
                                    </a>
                                </div>
                                <div class="blog-heading">
                                    <a href="{{ url_blog_page($blog->slug, $model->language) }}" class="date">
                                        <span class="font-2 fsz-24">{{ $blog->created_at->format('d') }}</span>
                                        <b>{{ $blog->created_at->formatLocalized('%f') }}</b>
                                    </a>
                                    <a href="{{ url_blog_page($blog->slug, $model->language) }}" class="blog-title">
                                        {{ $blog->title }}
                                    </a>
                                </div>
                                <div class="blog-detail pt-25">
                                    <p>
                                        {{ $blog->short_description }}
                                    </p>
                                </div>
                                <div class="blog-meta">
                                    <ul class="list-inline">
                                        <li>
                                            <a href="{{ url_blog_page($blog->slug, $model->language) }}">
                                                <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                                <b>{{ $blog->created_at->format('d-m-Y') }}</b>
                                            </a>
                                        </li>
                                        {{--<li> <a href="#"> <i class="fa fa-comments-o"></i> <b>156</b> </a> </li>--}}
                                        <li>
                                            <a href="{{ url_blog_page($blog->slug, $model->language) }}">
                                                <i class="fa fa-eye"></i>
                                                <b>{{ $blog->number_of_views }}</b>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- / Blog Ends -->
        @endif
    </article>
@endsection
