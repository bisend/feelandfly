@extends('layout')

@section('content')



    <!-- CONTENT AREA -->
    <article class="margin-after-header">

        <!--Breadcrumb Section Start-->
        <section class="breadcrumb-bg">
            <div class="theme-container container ">
                <div class="site-breadcumb white-clr breadcrumb-dis-block">
                    <h2 class="section-title wht fsz-36">{{ trans('profile.my_profile') }}</h2>
                    <ol class="breadcrumb breadcrumb-menubar">
                        <li>
                            <a href="{{ url_home($model->language) }}">
                                {{ trans('profile.home') }}
                            </a>
                            {{ trans('profile.my_orders') }}
                        </li>
                    </ol>
                </div>
            </div>
        </section>
        <!--Breadcrumb Section End-->

        <!-- Page Starts-->
        <div class="container theme-container ptb-70" id="profile-my-orders">

            <!-- Modal Order-details-->
            <div class="modal fade orderDetails-Modal"
                 id="orderDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" v-if="currentOrder != null">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title fsz-18 font-2" id="myModalLabel">
                                {{ trans('profile.details_order') }} <span>№@{{ currentOrder.order_number }}</span>
                            </h4>
                        </div>
                        <div class="modal-body">

                            <div class="order-prod-item" v-for="orderItem in currentOrder.orderItems">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4">
                                        <div class="order-prod-img">
                                            <a v-bind:href="'/product/' + orderItem.product.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'">
                                                <img v-bind:src="orderItem.product.images[0].small" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-8">
                                        <div class="order-detail-prod">

                                            <a class="prod-title block-inline"
                                               v-bind:href="'/product/' + orderItem.product.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'">
                                                @{{ orderItem.product.name }}
                                            </a>
                                            <div class="productInfo-size-color">
                                                <ul class="choose-clr list-inline border-hover">
                                                    <li>
                                                        <a class="active"
                                                           :style="{'background-color': '' + orderItem.product.color.html_code + ''}">
                                                        </a>
                                                    </li>
                                                </ul>
                                                <ul class="choose-size list-inline border-hover">
                                                    <li>
                                                        <a class="active">
                                                            <span v-for="size in orderItem.product.sizes" v-if="size.id == orderItem.sizeId">
                                                                @{{ size.name }}
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <p class="fsz-16 font-2 no-margin">
                                                <span class="fw-300 gray-clr">
                                                    @{{ orderItem.productCount }}
                                                    <sub>X</sub>
                                                </span> @{{ orderItem.price }} грн
                                            </p>
                                            <p class="fsz-16 font-2 no-margin order-prod-total">
                                                {{ trans('profile.sum') }}:<span>
                                                    @{{ (orderItem.price * orderItem.productCount).toFixed(2) }} грн
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="order-modal-detail">
                                <div class="modal-order-status">
                                    <p class="fsz-15 font-2 no-margin">
                                        Статус: <span class="fsz-17">@{{ currentOrder.status.name }}</span>
                                    </p>
                                </div>

                                <div class="modal-order-pay">
                                    <p class="fsz-15 font-2 no-margin">
                                        {{ trans('profile.payment_var') }}:
                                        <span class="fsz-17">
                                            {{ trans('order.full_pre_payment') }}
                                        </span>
                                    </p>
                                </div>

                                <div class="modal-order-del">
                                    <p class="fsz-15 font-2 no-margin">
                                        {{ trans('profile.delivery_var') }}: <span class="fsz-17"
                                                               v-for="delivery in deliveries"
                                                               v-if="delivery.id == currentOrder.delivery_id">
                                                       @{{ delivery.name }}</span>
                                    </p>
                                </div>

                                <div class="modal-order-total-summ">
                                    <p class="fsz-15 font-2 no-margin">
                                        {{ trans('profile.sum') }}: <span class="fsz-17">@{{ currentOrder.total_order_amount }} грн</span>
                                    </p>
                                </div>

                            </div>


                        </div>
                        <div class="modal-footer">
                            <a class="theme-btn btn-black" data-dismiss="modal" href="#">{{ trans('profile.close') }}</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <!-- Sidebar Starts -->
                <aside class="col-md-3 col-sm-4 sidebar">
                    <div class="widget-wrap">
                        <h2 class="widget-title title-profile-bar">{{ trans('profile.my_profile') }}</h2>
                        <ul class="account-list with-border">
                            <li><a href="{{ url_personal_info($model->language) }}">{{ trans('profile.personal_info') }}</a></li>
                            <li><a href="{{ url_payment_delivery($model->language) }}">{{ trans('profile.payment_delivery') }}</a></li>
                            <li><a href="{{ url_wish_list($model->language) }}">{{ trans('profile.wish_list') }}</a></li>
                            <li><a href="javascript:void(0);" style="color: #000;">{{ trans('profile.my_orders') }}</a></li>
                            <li><a href="/user/logout">{{ trans('profile.log_out') }}</a></li>
                        </ul>
                    </div>
                </aside>
                <!-- Sidebar Ends -->

                <div class="visible-xs pt-70"></div>

                <!-- Product Details Starts-->
                <div class="col-md-9 col-sm-8 wishlist-section" v-if="totalOrdersCount > 0">
                    <div class="profile-item">
                        <div class="profile-item-header">
                            <span><i class="fa fa-archive" aria-hidden="true"></i></span>{{ trans('profile.my_orders') }}
                        </div>
                        <div class="profile-item-body">
                            <div class="order-list-item">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr class="order-list-header">
                                            <th>№</th>
                                            <th>Статус</th>
                                            <th>{{ trans('profile.qty') }}</th>
                                            <th>{{ trans('profile.sum') }}</th>
                                            <th></th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr class="item-list-order" v-for="order in orders" v-cloak>
                                            <td>
                                                <div class="order-number">
                                                    <a class="fsz-16 font-2"
                                                       v-on:click="setOrderProducts(order)"
                                                       href="javascript:void(0);">@{{ order.order_number }}</a>
                                                </div>

                                            </td>
                                            <td>
                                                <div class="order-status">
                                                    <p class="fsz-16 font-2 no-margin">
                                                        <span>@{{ order.status.name }}</span>
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="order-total-count">
                                                    <p class="fsz-16 font-2 no-margin">
                                                        <span>@{{ order.total_products_count }}</span>
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="order-total-summ">
                                                    <p class="fsz-16 font-2 no-margin">
                                                        <span>@{{ order.total_order_amount }} грн</span>
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="view-order-details">
                                                <a
                                                   class="theme-btn btn-black"
                                                   v-on:click="setOrderProducts(order)"
                                                   href="javascript:void(0);">
                                                    {{ trans('profile.details') }}
                                                </a>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-8 wishlist-section" v-cloak v-else>
                    Пусто
                </div>
                <!-- Product Details Ends -->

                <!-- Pagination Starts -->
                <div class="block-inline pagination-wrap text-center" v-cloak v-if="totalOrdersCount > 5">
                    <ul class="pagination-1">
                        <li v-if="isPrev" class="prv">
                            <a class="disabled"
                               style="cursor: pointer;"
                               v-on:click="setPage(page - 1)">
                                <i class="fa fa-long-arrow-left"></i>
                            </a>
                        </li>
                        <li v-else class="prv">
                            <a>
                                <i class="fa fa-long-arrow-left"></i>
                            </a>
                        </li>

                        <li v-for="myOrderPage in myOrdersPages">
                            <a v-if="myOrderPage == '...'">
                                @{{ myOrderPage }}
                            </a>
                            <a v-else style="cursor: pointer;"
                               :class="{active : myOrderPage == page}"
                               v-on:click="setPage(myOrderPage)">
                                @{{ myOrderPage }}
                            </a>
                        </li>


                        <li v-if="isNext" class="nxt">
                            <a class="disabled"
                               style="cursor: pointer;"
                               v-on:click="setPage(page + 1)">
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
                <!-- Pagination Ends -->

            </div>
        </div>
        <!-- / Page Ends -->


    </article>
    <!-- / CONTENT AREA -->
@endsection