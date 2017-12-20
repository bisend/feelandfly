{{--Header 2--}}
<header class="header-2">
    <section class="header-topbar">
        <div class="container theme-container">
            <div class="row">
                <div class="col-md-5 col-sm-6">
                    <ul class="top_header-list">
                        <li><a href="javascript:void(0);">О нас</a></li>
                        <li><a href="javascript:void(0);">Контакты</a></li>
                        <li><a href="javascript:void(0);">Сотрудничество</a></li>
                        <li><a href="javascript:void(0);">Оплата и доставка</a></li>
                    </ul>
                </div>
                <div class="col-md-7 col-sm-6">
                    <ul class="list-items pull-right top-nav">
                        {{--<li>--}}
                            {{--<div class="search-selectpicker selectpicker-wrapper">--}}
                                {{--<select class="selectpicker" data-width="100%" data-toggle="tooltip">--}}
                                    {{--<option data-content="<img src='/img/template/flags/ru.png'></span>  <span> Російська </span>">--}}
                                    {{--<option data-content="<img src='/img/template/flags/uk.png'></span>  <span> Українська </span>">--}}
                                {{--</select>--}}
                            {{--</div>--}}
                        {{--</li>--}}

                        <li class="dropdown">
                            @if($model->language == 'ru')
                                <a class="dropdown-toggle" data-toggle="dropdown" href="{{ url_current('ru') }}">
                                    <img src='/img/template/flags/ru.png'>
                                    Русский
                                </a>
                                <span class="bs-caret">
                                    <span class="caret"></span>
                                </span>
                                <ul class="dropdown-menu" role="menu" >
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" href="{{ url_current('uk') }}">
                                            <img src='/img/template/flags/uk.png'>
                                            Українська
                                        </a>
                                    </li>
                                </ul>
                            @elseif($model->language == 'uk')
                                <a class="dropdown-toggle" data-toggle="dropdown" href="{{ url_current('uk') }}">
                                    <img src='/img/template/flags/uk.png'>
                                    Українська
                                </a>
                                <ul class="dropdown-menu" role="menu" >
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" href="{{ url_current('ru') }}">
                                            <img src='/img/template/flags/ru.png'>
                                            Русский
                                        </a>
                                    </li>
                                </ul>
                            @endif
                        </li>

                        @if(auth()->check())
                            <li><a class="open-drop-profile-nav" href="javascript:void(0);">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    {{ auth()->user()->name }}</a>
                            </li>

                        <ul class="drop-nav-profile">
                            <li><a class="theme-btn btn-black" href="{{ url_personal_info($model->language) }}">Личные данные</a></li>
                            <li><a class="theme-btn btn-black" href="{{ url_payment_delivery($model->language) }}">Оплата и доставка</a></li>
                            <li><a class="theme-btn btn-black" href="{{ url_wish_list($model->language) }}">Избранное</a></li>
                            <li><a class="theme-btn btn-black" href="{{ url_my_orders($model->language) }}">Мои заказы</a></li>
                            <li><a class="theme-btn btn-black" href="/user/logout">Выход</a></li>
                        </ul>



                            {{--<li><a href="/user/logout">Выход</a></li>--}}
                        @else
                            <li><a data-toggle="modal" data-target="#login-popup" href="javascript:void(0);"> Вход </a></li>
                            <li><a data-toggle="modal" data-target="#register-popup" href="javascript:void(0);"> Регистрация </a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="main-header">
        <div class="header-wrap upper-text">
            <div class="container theme-container rel-div">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-12 co-xs-12">
                        <div class="header-logo">
                            <a href="{{ url_home($model->language) }}">
                                <img src="/img/template/logo/logo-black.png" alt="logo">
                                <span class="logo-title">Feel and Fly</span>
                            </a>
                            <span class="nav-trigger toggle-hover visible-xs">
                                <a class="toggle-icon fa fa-bars" href="javascript:void(0);"></a>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-10 col-sm-12 navigation font-2">
                        <nav>
                            <div class="navbar-collapse no-padding" id="primary-navigation">
                                <span class="nav-trigger toggle-hover visible-xs">
                                    <a class="toggle-icon fa fa-times" href=""> </a>
                                </span>

                                <div class="serch-button-open">
                                    <button class="open-search"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                                <div id="search" class="profile-search profile-search-smoll">
                                    <form class="form-serch-btn" v-bind:action="/search/ + series">
                                        <input v-model="series" v-on:keyup="searchAjax()" type="text" placeholder="Поиск...">

                                        <button v-on:click.prevent="search()" class="profile-search-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    </form>
                                    <div v-if="countSearchProducts == 0 && series != '' && showNoResult" class="search-result-false">
                                        <span>Товаров не найдено</span>
                                    </div>
                                    <div v-if="countSearchProducts > 0 && series != '' && showResult" class="search-result-true">
                                        <a v-for="searchProduct in searchProducts" class="result-item-link" v-bind:href="'/product/' + searchProduct.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'">
                                            <div class="search-result-item">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="resuil-item-img">
                                                            <img v-bind:src="searchProduct.images[0].small" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="resuil-item-title-price">
                                                            <div class="result-title">@{{ searchProduct.name }}</div>
                                                            <div class="result-price">@{{ searchProduct.price[0].price }} грн</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="view-all-result">
                                            <a v-bind:href="'/search/' + series + '/{{ $model->language == 'ru' ? '' : $model->language }}'" class="theme-btn btn-black">
                                                <span>Все результаты (@{{ countSearchProducts }})</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <ul class="nav navbar-nav primary-navbar">
                                    @foreach($model->categories as $category)
                                        <li>
                                            <a href="{{ url_category($category->slug, $model->language) }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                    {{--TODO IF MORE THAN 1 LVL CATEGORY--}}
                                    {{--<li class="dropdown mega-dropdown">--}}
                                        {{--<a href="javascript:void(0);" class="dropdown-toggle"--}}
                                           {{--data-toggle="dropdown"--}}
                                           {{--role="button"--}}
                                           {{--aria-haspopup="true">АКСЕССУАРЫ</a>--}}
                                        {{--<div class="dropdown-menu mega-dropdown-menu white-clr font-1">--}}

                                            {{--<div class="col-lg-6 col-sm-12 menu-block">--}}
                                                {{--<a class="title_hover-drop" href="">СНЭПБЕЭКИ</a>--}}
                                                {{--<div class="banner-1 box-hover col-sm-6">--}}
                                                    {{--<img src="/img/template/megamenu/3.jpg" alt="banner">--}}
                                                    {{--<div class="banner-content tbl-wrp black-mask">--}}
                                                        {{--<div class="text-middle">--}}
                                                            {{--<div class="tbl-cell">--}}
                                                                {{--<h2 class="section-title wht fsz-56"> СНЭПБЭК FEEL&FLY--}}
                                                                    {{--SAMPLE #3 BLACK</h2>--}}
                                                                {{--<p class="no-margin">--}}
                                                                    {{--<a href="#" class="btn-white theme-btn">--}}
                                                                        {{--ПОДРОБНЕЕ--}}
                                                                    {{--</a>--}}
                                                                    {{--/p>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="banner-1 box-hover col-sm-6">--}}
                                                    {{--<img src="/img/template/megamenu/4.jpg" alt="banner">--}}
                                                    {{--<div class="banner-content tbl-wrp black-mask">--}}
                                                        {{--<div class="text-middle">--}}
                                                            {{--<div class="tbl-cell">--}}
                                                                {{--<h2 class="section-title wht fsz-56">--}}
                                                                    {{--СНЭПБЭК FEEL&FLY SAMPLE #1 BLACK--}}
                                                                {{--</h2>--}}
                                                                {{--<p class="no-margin">--}}
                                                                    {{--<a href="#" class="btn-white theme-btn">--}}
                                                                        {{--ПОДРОБНЕЕ--}}
                                                                    {{--</a>--}}
                                                                {{--</p>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}

                                            {{--<div class="col-lg-6 col-sm-12 menu-block">--}}
                                                {{--<a class="title_hover-drop" href="">РЮКЗАКИ</a>--}}
                                                {{--<div class="banner-1 box-hover col-sm-6">--}}
                                                    {{--<img src="/img/template/megamenu/3.jpg" alt="banner">--}}
                                                    {{--<div class="banner-content tbl-wrp black-mask">--}}
                                                        {{--<div class="text-middle">--}}
                                                            {{--<div class="tbl-cell">--}}
                                                                {{--<h2 class="section-title wht fsz-56">--}}
                                                                    {{--РЮКЗАК FEEL&FLY BACKPACK 23L NAVY--}}
                                                                {{--</h2>--}}
                                                                {{--<p class="no-margin">--}}
                                                                    {{--<a href="#" class="btn-white theme-btn">--}}
                                                                        {{--ПОДРОБНЕЕ--}}
                                                                    {{--</a>--}}
                                                                {{--</p>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="banner-1 box-hover col-sm-6">--}}
                                                    {{--<img src="/img/template/megamenu/4.jpg" alt="banner">--}}
                                                    {{--<div class="banner-content tbl-wrp black-mask">--}}
                                                        {{--<div class="text-middle">--}}
                                                            {{--<div class="tbl-cell">--}}
                                                                {{--<h2 class="section-title wht fsz-56">--}}
                                                                    {{--РЮКЗАК FEEL&FLY BACKPACK 23L NAVY</h2>--}}
                                                                {{--<p class="no-margin">--}}
                                                                    {{--<a href="#" class="btn-white theme-btn">--}}
                                                                        {{--ПОДРОБНЕЕ--}}
                                                                    {{--</a>--}}
                                                                {{--</p>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</li>--}}


                                </ul>



                            </div>

                        </nav>


                        {{--<ul class="top-elements">--}}
                            {{--<li id="search" :class="{'search-hover': showInput}">--}}
                                {{--<a href="javascript:void(0);" class="search-icon icon-cube" v-on:click="showSearchInput()">  </a>--}}
                                {{--<div class="search-popup pop-up-box" id="search-popup" :class="{'show-search-input': showInput}">--}}
                                    {{--<form action="#" class="form-wrap">--}}
                                        {{--<div class="no-padding col-sm-12 col-xs-12">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<input type="text" placeholder="Поиск..." class="form-control text">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</form>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    </div>
                    <div class="col-lg-1 col-sm-3 top-right text-right">
                        <ul class="top-elements">
                            <li id="mini-cart" :class="{'cart-hover': totalCount}">
                                <a href="javascript:void(0);" class="cart-icon">
                                        <span v-cloak class="items-count font-1">
                                            @{{ totalCount }}
                                        </span>
                                </a>
                                <div class="pop-up-box cart-style-1">
                                    <div class="cart-title block-inline">
                                        <h2 class="title-1">
                                            Корзина
                                        </h2>
                                        <span class="fa fa-shopping-cart"></span>
                                        <i v-cloak class="items-count font-1">
                                            @{{ totalCount }}
                                        </i>
                                    </div>
                                    <div class="cart-item">
                                        <div class="cart-list" v-for="cartItem in cartItems">
                                            <div class="cart-img">
                                                <img v-bind:src="cartItem.product.images[0].small" alt="">
                                            </div>
                                            <div class="cart-detail">
                                                <a class="smoll-cart-delete"
                                                   href="javascript:void(0);"
                                                   v-on:click="deleteFromCart(cartItem.productId, cartItem.sizeId)">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                                <a class="prod-title block-inline"
                                                   v-bind:href="'/product/' + cartItem.product.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'">
                                                    @{{ cartItem.product.name }}
                                                </a>
                                                <p class="fsz-13 font-2 no-margin">
                                                        <span class="fw-300 gray-clr">
                                                            @{{ cartItem.count }}
                                                            <sub>X</sub>
                                                        </span>
                                                    @{{ cartItem.product.price[0].price }} грн
                                                </p>
                                                <p class="fsz-16 font-2 no-margin smoll-cart-totl-prod">

                                                   Сумма:<span>@{{ (cartItem.product.price[0].price * cartItem.count).toFixed(2) }} грн</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="font-2 fsz-16 cart-total clearfix">
                                        <div class="col-sm-12 col-xs-12">
                                            ВСЕГО: @{{ totalAmount.toFixed(2) }} грн
                                        </div>
                                    </div>
                                    <div class="block-inline cart-btns">
                                        <ul class="prod-meta">
                                            <li class="cart_btn">
                                                <a href="{{ url_order($model->language) }}" class="theme-btn btn-black">
                                                    Оформить заказ
                                                </a>
                                            </li>
                                        </ul>
                                        <ul class="prod-meta">
                                            <li class="cart_btn">
                                                <a class="theme-btn btn-black"
                                                   href="javascript:void(0);"
                                                   data-toggle="modal" data-target=".big-cart">
                                                    Открыть корзину
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</header>
{{--/Header 2--}}