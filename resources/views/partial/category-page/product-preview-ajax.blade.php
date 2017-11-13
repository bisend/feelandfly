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
                <div class="owl-carousel sync1 pb-25">
                    @foreach($product->images as $image)
                        <div class="item">
                            <img src="{{ $image->big }}" alt="{{ $product->name }}">
                            <a href="{{ $image->big }}"
                               rel="prettyPhoto[category-{{ $product->id }}]"
                               title="{{ $product->name }}"
                               data-pretty-photo-show="{{ $product->id }}"
                               class="caption-link meta-icon">
                                <i class="fa fa-arrows-alt"></i>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="owl-carousel single-prod-thumb sync2 nav-2">
                    @foreach($product->images as $image)
                        <div class="item">
                            <img src="{{ $image->big }}" alt="{{ $product->name }}">
                            <span class="transparent">
                                <img src="/img/template/icons/plus.png" alt="view">
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Single Products Slider Ends -->
            <div class="ptb-40 clearfix visible-sm visible-xs"></div>
            <!-- Products Description Starts -->
            <div class="col-md-7 col-sm-12">
                <div class="prod-details">
                    <div class="prod-title">{{ $product->name }}</div>
                    <div class="block-inline">
                        <div class="rating pull-right">
                            @for($i = 1; $i <= 5; $i++)
                                @if($product->rating != null)
                                    @if($i <= $product->rating)
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
                            <ins>550.00 грн</ins>
                        </div>
                    </div>
                    <div class="discriptions pt-20">
                        <ul>
                            <li>Материал: Полиэстер с водоотталкивающей и полиуретановой пропиткой для терморегуляции, удерживает влагу 1000 мм/вод.ст;</li>
                            <li>Полиэстеровая 210 г/м2 сверхлегкая фирменная принтованная подкладка;</li>
                            <li>Металлические нержавеющие молнии;</li>
                            <li>Два боковых, один внутренний, один карман на молнии на плече;</li>
                            <li>Сверху и снизу расположена трикотажная резинка с компонентом эластана, что позволяет резинке не терять с временем форму и не закатываться;</li>
                            <li>На бомбере расположены три вышитых патча;</li>
                            <li>Весенний / Летний сезон.</li>
                        </ul>
                    </div>
                    <div class="prod-attributes">
                        <ul class="choose-clr list-inline border-hover">
                            <li> <a href="#" class="black-bg"></a> </li>
                            <li> <a href="#" class="gray-bg"></a> </li>
                            <li> <a href="#" class="red-bg"></a> </li>
                            <li> <a href="#" class="yellow-bg active"></a> </li>
                            <li> <a href="#" class="brown-bg"></a> </li>
                        </ul>
                        <ul class="choose-size list-inline border-hover">
                            <li> <a href="#"> S </a> </li>
                            <li> <a href="#" class="active"> M </a> </li>
                            <li> <a href="#"> L </a> </li>
                            <li> <a href="#"> XL </a> </li>
                            <li> <a href="#"> XXL </a> </li>
                        </ul>
                        <ul class="prod-btns prod-meta">
                            <li>
                                <div class="quantity">
                                    <button class="btn minus">-</button>
                                    <input type="number" class="form-control qty" name="quantity" value="1" title="Qty">
                                    <button class="btn plus">+</button>
                                </div>
                            </li>
                            <li> <a class="theme-btn btn-black small-btn" href="#"> Добавить в корзину </a> </li>
                            <li> <a class="fa fa-heart meta-icon" href="#"></a> </li>

                        </ul>
                    </div>
                </div>
            </div>
            <!-- Products Description Ends -->
        </div>
    </div>
</div>