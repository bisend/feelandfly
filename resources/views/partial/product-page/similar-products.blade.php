<div class="block-inline pt-15 similar_prod-section">
    <h2 class="section-title"> Похожие Товары </h2>
    <div id="rel-prod-slider" class="rel-prod-slider nav-1 padding-own">
        @foreach($model->similarProducts as $similarProduct)
            <div class="item similar_products">
                <div class="prod-wrap pt-50">
                    <figure>
                        <div class="prod-img">
                            <a class="img-hover" href="{{ url_product($similarProduct->slug, $model->language) }}">
                                <img alt="{{ $similarProduct->name }}" src="{{ $similarProduct->images[0]->big }}">
                            </a>
                            {{--<div class="prod-tag-1 font-2">--}}
                                {{--<span> -50% </span>--}}
                            {{--</div>--}}
                            <a class="caption-link meta-icon" data-toggle="modal" href="#prod-preview">
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
                                            <span class="star active"></span>
                                        @endif
                                    @endfor
                                </div>
                                <div class="prod-price font-2">
                                    <ins>{{ $similarProduct->price[0]->price }} грн</ins>
                                </div>
                            </div>
                            <div class="block-inline">
                                <ul class="prod-meta">
                                    <li>
                                        <a class="theme-btn btn-black" href="#">
                                            Добавить в корзину
                                        </a>
                                    </li>
                                    <li>
                                        <a class="fa fa-heart meta-icon" href="#"></a>
                                    </li>
                                </ul>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </div>
        @endforeach



        {{--<div class="item similar_products">--}}
        {{--<div class="prod-wrap pt-50">--}}
        {{--<figure>--}}
        {{--<div class="prod-img">--}}
        {{--<a class="img-hover" href="#"> <img alt="product" src="/img/template/product/category-1/2.jpg"> </a>--}}
        {{--<div class="prod-tag-1 font-2"> <span> -50% </span> </div>--}}
        {{--<a class="caption-link meta-icon" data-toggle="modal" href="#prod-preview"> <span class="fa fa-eye"> </span> </a>--}}
        {{--</div>--}}
        {{--<figcaption class="prod-content">--}}
        {{--<h2 class="prod-title"> <a href="product-detail.htm"> КУРТКА FEEL&FLY PRADO BLACK </a> </h2>--}}
        {{--<div class="block-inline">--}}
        {{--<div class="rating">--}}
        {{--<span class="star active"></span>--}}
        {{--<span class="star active"></span>--}}
        {{--<span class="star active"></span>--}}
        {{--<span class="star"></span>--}}
        {{--<span class="star"></span>--}}
        {{--</div>--}}
        {{--<div class="prod-price font-2">--}}
        {{--<ins>580.00 грн</ins> <del>760.00 грн</del>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="block-inline">--}}
        {{--<ul class="prod-meta">--}}
        {{--<li> <a class="theme-btn btn-black" href="#"> подробнее </a> </li>--}}
        {{--<li> <a class="fa fa-heart meta-icon" href="#"></a> </li>--}}
        {{--</ul>--}}
        {{--</div>--}}
        {{--</figcaption>--}}
        {{--</figure>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="item similar_products">--}}
        {{--<div class="prod-wrap pt-50">--}}
        {{--<figure>--}}
        {{--<div class="prod-img">--}}
        {{--<a class="img-hover" href="#"> <img alt="product" src="/img/template/product/category-1/3.jpg"> </a>--}}
        {{--<a class="caption-link meta-icon" data-toggle="modal" href="#prod-preview"> <span class="fa fa-eye"> </span> </a>--}}
        {{--</div>--}}
        {{--<figcaption class="prod-content">--}}
        {{--<h2 class="prod-title"> <a href="product-detail.htm"> КУРТКА FEEL&FLY PRADO BLACK </a> </h2>--}}
        {{--<div class="block-inline">--}}
        {{--<div class="rating">--}}
        {{--<span class="star active"></span>--}}
        {{--<span class="star active"></span>--}}
        {{--<span class="star active"></span>--}}
        {{--<span class="star"></span>--}}
        {{--<span class="star"></span>--}}
        {{--</div>--}}
        {{--<div class="prod-price font-2">--}}
        {{--<ins>580.00 грн</ins> <del>760.00 грн</del>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="block-inline">--}}
        {{--<ul class="prod-meta">--}}
        {{--<li> <a class="theme-btn btn-black" href="#"> подробнее </a> </li>--}}
        {{--<li> <a class="fa fa-heart meta-icon" href="#"></a> </li>--}}
        {{--</ul>--}}
        {{--</div>--}}
        {{--</figcaption>--}}
        {{--</figure>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="item similar_products">--}}
        {{--<div class="prod-wrap pt-50">--}}
        {{--<figure>--}}
        {{--<div class="prod-img">--}}
        {{--<a class="img-hover" href="#"> <img alt="product" src="/img/template/product/category-1/6.jpg"> </a>--}}
        {{--<div class="prod-tag-1 font-2"> <span> -50% </span> </div>--}}
        {{--<a class="caption-link meta-icon" data-toggle="modal" href="#prod-preview"> <span class="fa fa-eye"> </span> </a>--}}
        {{--</div>--}}
        {{--<figcaption class="prod-content">--}}
        {{--<h2 class="prod-title"> <a href="product-detail.htm"> БОМБЕР FEEL&FLY LITE BLACK </a> </h2>--}}
        {{--<div class="block-inline">--}}
        {{--<div class="rating">--}}
        {{--<span class="star active"></span>--}}
        {{--<span class="star active"></span>--}}
        {{--<span class="star active"></span>--}}
        {{--<span class="star"></span>--}}
        {{--<span class="star"></span>--}}
        {{--</div>--}}
        {{--<div class="prod-price font-2">--}}
        {{--<ins>580.00 грн</ins>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="block-inline">--}}
        {{--<ul class="prod-meta">--}}
        {{--<li> <a class="theme-btn btn-black" href="#"> подробнее </a> </li>--}}
        {{--<li> <a class="fa fa-heart meta-icon" href="#"></a> </li>--}}
        {{--</ul>--}}
        {{--</div>--}}
        {{--</figcaption>--}}
        {{--</figure>--}}
        {{--</div>--}}
        {{--</div>--}}
    </div>
</div>