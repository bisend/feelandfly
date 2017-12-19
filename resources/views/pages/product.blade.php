{{--@if(false)<html xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">@endif--}}
@extends('layout')

@section('content')
    @php($relatedProducts = $model->product->product_group->products)
{{--    {{ dd($relatedProducts) }}--}}
    <article>
        <!--Breadcrumb Section Start-->
        <section class="breadcrumb-bg">
            <div class="theme-container container ">
                <div class="site-breadcumb white-clr">
                    <ol class="breadcrumb breadcrumb-menubar">
                        <li>
                            <a href="{{ url_home($model->language) }}">
                                Главная
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
        <div class="container theme-container product_section">
            <div class="row">

                <!-- Product Details Starts-->
                <aside class="col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-7 col-sm-12 single-prod-slider sync-sliedr">
                            <!-- Single Products Slider Starts -->
                            <div class="owl-carousel sync1 pb-25 big-slider">
                                @foreach($model->product->images as $image)
                                    <div class="item">
                                        <img src="{{ $image->big }}" alt="{{ $model->product->name }}">
                                        <a href="{{ $image->original }}"
                                           rel="prettyPhoto[single-product]"
                                           {{--data-gal="prettyPhoto[prettyPhoto]"--}}
                                           title="{{ $model->product->name }}"
                                           class="caption-link meta-icon">
                                            <i class="fa fa-arrows-alt"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <div class="owl-carousel single-prod-thumb sync2 nav-2 item-smoll">
                                @foreach($model->product->images as $image)
                                    <div class="item">
                                        <img src="{{ $image->small }}" alt="product">
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
                                </div>
                                <div class="block-inline">
                                    <div class="rating pull-right">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($model->product->rating != null)
                                                @if($i <= $model->product->rating)
                                                    <span class="star active"></span>
                                                @else
                                                    <span class="star"></span>
                                                @endif
                                            @else
                                                <span class="star active"></span>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="prod-price font-2 pull-left fsz-16">
                                        <ins>{{ $model->product->price[0]->price }} грн</ins>
                                    </div>
                                </div>
                                <div class="discriptions pt-20">
                                    <ul>
                                        <li>Наличие:
                                            <span v-cloak v-for="productSize in singleProduct.product.product_sizes"
                                                  v-if="productSize.size_id == singleProduct.sizeId">
                                                {{--{{ $model->product->product_sizes[0]->stocks[0]->stock }}--}}
                                                @{{ productSize.stocks[0].stock }}
                                            </span>
                                        </li>
                                        @foreach($model->productProperties as $productProperty)
                                            @if($productProperty->property_name_slug != 'razmer' && $productProperty->property_name_slug != 'cvet')
                                                <li>
                                                    {{ $productProperty->name }}: {{ $productProperty->value }}
                                                </li>
                                            @endif
                                        @endforeach
                                        {{--<li>Материал: Полиэстер с водоотталкивающей и полиуретановой пропиткой--}}
                                            {{--для терморегуляции, удерживает влагу 1000 мм/вод.ст;</li>--}}
                                        {{--<li>Полиэстеровая 210 г/м2 сверхлегкая фирменная принтованная подкладка;</li>--}}
                                        {{--<li>Металлические нержавеющие молнии;</li>--}}
                                        {{--<li>Два боковых, один внутренний, один карман на молнии на плече;</li>--}}
                                        {{--<li>Сверху и снизу расположена трикотажная резинка с компонентом эластана,--}}
                                            {{--что позволяет резинке не терять с временем форму и не закатываться;</li>--}}
                                        {{--<li>На бомбере расположены три вышитых патча;</li>--}}
                                        {{--<li>Весенний / Летний сезон.</li>--}}
                                        <li>Артикул: {{ $model->product->vendor_code }}</li>
                                    </ul>
                                </div>
                                <div class="prod-attributes">
                                    <ul class="choose-clr list-inline border-hover">
                                        @foreach($relatedProducts as $relatedProduct)
                                            <li>
                                                @if($model->product->color->id == $relatedProduct->color->id)
                                                    <a class="active"
                                                       href="{{ url_product($relatedProduct->slug, $model->language) }}"
                                                       style="background-color: {{ $relatedProduct->color->html_code }}"></a>
                                                @else
                                                    <a href="{{ url_product($relatedProduct->slug, $model->language) }}"
                                                       style="background-color: {{ $relatedProduct->color->html_code }}"></a>
                                                @endif
                                            </li>
                                        @endforeach
                                        {{--<li> <a href="#" class="black-bg"></a> </li>--}}
                                        {{--<li> <a href="#" class="gray-bg"></a> </li>--}}
                                        {{--<li> <a href="#" class="red-bg"></a> </li>--}}
                                        {{--<li> <a href="#" class="yellow-bg active"></a> </li>--}}
                                        {{--<li> <a href="#" class="brown-bg"></a> </li>--}}
                                    </ul>
                                    <ul class="choose-size list-inline border-hover">
                                        @php($counterSize = 0)
                                        @foreach($model->product->sizes as $size)
                                            <li>
                                                @if($counterSize == 0)
                                                    <a href="javascript:void(0);"
                                                       v-on:click="changeSizeId('{{ $size->id }}')"
                                                       :class="{active : singleProduct.sizeId == {{$size->id}}}">
                                                        {{ $size->name }}
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0);"
                                                       v-on:click="changeSizeId('{{ $size->id }}')"
                                                       :class="{active : singleProduct.sizeId == {{$size->id}}}">
                                                        {{ $size->name }}
                                                    </a>
                                                @endif
                                            </li>
                                            @php($counterSize++)
                                        @endforeach
                                    </ul>
                                    <ul class="prod-btns prod-meta">
                                        <li>
                                            <div class="quantity">
                                                <button class="btn minus" v-on:click="decrement()">-</button>
                                                <input class="form-control qty"
                                                       type="number"
                                                       name="quantity"
                                                       v-model.number="singleProduct.count"
                                                       v-on:change="toInteger(singleProduct.count)"
                                                       title="Количество">
                                                <button class="btn plus" v-on:click="increment()">+</button>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="theme-btn btn-black small-btn"
                                               v-on:click="addToCart(singleProduct.productId, singleProduct.sizeId, singleProduct.count)"
                                               href="javascript:void(0);">
                                                <span v-cloak
                                                      v-if="!findWhere(cartItems, {'productId': singleProduct.productId, 'sizeId': singleProduct.sizeId})">
                                                    Добавить в корзину
                                                </span>
                                                <span v-cloak v-else>
                                                    В корзине
                                                </span>
                                            </a>

                                            {{--<a v-else--}}
                                               {{--class="theme-btn btn-black small-btn">--}}
                                                {{--В корзине--}}
                                            {{--</a>--}}
                                        </li>
                                        <li>
                                            @if(auth()->check())
                                                <a v-cloak
                                                   v-if="!findWhere(wishListItems, {'productId': singleProduct.productId, 'sizeId': singleProduct.sizeId})"
                                                   class="fa fa-heart meta-icon"
                                                   v-on:click="addToWishList(singleProduct.productId, singleProduct.sizeId, wishList.id)"
                                                   href="javascript:void(0);"></a>
                                                <a v-cloak v-else
                                                   class="fa fa-heart meta-icon meta-icon-in-wish"
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
                    </div>

                    <!-- Products Description Tabination Starts -->
                    <div class="tabs-wrap product_tabs-wrap">
                        <div class="tabs">
                            <ul id="tabs" class="nav font-2 theme-tabs">
                                <li class="active"><a href="#prod-tab-1" data-toggle="tab"> Описание </a></li>
                                <li class=""><a href="#prod-tab-2" data-toggle="tab"> Отзывы </a></li>
                            </ul>
                        </div>
                        <div class="tab-content prod-tab-content">
                            <div id="prod-tab-1" class="tab-pane fade in active">
                                {{ $model->product->description }}
                            </div>
                            <div id="prod-tab-2" class="tab-pane fade">
                                <p>
                                    Aliquam lorem ante, dapibus in, viverra quis,
                                    feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet.
                                    Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue.
                                    Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                                    Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                    sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel,
                                    luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus.
                                </p>
                                <p>
                                    Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                    Etiam sit amet orci eget eros faucibus tincidunt. amet nibh.
                                    Donec sodales sagittis magna. Augue velit cursus nunc, quis gravida.
                                </p>
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
@endsection