{{--@if(false)<html xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">@endif--}}
@extends('layout')

@section('content')
    @php($relatedProducts = $model->product->product_group->products)

    <article class="margin-after-header">
        <!--Breadcrumb Section Start-->
        <section class="breadcrumb-bg">
            <div class="container ">
                <div class="site-breadcumb white-clr">
                    <ol class="breadcrumb breadcrumb-menubar">
                        <li>
                            <a href="{{ url_home($model->language) }}">
                                {{ trans('profile.home') }}
                            </a>
                            <a href="{{ url_category($model->currentCategory->slug, $model->language) }}">
                                {{ $model->currentCategory->name }}
                            </a>
                            {{ $model->product->name }}
                        </li>
                    </ol>
                </div>
            </div>
        </section>
        <!--Breadcrumb Section End-->

        <!-- Page Starts-->
        <div class="container product_section">
            <div class="row">

                <!-- Product Details Starts-->
                <aside class="col-md-12 col-sm-12">
                    <div data-single-product-container class="row">
                        <div class="col-md-7 col-sm-12 single-prod-slider sync-sliedr">
                            <!-- Single Products Slider Starts -->
                            <div class="owl-carousel sync1 solo-prod pb-25 big-slider">
                                @foreach($model->product->images as $image)
                                    <div class="item">
                                        <img src="{{ $image->big }}" alt="{{ $model->product->name }}">

                                        @if($model->product->promotions != null && $model->product->promotions->count() > 0)
                                            @if($model->product->promotions[0]->priority == 3)
                                                <div class="prod-tag-1 font-2">
                                                    {{--<span> -{{ $model->product->price[0]->discount }}% </span>--}}
                                                    <span> SALE </span>
                                                </div>
                                            @endif
                                            @if($model->product->promotions[0]->priority == 1)
                                                <div class="prod-tag-1 font-2 prod-tag-green">
                                                    <span> NEW </span>
                                                </div>
                                            @endif
                                            @if($model->product->promotions[0]->priority == 2)
                                                <div class="prod-tag-1 font-2 prod-tag-violet">
                                                    <span> TOP </span>
                                                </div>
                                            @endif
                                        @endif


                                        <a href="{{ $image->original }}"
                                           rel="prettyPhoto[single-product]"
                                           title="{{ $model->product->name }}"
                                           class="caption-link meta-icon">
                                            <i class="fa fa-search-plus"></i>
                                            <span class="zoom-text">{{ trans('product.zoom_picture') }}</span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <div class="owl-carousel single-prod-thumb sync2 solo-prod nav-2 item-smoll">
                                @foreach($model->product->images as $image)
                                    <div class="item">
                                        <img src="{{ $image->small }}" alt="{{ $model->product->name }}">
                                        <span class="transparent">
                                            <img src="/img/template/icons/plus.png" alt="view">
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Single Products Slider Ends -->
                        </div>
                        <div class="visible-sm visible-xs pt-50"></div>
                        <div class="col-md-5 col-sm-12">
                            <div class="prod-details" id="product-details">
                                <div class="prod-title">
                                    <h1>{{ $model->product->name }}</h1>
                                    <div class="product-article">
                                        Артикул: <b>{{ $model->product->vendor_code }}</b>
                                    </div>
                                </div>
                                <div class="block-inline">
                                    <div class="rating pull-left">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($model->product->rating != null)
                                                @if($i <= $model->product->rating)
                                                    <span class="star active"></span>
                                                @else
                                                    <span class="star"></span>
                                                @endif
                                            @else
                                                <span class="star"></span>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="scroll_to_comments pull-right" v-on:click.prevent="scrollToReview()">
                                        <span v-cloak>{{ trans('product.total_reviews') }}: @{{ totalReviewsCount }}</span>
                                    </div>

                                </div>

                                <div class="prod-price prod_price-prod-page font-2 fsz-26">
                                    <ins>{{ $model->product->price[0]->price }} грн</ins>

                                    @if($model->product->promotions != null && $model->product->promotions->count() > 0)
                                        @if($model->product->promotions[0]->priority == 3)
                                            <del>{{ $model->product->price[0]->old_price }} грн</del>
                                        @endif
                                    @endif

                                </div>


                                <div class="discriptions pt-15">
                                    <ul>
                                        <!-- <li>{{ trans('product.stock') }}:
                                            <span v-cloak v-for="productSize in singleProduct.product.product_sizes"
                                                  v-if="productSize.size_id == singleProduct.sizeId">
                                                <span v-if="productSize.stocks[0].stock > 0" class="product-in-stock">
                                                    {{ trans('product.product_in_stock') }}
                                                </span>
                                                <span v-else class="product-not-in-stock">
                                                    {{ trans('product.product_not_in_stock') }}
                                                </span>
                                            </span>
                                        </li> -->
                                        @foreach($model->productProperties as $productProperty)
                                            @if($productProperty->property_name_slug != 'razmer' && $productProperty->property_name_slug != 'cvet')
                                                <li>
                                                    {{ $productProperty->name }}: {{ $productProperty->value }}
                                                </li>
                                            @endif
                                        @endforeach
                                        <!-- <li>Артикул: {{ $model->product->vendor_code }}</li> -->
                                    </ul>
                                </div>

                                <div class="prod-attributes">
                                    <ul class="choose-clr list-inline border-hover">
                                        <div class="prod-color_title">
                                            {{ trans('email.color') }} : <span v-cloak>@{{ singleProduct.product.color.name }}</span>
                                        </div>
                                        @foreach($relatedProducts as $relatedProduct)
                                            @if($relatedProduct->is_visible == 1)
                                                <li>
                                                    @if($model->product->color->id == $relatedProduct->color->id)
                                                        <a class="active ttip"
                                                           title="{{ $relatedProduct->color->name }}"
                                                           href="{{ url_product($relatedProduct->slug, $model->language) }}"
                                                           style="background-color: {{ $relatedProduct->color->html_code }}"></a>
                                                    @else
                                                        <a href="{{ url_product($relatedProduct->slug, $model->language) }}"
                                                           class="ttip"
                                                           title="{{ $relatedProduct->color->name }}"
                                                           style="background-color: {{ $relatedProduct->color->html_code }}"></a>
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <ul class="choose-size list-inline border-hover">
                                        <div class="prod-size_title">
                                           {{ trans('email.size') }} :
                                            <span v-for="size in singleProduct.product.sizes" v-if="size.id == singleProduct.sizeId" v-cloak>
                                                @{{ size.name }}
                                            </span>
                                            @if($model->product->picture_size)
                                                <a class=" size-table-btn pull-right"
                                                   id="button-product-size"
                                                   data-toggle="modal"
                                                   data-target="#product-size">
                                                    Таблица размеров
                                                </a>
                                            @endif
                                        </div>
                                        @php($isAnyProductSizeActive = false)
                                        @foreach($model->product->sizes as $size)
                                            @php($isProductSizeActive = true)
                                            @php($productSize = $model->product->product_sizes->where('size_id', $size->id)->first())
                                            @if(!$productSize || $productSize->stocks->count() == 0 || $productSize->stocks->first()->stock == 0)
                                                @php($isProductSizeActive = false)
                                            @endif
                                            <li data-product-id="{{ $model->product->id }}">
                                                @if($isProductSizeActive && !$isAnyProductSizeActive)
                                                    <a href="#"
                                                       data-product-size-active
                                                       data-product-size-id="{{ $size->id }}"
                                                       v-on:click.prevent="changeSizeId('{{ $size->id }}')"
                                                       :class="{active : singleProduct.sizeId == {{$size->id}}}">
                                                        {{ $size->name }}
                                                    </a>
                                                    @php($isAnyProductSizeActive = true)
                                                @else
                                                    <a href="#"
                                                       v-on:click.prevent="changeSizeId('{{ $size->id }}')"
                                                       :class="{active : singleProduct.sizeId == {{$size->id}}}">
                                                        {{ $size->name }}
                                                    </a>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="product-present">
                                        <span v-cloak v-for="productSize in singleProduct.product.product_sizes"
                                                     v-if="productSize.size_id == singleProduct.sizeId">
                                            <span v-if="productSize.stocks[0].stock > 0" class="product-in-stock">
                                                {{ trans('product.product_in_stock') }}
                                            </span>
                                            <span v-else class="product-not-in-stock">
                                                {{ trans('product.product_not_in_stock') }}
                                            </span>
                                        </span>
                                    </div>
                                    <ul class="prod-btns prod-meta">
                                        <li>
                                            <div class="quantity">
                                                <button class="btn minus" v-on:click="decrement()">-</button>
                                                <input class="form-control qty"
                                                       type="number"
                                                       name="quantity"
                                                       v-model.number="singleProduct.count"
                                                       v-on:change="toInteger(singleProduct.count)"
                                                       title="{{ trans('cart.qty') }}">
                                                <button class="btn plus" v-on:click="increment()">+</button>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="theme-btn btn-black small-btn"
                                               @click.prevent="addToCart(singleProduct.productId, singleProduct.sizeId, singleProduct.count)"
                                               href="#">
                                                <span v-cloak v-if=" ! singleProduct.inStock">
                                                        {{ trans('layout.notify') }}
                                                </span>
                                                <span v-cloak
                                                      v-else-if="!findWhere(cartItems, {'productId': singleProduct.productId, 'sizeId': singleProduct.sizeId})">
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
                                                   v-if="!findWhere(wishListItems, {'productId': singleProduct.productId, 'sizeId': singleProduct.sizeId})"
                                                   class="fa fa-heart meta-icon"
                                                   v-on:click.prevent="addToWishList(singleProduct.productId, singleProduct.sizeId, wishList.id)"
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
                    </div>

                    <!-- Products Description Tabination Starts -->
                    <div class="tabs-wrap product_tabs-wrap" id="single-product-review" v-cloak>
                        <div class="tabs">
                            <ul id="tabs" class="nav font-2 theme-tabs">
                                <li class="active"><a href="#prod-tab-1" data-toggle="tab">{{ trans('product.description') }}</a></li>
                                <li class=""><a href="#prod-tab-2" data-toggle="tab">{{ trans('product.reviews') }} (@{{ totalReviewsCount }})</a></li>
                            </ul>
                        </div>
                        <div class="tab-content prod-tab-content">
                            <div id="prod-tab-1" class="tab-pane fade in active">
                                {!! $model->product->description !!}
                            </div>
                            <div id="prod-tab-2" class="tab-pane fade">
                                <div class="comment-count">
                                    <a v-if="totalReviewsCount >= 3"
                                       href="#"
                                       v-on:click.prevent="scrollToReview()"
                                       class="font-2">
                                        {{ trans('product.leave_review') }}
                                    </a>
                                    <p class="font-2">{{ trans('product.total_reviews') }} :
                                        <span>@{{ totalReviewsCount }}</span>
                                    </p>
                                </div>
                                <div class="comments-list">
                                    <div class="comment-item" v-if="totalReviewsCount > 0" v-for="review in reviews">
                                        <div class="comment-item-header">
                                            <div class="date-comment">
                                                <p class="font-2">
                                                    @{{ review.created_at }}
                                                </p>
                                            </div>
                                            <div class="comment-user-name">
                                                <p class="font-2"><i class="fa fa-comments fa-lg" aria-hidden="true"></i>
                                                    @{{ review.name }}
                                                </p>
                                            </div>
                                            <div class="comment-user-stars">
                                                <div class="rating">
                                                    <span class="star" v-for="rate in 5" :class="{active: rate <= review.rating}">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-item-body">
                                            <p>@{{ review.review }}</p>
                                        </div>
                                    </div>


                                    <div class="block-inline pagination-wrap text-center" v-cloak v-if="totalReviewsCount > 5">
                                        <ul class="pagination-1">
                                            <li v-if="reviewIsPrev" class="prv">
                                                <a class="disabled"
                                                   style="cursor: pointer;"
                                                   v-on:click="setPage(reviewsCurrentPage - 1)">
                                                    <i class="fa fa-long-arrow-left"></i>
                                                </a>
                                            </li>
                                            <li v-else class="prv">
                                                <a>
                                                    <i class="fa fa-long-arrow-left"></i>
                                                </a>
                                            </li>

                                            <li v-for="reviewPage in reviewsPages">
                                                <a v-if="reviewPage == '...'">
                                                    @{{ reviewPage }}
                                                </a>
                                                <a v-else style="cursor: pointer;"
                                                   :class="{active : reviewPage == reviewsCurrentPage}"
                                                   v-on:click="setPage(reviewPage)">
                                                    @{{ reviewPage }}
                                                </a>
                                            </li>


                                            <li v-if="reviewIsNext" class="nxt">
                                                <a class="disabled"
                                                   style="cursor: pointer;"
                                                   v-on:click="setPage(reviewsCurrentPage + 1)">
                                                    <i class="fa fa-long-arrow-right"></i>
                                                </a>
                                            </li>
                                            <li v-else class="prv">
                                                <a>
                                                    <i class="fa fa-long-arrow-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>



                                    <div class="profile-item add-comment">
                                        <div class="profile-item-header add-comment-header">
                                            <span><i class="fa fa-comments fa-lg" aria-hidden="true"></i></span>
                                            {{ trans('product.leave_review') }}
                                        </div>
                                        <div class="profile-item-body add-comment-body" data-review-form>
                                            <form @submit.prevent="validateBeforeSubmit">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text"
                                                                   data-review-name
                                                                   v-model="review.name"
                                                                   placeholder="{{ trans('product.name') }}"
                                                                   class="form-control black-input">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text"
                                                                   data-review-email
                                                                   v-model="review.email"
                                                                   placeholder="{{ trans('product.email') }}"
                                                                   class="form-control black-input">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="add-comment-rang">
                                                                <p class="font-2">{{ trans('product.rating') }} : </p>
                                                                <div class="rating">
                                                                    <span class="star"
                                                                          v-on:mouseover="hoverStars(1)"
                                                                          v-on:mouseleave="mouseLeave()"
                                                                          v-on:click="clickStars(1)"
                                                                          :class="{active: review.hoverRating >= 1 || review.rating >= 1}"></span>
                                                                    <span class="star"
                                                                          v-on:mouseover="hoverStars(2)"
                                                                          v-on:mouseleave="mouseLeave()"
                                                                          v-on:click="clickStars(2)"
                                                                          :class="{active: review.hoverRating >= 2 || review.rating >= 2}"></span>
                                                                    <span class="star"
                                                                          v-on:mouseover="hoverStars(3)"
                                                                          v-on:mouseleave="mouseLeave()"
                                                                          v-on:click="clickStars(3)"
                                                                          :class="{active: review.hoverRating >= 3 || review.rating >= 3}"></span>
                                                                    <span class="star"
                                                                          v-on:mouseover="hoverStars(4)"
                                                                          v-on:mouseleave="mouseLeave()"
                                                                          v-on:click="clickStars(4)"
                                                                          :class="{active: review.hoverRating >= 4 || review.rating >= 4}"></span>
                                                                    <span class="star"
                                                                          v-on:mouseover="hoverStars(5)"
                                                                          v-on:mouseleave="mouseLeave()"
                                                                          v-on:click="clickStars(5)"
                                                                          :class="{active: review.hoverRating >= 5 || review.rating >= 5}"></span>
                                                                </div>
                                                                <p v-if="review.validatedFalse"
                                                                   class="font-2" style="color: red;">
                                                                    {{ trans('product.pls_rate') }}
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea type="text"
                                                                      data-review-text
                                                                      v-model="review.text"
                                                                      placeholder="{{ trans('product.review') }}"
                                                                      class="form-control black-input"></textarea>
                                                        </div>
                                                    </div>


                                                    <div class="profile-item-save">
                                                        <button class="theme-btn btn-black" type="submit">
                                                            {{ trans('product.leave_review') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Products Description Tabination Ends -->

                    <!-- Related Products Starts -->
                    @include('partial.product-page.similar-products')
                    <!-- Related Products Ends -->

                </aside>
                <div class="visible-xs pt-70"></div>
                <!-- Product Details Ends -->

            </div>
        </div>
        <!-- / Page Ends -->

    </article>

    <!-- Modal -->
    <div id="product-size" class="modal fade pop-up-messege" role="dialog" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" data-notify-close>&times;</button>
                        <h4 class="modal-title">{{ trans('product.table') }}</h4>
                    </div>
                    <img src="{{ $model->product->picture_size }}" alt="{{ $model->product->name }}">
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="theme-btn btn-white small-btn">
                            {{ trans('product.close_table') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection