@if($model->similarProducts && !is_null($model->similarProducts) && $model->similarProducts->count() > 0)
<div class="block-inline pt-15 similar_prod-section" id="similar-product">

    {{--SIMILAR PRODUCT PREVIEW--}}
    <div id="similar-product-preview">
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
                                <div class="item" v-for="image in similarProductPreview.product.images">
                                    <img v-bind:src="image.big">

                                    <div v-if="similarProductPreview.product.promotions != null && similarProductPreview.product.promotions.length > 0 && similarProductPreview.product.promotions[0].id == 1"
                                         class="prod-tag-1 font-2">
                                        <span> -@{{ similarProductPreview.product.price[0].discount }}% </span>
                                    </div>
                                    <div v-if="similarProductPreview.product.promotions != null && similarProductPreview.product.promotions.length > 0 && similarProductPreview.product.promotions[0].id == 2"
                                         class="prod-tag-1 font-2 prod-tag-green">
                                        <span> NEW </span>
                                    </div>
                                    <div v-if="similarProductPreview.product.promotions != null && similarProductPreview.product.promotions.length > 0 && similarProductPreview.product.promotions[0].id == 3"
                                         class="prod-tag-1 font-2 prod-tag-violet">
                                        <span> TOP </span>
                                    </div>

                                    <a v-bind:href="image.original"
                                       v-bind:rel="similarProductPreview.rel"
                                       v-bind:title="similarProductPreview.product.name"
                                       class="caption-link meta-icon">
                                        <i class="fa fa-arrows-alt"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="owl-carousel single-prod-thumb sync2 nav-2 product-preview-images-small">
                                <div class="item" v-for="image in similarProductPreview.product.images">
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
                                <div class="prod-title">@{{ similarProductPreview.product.name }}</div>
                                <div class="block-inline">
                                    <div class="rating pull-right">
                                        <span v-for="i in 5" v-if="i <= similarProductPreview.product.rating" class="star active"></span>
                                        <span v-else class="star"></span>
                                    </div>
                                    <div class="prod-price font-2 pull-left fsz-16">
                                        <ins>@{{ similarProductPreview.product.price[0].price }} грн</ins>

                                        <del v-if="similarProductPreview.product.promotions != null && similarProductPreview.product.promotions.length > 0 && similarProductPreview.product.promotions[0].id == 1">
                                            @{{ similarProductPreview.product.price[0].old_price }} грн
                                        </del>

                                    </div>
                                </div>
                                <div class="discriptions pt-20">
                                    <ul>
                                        <li>{{ trans('product.stock') }}:
                                            <span v-cloak v-for="productSize in similarProductPreview.product.product_sizes"
                                                  v-if="productSize.size_id == similarProductPreview.currentSizeId">
                                                @{{ productSize.stocks[0].stock }}
                                            </span>
                                        </li>
                                        <li v-for="property in similarProductPreview.product.properties" v-if="property.slug != 'razmer'">
                                            @{{ property.property_name }}: @{{ property.property_value }}
                                        </li>
                                        <li>Артикул: @{{ similarProductPreview.product.vendor_code }}</li>
                                    </ul>
                                </div>
                                <div class="prod-attributes">
                                    <ul class="choose-clr list-inline border-hover">
                                        <div class="prod-color_title">
                                            {{ trans('email.color') }} : <span v-cloak>@{{ similarProductPreview.product.color.name }}</span>
                                        </div>
                                        <li v-for="relatedProduct in similarProductPreview.product.product_group.products">
                                            <a v-if="relatedProduct.color.id === similarProductPreview.product.color.id"
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
                                            <span v-for="size in similarProductPreview.product.sizes" v-if="size.id == similarProductPreview.currentSizeId" v-cloak>
                                                @{{ size.name }}
                                            </span>
                                        </div>
                                        <li v-for="(size, index) in similarProductPreview.product.sizes">
                                            <a v-on:click.prevent="changeCurrentSizeId(size.id)"
                                                :class="{active : similarProductPreview.currentSizeId == size.id}"
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
                                                       v-model.number="similarProductPreview.count"
                                                       v-on:change="toInteger(similarProductPreview.count)"
                                                       class="form-control qty"
                                                       title="Количество">
                                                <button class="btn plus" v-on:click="increment()">+</button>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="theme-btn btn-black small-btn"
                                               v-on:click.prevent="addToCart(similarProductPreview.product.id, similarProductPreview.currentSizeId, similarProductPreview.count)"
                                               href="#">
                                                    <span v-cloak
                                                          v-if="!findWhere(cartItems, {'productId': similarProductPreview.product.id, 'sizeId': similarProductPreview.currentSizeId})">
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
                                                   v-if="!findWhere(wishListItems, {'productId': similarProductPreview.product.id, 'sizeId': similarProductPreview.currentSizeId})"
                                                   class="fa fa-heart meta-icon"
                                                   v-on:click.prevent="addToWishList(similarProductPreview.product.id, similarProductPreview.currentSizeId, wishList.id)"
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
    {{--SIMILAR PRODUCT PREVIEW--}}


    <h2 class="section-title">{{ trans('product.similar_products') }}</h2>
    <div id="rel-prod-slider" class="rel-prod-slider nav-1 padding-own">
        @php($counter = 0)
        @foreach($model->similarProducts as $similarProduct)
            <div class="item similar_products">
                <div class="prod-wrap pt-50">
                    <figure>
                        <div class="prod-img">
                            <a class="img-hover" href="{{ url_product($similarProduct->slug, $model->language) }}">
                                <img alt="{{ $similarProduct->name }}" src="{{ $similarProduct->images[0]->big }}">

                                @if($similarProduct->promotions != null && $similarProduct->promotions->count() > 0)
                                    @if($similarProduct->promotions[0]->id == 1)
                                        <div class="prod-tag-1 font-2">
                                            <span> -{{ $similarProduct->price[0]->discount }}% </span>
                                        </div>
                                    @endif
                                    @if($similarProduct->promotions[0]->id == 2)
                                        <div class="prod-tag-1 font-2 prod-tag-green">
                                            <span> NEW </span>
                                        </div>
                                    @endif
                                    @if($similarProduct->promotions[0]->id == 3)
                                        <div class="prod-tag-1 font-2 prod-tag-violet">
                                            <span> TOP </span>
                                        </div>
                                    @endif
                                @endif

                            </a>
                            <a class="caption-link meta-icon"
                               href="#"
                               v-on:click.prevent="changeSimilarProductPreview({{$counter}})">
                                <span class="fa fa-eye"></span>
                            </a>
                        </div>
                        <figcaption class="prod-content">
                            <h2 class="prod-title">
                                <a href="{{ url_product($similarProduct->slug, $model->language) }}">
                                    {{ $similarProduct->name }}
                                </a>
                            </h2>
                            <div class="block-inline">
                                <div class="rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($similarProduct->rating != null)
                                            @if($i <= $similarProduct->rating)
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
                                    <ins>{{ $similarProduct->price[0]->price }} грн</ins>

                                    @if($similarProduct->promotions != null && $similarProduct->promotions->count() > 0)
                                        @if($similarProduct->promotions[0]->pivot->promotion_id == 1)
                                            <del>{{ $similarProduct->price[0]->old_price }} грн</del>
                                        @endif
                                    @endif

                                </div>
                            </div>
                            <div class="block-inline">
                                <ul class="prod-meta">
                                    <li>
                                        <a class="theme-btn btn-black min-width-270-px" href="{{ url_product($similarProduct->slug, $model->language) }}">
                                            {{ trans('product.more_info') }}
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