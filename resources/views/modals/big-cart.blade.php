<!-- Modal -->
<div class="modal fade big-cart" role="dialog" id="big-cart" tabindex="-1">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Корзина</h4>
            </div>
            <div class="modal-body">

                <div class="big-cart-item" v-for="cartItem in cartItems">
                    <div class="row flex-section-item">
                        <div class="col-md-2">
                            <div class="big-cart_img">
                                <a v-bind:href="'/product/' + cartItem.product.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'">
                                    <img v-bind:src="cartItem.product.images[0].small" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="big-cart_productInfo">
                                <div class="productInfo-name">
                                    <a v-bind:href="'/product/' + cartItem.product.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'">
                                        @{{ cartItem.product.name }}
                                    </a>
                                </div>
                                <div class="productInfo-size-color">
                                    <ul class="choose-clr list-inline border-hover">
                                        <li>
                                            <a class="active"
                                               :style="{'background-color': '' + cartItem.product.color.html_code + ''}">
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="choose-size list-inline border-hover">
                                        <li>
                                            <a class="active">
                                                <span v-for="size in cartItem.product.sizes" v-if="size.id == cartItem.sizeId">
                                                    @{{ size.name }}
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="productInfo-price">
                                    <span>@{{ cartItem.product.price[0].price }}</span> грн
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 flex-item">
                            <div class="big-cart_count">
                                <div class="quantity">
                                    <button class="btn minus" v-on:click="decrement(cartItem.productId, cartItem.sizeId)">-</button>
                                    <input type="number"
                                           v-model.number="cartItem.count"
                                           v-on:change="toInteger(cartItem.productId, cartItem.sizeId, cartItem.count)"
                                           name="quantity"
                                           title="Количество" class="form-control qty">
                                    <button class="btn plus" v-on:click="increment(cartItem.productId, cartItem.sizeId)">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 flex-item">
                            <div class="big-cart-total-price">
                                <span>
                                    @{{ (cartItem.product.price[0].price * cartItem.count).toFixed(2) }}
                                </span> грн
                            </div>
                        </div>
                        <div class="col-md-1 flex-item">
                            <div class="big-cart_delete">
                                <a href="javascript:void(0);"
                                    v-on:click="deleteFromCart(cartItem.productId, cartItem.sizeId)">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-6 footer-left">
                        <div class="cart-total-count">
                            Всего: <span>@{{ totalCount }}</span>
                        </div>
                        <a data-dismiss="modal" class="theme-btn btn-white small-btn">
                            Продолжить покупки
                        </a>
                    </div>
                    <div class="col-md-6 footer-right">
                        <div class="cart-total-all-price">
                            Сумма: <span>@{{ totalAmount.toFixed(2) }} грн</span>
                        </div>
                        <a href="{{ url_order($model->language) }}" class="theme-btn btn-white small-btn">
                            Оформить заказ
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>