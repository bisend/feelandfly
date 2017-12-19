@extends('layout')

@section('content')
    <!-- CONTENT AREA -->
    <article>

        <!--Breadcrumb Section Start-->
        <section class="breadcrumb-bg">
            <div class="theme-container container ">
                <div class="site-breadcumb white-clr">
                    <h2 class="section-title wht fsz-36"> Избранное </h2>
                    <ol class="breadcrumb breadcrumb-menubar">
                        <li> <a href="{{ url_home($model->language) }}"> Главная </a>  Избранное </li>
                    </ol>
                </div>
            </div>
        </section>
        <!--Breadcrumb Section End-->

        <!-- Page Starts-->
        <div class="container theme-container ptb-70" id="profile-wish-list">
            <aside class="row">
                <!-- Sidebar Starts -->
                <aside class="col-md-3 col-sm-4 sidebar">
                    <div class="widget-wrap">
                        <h2 class="widget-title title-profile-bar"> Мой профиль </h2>
                        <ul class="account-list with-border">
                            <li><a href="{{ url_personal_info($model->language) }}"> Основная информация </a></li>
                            <li><a href="{{ url_payment_delivery($model->language) }}"> Оплата и доставка </a></li>
                            <li><a href="javascript:void(0);" style="color: #000;">Избранное</a></li>
                            <li><a href="/user/logout">Выход</a></li>
                        </ul>
                    </div>
                </aside>
                <!-- Sidebar Ends -->

                <div class="visible-xs pt-70"></div>

                <!-- Product Details Starts-->
                <aside class="col-md-9 col-sm-8 wishlist-section" v-if="wishListItems.length > 0">
                    <div class="col-md-12 list-wishlist-item" v-for="(wishListItem, index) in wishListItems"
                         v-if="index >= wishListPagination.startIndex && index < wishListPagination.endIndex" v-cloak>
                        <div class="border-item-wishlist">
                            <div class="row">
                                <div class="col-sm-12 col-md-2">
                                    <div class="wishlist-item-img">
                                        <a v-bind:href="'/product/' + wishListItem.product.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'">
                                            <img alt="product" v-bind:src="wishListItem.product.images[0].small">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-10">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-7">
                                            <div class="wishlist-item-title">
                                                <h2 class="prod-title">
                                                    <a v-bind:href="'/product/' + wishListItem.product.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'">
                                                        @{{ wishListItem.product.name }}
                                                    </a>
                                                </h2>
                                            </div>
                                            <div class="wishlist-item-prise">
                                                <div class="prod-price font-2">
                                                    <ins>@{{ wishListItem.product.price[0].price }} грн</ins>
                                                </div>
                                            </div>

                                            <div class="wishlist-item-color">
                                                <div class="productInfo-size-color">
                                                    <ul class="choose-clr list-inline border-hover">
                                                        <li>
                                                            <a class="active"
                                                               :style="{'background-color': '' + wishListItem.product.color.html_code + ''}"></a>
                                                        </li>
                                                    </ul>
                                                    <ul class="choose-size list-inline border-hover">
                                                        <li>
                                                            <a class="active">
                                                                <span v-for="(size, index) in wishListItem.product.sizes"
                                                                      v-if="size.id == wishListItem.sizeId">
                                                                    @{{ size.name }}
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-5">
                                            <div class="wishlist-item-btn">
                                                <div class="block-inline">
                                                    <ul class="prod-meta">
                                                        <li>
                                                            <a href="javascript:void(0);"
                                                               v-on:click="addToCart(wishListItem.productId, wishListItem.sizeId, 1)"
                                                               class="theme-btn btn-black">
                                                                <span v-cloak
                                                                      v-if="!findWhere(cartItems, {'productId': wishListItem.productId, 'sizeId': wishListItem.sizeId})">
                                                                    Добавить в корзину
                                                                </span>
                                                                <span v-cloak v-else>
                                                                    В корзине
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);"
                                                               v-on:click="deleteFromWishList(wishListItem.wishListProductId)"
                                                               class="delete-wishlist meta-icon">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <aside class="col-md-9 col-sm-8 wishlist-section" v-else v-cloak>
                    <div class="col-md-12 list-wishlist-item">
                        Пусто
                    </div>
                </aside>
                <!-- Pagination Starts -->
                <div class="block-inline pagination-wrap text-center" v-cloak v-if="totalWishListCount > 5">
                    <ul class="pagination-1">

                        <li v-if="wishListPagination.isPrev" class="prv">
                            <a class="disabled"
                               style="cursor: pointer;"
                               v-on:click="setWishListPage(wishListCurrentPage - 1)">
                                <i class="fa fa-long-arrow-left"></i>
                            </a>
                        </li>
                        <li v-else class="prv">
                            <a>
                                <i class="fa fa-long-arrow-left"></i>
                            </a>
                        </li>

                        <li v-for="page in wishListPages">
                            <a v-if="page == '...'">
                                @{{ page }}
                            </a>
                            <a v-else style="cursor: pointer;"
                               :class="{active : page == wishListPagination.page}"
                               v-on:click="setWishListPage(page)">
                                @{{ page }}
                            </a>
                        </li>
                        <li v-if="wishListPagination.isNext" class="nxt">
                            <a class="disabled"
                               style="cursor: pointer;"
                               v-on:click="setWishListPage(wishListCurrentPage + 1)">
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


            </aside>
            <!-- Product Details Ends -->



        </div>
        {{--</div>--}}
        <!-- / Page Ends -->


    </article>
    <!-- / CONTENT AREA -->
@endsection