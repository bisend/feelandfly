@extends('layout')

@section('content')
    <!-- CONTENT AREA -->
    <article id="order-confirm" class="margin-after-header">

        <!--Breadcrumb Section Start-->
        <section class="breadcrumb-bg">
            <div class="theme-container container ">
                <div class="site-breadcumb white-clr no-flex-title">

                    <!--<div class="edit-order">-->
                    <!--<a class="theme-btn btn-black" href="#"> Замовити </a>-->
                    <!--</div>-->

                    <div class="edit-order-btn">
                        <a class="theme-btn btn-black" href="javascript:void(0);" data-target="#big-cart" data-toggle="modal">
                            {{ trans('order.edit_order') }}
                        </a>
                    </div>

                    <h2 class="section-title wht fsz-36"> {{ trans('order.order_confirm') }} </h2>
                    <ol class="breadcrumb breadcrumb-menubar">
                        <li> <a href="{{ url_home($model->language) }}"> {{ trans('profile.home') }} </a> {{ trans('order.order_confirm') }} </li>
                    </ol>
                </div>
            </div>
        </section>
        <!--Breadcrumb Section End-->

        <!-- Page Starts-->
        <div class="container theme-container ptb-70">
            <div class="row">


                <!-- Product Details Starts-->
                <aside class="col-md-7 col-sm-12">
                    <form @submit.prevent="validateBeforeSubmit">

                        <div class="profile-item">
                            <div class="profile-item-header">
                                <span><i class="fa fa-user" aria-hidden="true"></i></span> {{ trans('order.contact_data') }}
                            </div>
                            <div class="profile-item-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text"
                                                   data-order-name
                                                   v-model="orderConfirm.name"
                                                   placeholder="{{ trans('order.enter_name') }}"
                                                   class="form-control black-input">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text"
                                                   data-order-phone
                                                   v-model="orderConfirm.phone"
                                                   placeholder="{{ trans('order.enter_phone') }}"
                                                   class="form-control black-input">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text"
                                                   data-order-email
                                                   v-model="orderConfirm.email"
                                                   placeholder="{{ trans('order.enter_email') }}"
                                                   class="form-control black-input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="profile-item order-dev">
                            <div class="profile-item-header">
                                <span><i class="fa fa-truck" aria-hidden="true"></i></span>{{ trans('order.payment_delivery') }}
                            </div>
                            <div class="profile-item-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="drop-menu-select" tabindex="1" data-order-payment style="color: rgb(85, 85, 85); font-weight: 500;">
                                            <div class="select">
                                                @if($model->profile != null && $model->profile->payment_id != null)
                                                    @foreach($model->payments as $payment)
                                                        @if($model->profile->payment_id == $payment->id)
                                                            <span>{{ $payment->name }}</span>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <span>{{ trans('order.choose_payment') }}</span>
                                                @endif
                                                <i class="fa fa-caret-down"></i>
                                            </div>
                                            <input type="hidden" name="gender">
                                            <ul class="dropeddown" style="display: none;">
                                                @foreach($model->payments as $payment)
                                                    <li v-on:click="setPaymentId({{$payment->id}})">{{ $payment->name }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="drop-menu-select" tabindex="1" data-order-delivery style="color: rgb(85, 85, 85); font-weight: 500;">
                                            <div class="select">
                                                @if($model->profile != null && $model->profile->delivery_id != null)
                                                    @foreach($model->deliveries as $delivery)
                                                        @if($model->profile->delivery_id == $delivery->id)
                                                            <span>{{ $delivery->name }}</span>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <span>{{ trans('order.choose_delivery') }}</span>
                                                @endif
                                                <i class="fa fa-caret-down"></i>
                                            </div>
                                            <input type="hidden" name="gender">
                                            <ul class="dropeddown" style="display: none;">
                                                @foreach($model->deliveries as $delivery)
                                                    <li v-on:click="setDeliveryId({{$delivery->id}})">{{ $delivery->name }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text"
                                                   data-order-address
                                                   v-model="orderConfirm.address"
                                                   placeholder="{{ trans('order.address') }}"
                                                   class="form-control black-input">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea type="text"
                                                      v-model="orderConfirm.comment"
                                                      placeholder="{{ trans('order.comment') }}"
                                                      class="form-control black-input"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="order-save-btn">
                            <button type="submit" class="theme-btn btn-black">{{ trans('order.confirm') }}</button>
                        </div>
                    </form>
                </aside>


                <div class="col-md-5 col-sm-12">
                    <div class="profile-item">
                        <div class="profile-item-header">
                            <span><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>{{ trans('order.your_order') }}
                        </div>
                        <div class="profile-item-body">
                            <div class="order-products">

                                <div v-cloak class="order-prod-item" v-for="cartItem in cartItems">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <div class="order-prod-img">
                                                <a v-bind:href="'/product/' + cartItem.product.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'">
                                                    <img v-bind:src="cartItem.product.images[0].small" alt="">
                                                </a>

                                                <div v-if="cartItem.product.promotions != null && cartItem.product.promotions.length > 0 && cartItem.product.promotions[0].id == 1"
                                                     class="prod-tag-1 font-2">
                                                    <span> -@{{ cartItem.product.price[0].discount }}% </span>
                                                </div>
                                                <div v-if="cartItem.product.promotions != null && cartItem.product.promotions.length > 0 && cartItem.product.promotions[0].id == 2"
                                                     class="prod-tag-1 font-2 prod-tag-green">
                                                    <span> NEW </span>
                                                </div>
                                                <div v-if="cartItem.product.promotions != null && cartItem.product.promotions.length > 0 && cartItem.product.promotions[0].id == 3"
                                                     class="prod-tag-1 font-2 prod-tag-violet">
                                                    <span> TOP </span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-8">
                                            <div class="order-detail-prod">

                                                <a class="prod-title block-inline" v-bind:href="'/product/' + cartItem.product.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'">
                                                    @{{ cartItem.product.name }}
                                                </a>
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
                                                <p class="fsz-16 font-2 no-margin prod-price">
                                                    <span class="fw-300 gray-clr">
                                                        <span>@{{ cartItem.count }}</span> <sub>X</sub>
                                                    </span> @{{ cartItem.product.price[0].price }} грн
                                                    <del v-if="cartItem.product.promotions != null && cartItem.product.promotions.length > 0 && cartItem.product.promotions[0].id == 1">
                                                        @{{ cartItem.product.price[0].old_price }} грн
                                                    </del>
                                                </p>
                                                <p class="fsz-16 font-2 no-margin order-prod-total">
                                                    {{ trans('order.sum') }}:<span>@{{ (cartItem.product.price[0].price * cartItem.count).toFixed(2) }} грн</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="order-total-price">
                                <p v-cloak class="fsz-18 font-2 no-margin order-prod-total">
                                    {{ trans('order.sum_order') }}:<span>@{{ totalAmount.toFixed(2) }} грн</span>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Product Details Ends -->



            </div>
        </div>
        <!-- / Page Ends -->


    </article>
    <!-- / CONTENT AREA -->
@endsection