{{--HEADER--}}
<header>
    <div id="mySidenav" class="sidenav">
        <div class="nav-header">
            <span>Меню</span>

            <div class="closebtn" data-menu-close-link>
                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </div>
            <!--  <a href="javascript:void(0);" class="closebtn" data-menu-close-link>&times;</a> -->
        </div>
        <div class="nav-slide-body">
            <ul>
                <li>
                    <div class="dropdown-div">
                        <div class="dropdown-div-btn">
                            <h2 class="widget-title"><a href="">ВЕРХНЯЯ ОДЕЖДА</a><span class="minus-icon" style="line-height: 17px;"><i class="fa fa-angle-down" aria-hidden="true"></i></span> </h2>
                        </div>
                        <div class="dropdown-div-content">
                            <ul class="dropdown-list">
                                <li>


                                    <div class="dropdown-div dropdown-div_second">
                                        <div class="dropdown-div-btn">
                                            <h2 class="widget-title"><a href="">ВЕРХНЯЯ ОДЕЖДА</a><span class="minus-icon" style="line-height: 17px;"><i class="fa fa-angle-down" aria-hidden="true"></i></span> </h2>
                                        </div>
                                        <div class="dropdown-div-content">
                                            <ul class="dropdown-list">
                                                <li>
                                                    <a href="">Верхній одяг</a>
                                                </li>
                                                <li>
                                                    <a href="">Нижній одяг</a>
                                                </li>
                                                <li>
                                                    <a href="">Взуття</a>
                                                </li>
                                                <li>
                                                    <a href="">Аксесуари</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>




                                </li>
                                <li>
                                    <a href="">Нижній одяг</a>
                                </li>
                                <li>
                                    <a href="">Взуття</a>
                                </li>
                                <li>
                                    <a href="">Аксесуари</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>

                <li>
                    <a href="">Аксесуари</a>
                </li>

                <li>
                    <div class="dropdown-div">
                        <div class="dropdown-div-btn">
                            <h2 class="widget-title"><a href="">ВЕРХНЯЯ ОДЕЖДА</a><span class="minus-icon" style="line-height: 17px;"><i class="fa fa-angle-down" aria-hidden="true"></i></span> </h2>
                        </div>
                        <div class="dropdown-div-content">
                            <ul class="dropdown-list">
                                <li>
                                    <a href="">Верхній одяг</a>
                                </li>
                                <li>
                                    <a href="">Нижній одяг</a>
                                </li>
                                <li>
                                    <a href="">Взуття</a>
                                </li>
                                <li>
                                    <a href="">Аксесуари</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown-div">
                        <div class="dropdown-div-btn">
                            <h2 class="widget-title"><a href="">ВЕРХНЯЯ ОДЕЖДА</a><span class="minus-icon" style="line-height: 17px;"><i class="fa fa-angle-down" aria-hidden="true"></i></span> </h2>
                        </div>
                        <div class="dropdown-div-content">
                            <ul class="dropdown-list">
                                <li>
                                    <a href="">Верхній одяг</a>
                                </li>
                                <li>
                                    <a href="">Нижній одяг</a>
                                </li>
                                <li>
                                    <a href="">Взуття</a>
                                </li>
                                <li>
                                    <a href="">Аксесуари</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>

        </div>
    </div>
    <div class="header-topbar bgcol-top-nav">
        <div class="container">
            <div class="topbar-left topbar-left-nav">
                <ul>
                    <li><a href="javascript:void(0);">{{ trans('header.about_us') }}</a></li>
                    <li><a href="javascript:void(0);">{{ trans('header.contacts') }}</a></li>
                    <li><a href="javascript:void(0);">{{ trans('header.cooperation') }}</a></li>
                    <li><a href="javascript:void(0);">{{ trans('header.payment_delivery') }}</a></li>
                </ul>
            </div>
            <div class="topbar-right">
                <ul class="list-inline list-unstyled right-topbar-log prof-block">

                    @if($model->language == 'ru')
                        <li class="general-leng">
                            <span class="link lang-link">
                                <img src="/img/template/flags/ru.png" alt="">
                                <span>Русский</span>
                                <span class="bs-caret">
                                    <span class="caret"></span>
                                </span>
                            </span>
                            <div class="ather-lang">
                                <a href="{{ url_current('uk') }}" class="link">
                                    <img src="/img/template/flags/uk.png" alt="">
                                    <span>Українська</span>
                                </a>
                            </div>
                        </li>
                    @elseif($model->language == 'uk')
                        <li class="general-leng">
                            <span class="link lang-link">
                                <img src="/img/template/flags/uk.png" alt="">
                                <span>Українська</span>
                                <span class="bs-caret">
                                    <span class="caret"></span>
                                </span>
                            </span>
                            <div class="ather-lang">
                                <a href="{{ url_current('ru') }}" class="link">
                                    <img src="/img/template/flags/ru.png" alt="">
                                    <span>Русский</span>
                                </a>
                            </div>
                        </li>
                    @endif

                    @if(auth()->check())
                        <li>
                            <a class="open-drop-profile-nav" href="javascript:void(0);">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                {{ auth()->user()->name }}
                            </a>
                        </li>

                        <ul class="drop-nav-profile">
                            <li>
                                <a class="theme-btn btn-black" href="{{ url_personal_info($model->language) }}">
                                    {{ trans('header.personal_info') }}
                                </a>
                            </li>
                            <li>
                                <a class="theme-btn btn-black" href="{{ url_payment_delivery($model->language) }}">
                                    {{ trans('header.payment_delivery') }}
                                </a>
                            </li>
                            <li>
                                <a class="theme-btn btn-black" href="{{ url_wish_list($model->language) }}">
                                    {{ trans('header.wish_list') }}
                                </a>
                            </li>
                            <li>
                                <a class="theme-btn btn-black" href="{{ url_my_orders($model->language) }}">
                                    {{ trans('header.my_orders') }}
                                </a>
                            </li>
                            <li>
                                <a class="theme-btn btn-black" href="/user/logout">
                                    {{ trans('header.log_out') }}
                                </a>
                            </li>
                        </ul>
                    @else
                        <li>
                            <a data-toggle="modal" data-target="#login-popup" href="javascript:void(0);">
                                {{ trans('header.log_in') }}
                            </a>
                        </li>
                        <li>
                            <a data-toggle="modal" data-target="#register-popup" href="javascript:void(0);">
                                {{ trans('header.register') }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="header-main header-vet-clinic">
        <div class="container">
            <div class="header-main-wrapper">
                <div class="hamburger-menu open-nav" data-menu-open-link>
                    <div class="hamburger-menu-wrapper">
                        <div class="icons"></div>
                    </div>
                </div>

                <div class="navbar-header pull-left">
                    <div class="logo">
                        <a href="{{ url_home($model->language) }}" class="header-logo">
                            <img src="/img/template/logo/logo-black.png" alt="Feel and Fly">
                            <span class="logo-title">Feel and Fly</span>
                        </a>
                    </div>
                </div>

                <div class="div_smoll-cart" id="mini-cart">
                    <div class="dropdown_cart_smoll" :class="{'can-show-mini-cart': totalCount}">
                        <a class="show_cart" v-on:click.prevent="showMiniCart()">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </a>
                        <span v-cloak class="badge">
                            @{{ totalCount }}
                        </span>
                        <div class="smol-cart-content">
                            <div class="smoll-cart_header">
                                {{ trans('cart.title') }}
                                <div class="cart-header_count">
                                    <span v-cloak class="badge">
                                        @{{ totalCount }}
                                    </span>
                                </div>
                            </div>
                            <div class="smoll-cart_body">
                                <div class="smoll-cart_products">
                                    <div class="cart-product-item" v-for="cartItem in cartItems">
                                        <div class="prod-item_img">
                                            {{--<img v-if="cartItem.product.images.length > 0" v-bind:src="cartItem.product.images[0].small" alt="">--}}
                                            {{--<img v-else src="/img/product/small/no_photo.jpg" alt="">--}}
                                            <img v-bind:src="cartItem.product.images[0].small" alt="">
                                            <div class="position_lable">
                                                <div class="lable_smoll">
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

                                        </div>
                                        <div class="prod-item_detail">
                                            <a class="prod-title block-inline"
                                               v-bind:href="'/product/' + cartItem.product.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'">
                                                @{{ cartItem.product.name }}
                                            </a>
                                            <p class="fsz-14 font-2 no-margin">
                                                <span class="fw-300 gray-clr">@{{ cartItem.count }}
                                                    <sub>X</sub>
                                                </span> @{{ cartItem.product.price[0].price }} грн
                                            </p>
                                            <div class="prod-price font-2"
                                                 v-if="cartItem.product.promotions != null && cartItem.product.promotions.length > 0 && cartItem.product.promotions[0].id == 1">
                                                <del>
                                                    @{{ cartItem.product.price[0].old_price }} грн
                                                </del>
                                            </div>
                                            <a href="#"
                                               v-on:click.prevent="deleteFromCart(cartItem.productId, cartItem.sizeId)"
                                               class="smoll-delete_prod">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                            <div class="prod-total-price fsz-14 font-2">
                                                {{ trans('cart.sum') }}: <span>@{{ (cartItem.product.price[0].price * cartItem.count).toFixed(2) }}</span> грн
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="smoll-cart_totalInfo">
                                    <p class="font-2">
                                        {{ trans('cart.total') }}: <span>@{{ totalAmount.toFixed(2) }}</span> грн
                                    </p>
                                </div>
                                <div class="smoll-cart_btn">
                                    <a class="theme-btn btn-black" href="{{ url_order($model->language) }}">
                                        {{ trans('cart.confirm') }}
                                    </a>
                                    <a class="theme-btn btn-black"
                                       href="javascript:void(0);"
                                       data-toggle="modal" data-target=".big-cart">
                                        {{ trans('cart.open') }}
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <nav class="navigation pull-right">
                    <ul class="nav-links nav navbar-nav">
                        @foreach($model->categories as $category)
                            @if($category->hasSecondLevel)
                                @if($category->hasThirdLevel)
                                    <li class="mega-menu">
                                        <a href="{{ url_category($category->slug, $model->language) }}" class="main-menu">
                                            <span class="text">{{ $category->name }}</span><span class="fa fa-angle-down icons-dropdown"></span>
                                        </a>
                                        <div class="mega-menu-content clearfix">
                                            @foreach($category->childs as $child)
                                                <ul class="mega-menu-column col-md-3">
                                                    <li class="mega-menu-title sub-menu">
                                                        <a href="{{ url_category($child->slug, $model->language) }}" class="sf-with-ul">
                                                            {{ $child->name }}
                                                        </a>
                                                        @if($child->childs->count() > 0)
                                                            <ul class="dropdown-menu dropdown-menu-1">
                                                                @foreach($child->childs as $thirdChild)
                                                                    <li>
                                                                        <a href="{{ url_category($thirdChild->slug, $model->language) }}" class="link-page">
                                                                            <span class="text">{{ $thirdChild->name }}</span>
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </div>
                                    </li>
                                @else
                                    <li class="dropdown">
                                        <a href="{{ url_category($category->slug, $model->language) }}" class="main-menu">
                                            <span class="text">{{ $category->name }}</span><span class="fa fa-angle-down icons-dropdown"></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-1">
                                            @foreach($category->childs as $child)
                                                <li>
                                                    <a href="{{ url_category($child->slug, $model->language) }}" class="link-page">
                                                        <span class="text">{{ $child->name }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @else
                                <li>
                                    <a href="{{ url_category($category->slug, $model->language) }}" class="main-menu">
                                        <span class="text">{{ $category->name }}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="button-search">
                        {{--<a class="main-menu"><i class="fa fa-search"></i></a>--}}
                        <div class="serch-button-open">
                            <button class="open-search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                        <div id="search" class="profile-search profile-search-smoll">
                            <form class="form-serch-btn" v-bind:action="url" method="get">
                                <input v-model="series" v-on:keyup="searchAjax()"
                                       type="text"
                                       placeholder="{{ trans('header.search')}}">

                                <button v-on:click.prevent="search()" class="profile-search-btn">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                            <div v-if="countSearchProducts == 0 && series != '' && showNoResult" class="search-result-false">
                                <span>{{ trans('header.not_found') }}</span>
                            </div>
                            <div v-if="countSearchProducts > 0 && series != '' && showResult" class="search-result-true">
                                <a v-for="searchProduct in searchProducts"
                                   class="result-item-link"
                                   v-bind:href="'/product/' + searchProduct.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'">
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
                                    {{--<a v-bind:href="'/search/' + series + '/{{ $model->language == 'ru' ? '' : $model->language }}'" class="theme-btn btn-black">--}}
                                    <a v-bind:href="url" class="theme-btn btn-black">
                                        <span>{{ trans('header.all_results') }} (@{{ countSearchProducts }})</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                </nav>

            </div>
        </div>
    </div>
</header>
{{--HEADER--}}