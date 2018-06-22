<footer class="footer-wrap">
    <!-- FOOTER-1 Starts -->
    <section class="sec-space footer-1">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="text-widget clearfix">
                        <p class="gray-clr">
                        @if($model->language == 'ru')
                            Feel and Fly - это молодежный бренд одежды в стиле Streetwear.
                            О бренде: FeelandFLy - это одежда для молодых, уверенных в себе людей,
                            которые хотят выделиться из толпы. В первую очередь мы ставим перед собой
                            задачу сделать максимально качественную, модную одежду за доступную для потребителя цену.
                        @elseif($model->language == 'uk')
                            Feel and Fly - це молодіжний бренд одягу в стилі Streetwear.
                            Про бренд: FeelandFLy - це одяг для молодих, упевнених в собі людей, які хочуть виділитися з натовпу. В першу чергу ми ставимо перед собою завдання зробити максимально якісну, модний одяг за доступну для споживача ціну.
                        @endif
                        </p>
                    </div>
                    <div class="add-detail upper-text clearfix">
                        <ul>
                        @if($model->language == 'ru')
                            <li>
                                Адрес:
                                <span class="gray-clr">
                                    г. Ровно, ул. Соборная 420 (ж)
                                </span>
                            </li>
                            <li>
                                Тел.:
                                <span class="gray-clr">
                                    +380978657461
                                </span>
                            </li>
                            <li>
                                Email:
                                <span class="gray-clr">
                                    feelfly2015@gmail.com
                                </span>
                            </li>
                        @elseif($model->language == 'uk')
                                <li>
                                Адреса:
                                <span class="gray-clr">
                                    м. Рівне, вул. Соборна 420 (ж)
                                </span>
                            </li>
                            <li>
                                Тел.:
                                <span class="gray-clr">
                                    +380978657461
                                </span>
                            </li>
                            <li>
                                Email:
                                <span class="gray-clr">
                                    feelfly2015@gmail.com
                                </span>
                            </li>
                        @endif
                        </ul>
                    </div>
                    <ul class="list-inline social-media light-media">
                        <li>
                            <a href="http://facebook.com/FeelAndFlyUA" class="fa fa-facebook" target="_blank"></a>
                        </li>
                        <li>
                            <a href="https://vk.com/feel_and_fly" class="fa fa-vk" target="_blank"></a>
                        </li>
                        <li>
                            <a href="https://www.instagr.am/feel_and_fly/" class="fa fa-instagram" target="_blank"></a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3">
                    <h2 class="section-title wht pb-25">
                        {{ trans('home.catalog') }}
                    </h2>
                    <nav class="navigation">
                        <ul class="nav-links nav navbar-nav">
                            @foreach($model->categories as $category)
                                <li style="display: block;">
                                    <a href="{{ url_category($category->slug, $model->language) }}" class="main-menu">
                                        <span class="text">{{ $category->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
                <div class="col-sm-6 col-md-3">
                    <h2 class="section-title wht pb-25">
                        {{ trans('home.information') }}
                    </h2>
                    <!-- <ul class="list-inline flicker-feed">
                        <li> <a href="#"> <img src="/img/template/avtar/1.jpg" alt="feed"> </a> </li>
                        <li> <a href="#"> <img src="/img/template/avtar/2.jpg" alt="feed"> </a> </li>
                        <li> <a href="#"> <img src="/img/template/avtar/3.jpg" alt="feed"> </a> </li>
                        <li> <a href="#"> <img src="/img/template/avtar/4.jpg" alt="feed"> </a> </li>
                        <li> <a href="#"> <img src="/img/template/avtar/5.jpg" alt="feed"> </a> </li>
                        <li> <a href="#"> <img src="/img/template/avtar/6.jpg" alt="feed"> </a> </li>
                        <li> <a href="#"> <img src="/img/template/avtar/7.jpg" alt="feed"> </a> </li>
                        <li> <a href="#"> <img src="/img/template/avtar/8.jpg" alt="feed"> </a> </li>
                        <li> <a href="#"> <img src="/img/template/avtar/9.jpg" alt="feed"> </a> </li>
                        <li> <a href="#"> <img src="/img/template/avtar/10.jpg" alt="feed"> </a> </li>
                        <li> <a href="#"> <img src="/img/template/avtar/11.jpg" alt="feed"> </a> </li>
                        <li> <a href="#"> <img src="/img/template/avtar/12.jpg" alt="feed"> </a> </li>
                    </ul> -->
                    <ul class="list-inline flicker-feed">
                    <!-- <ul class="list-inline list-unstyled right-topbar-log prof-block"> -->
                        <li><a href="{{ url_about($model->language) }}">{{ trans('header.about_us') }}</a></li>
                        <li><a href="{{ url_contact($model->language) }}">{{ trans('header.contacts') }}</a></li>
                        <!-- <li><a href="{{ url_cooperation($model->language) }}">{{ trans('header.cooperation') }}</a></li> -->
                        <li><a href="{{ url_static_payment_delivery($model->language) }}">{{ trans('header.payment_delivery') }}</a></li>
                        <li class="sale-link">
                            <a href="{{ route('saleIndex', ['language' => $model->language == 'uk' ? $model->language : '']) }}">
                                {{ trans('home.sale') }}
                            </a>
                        </li>
                        @if($model->language == 'ru')
                            <li class="general-leng">
                                <span class="link lang-link">
                                    <img src="/img/template/flags/ru.png" alt="ru">
                                    <span>Русский</span>
                                </span>
                            </li>
                            <li class="general-leng">
                                <a href="{{ url_current('uk') }}" class="link">
                                    <img src="/img/template/flags/uk.png" alt="uk">
                                    <span>Українська</span>
                                </a>
                            </li>
                        @elseif($model->language == 'uk')
                            <li class="general-leng">
                                <span class="link lang-link">
                                    <img src="/img/template/flags/uk.png" alt="">
                                    <span>Українська</span>
                                </span>
                            </li>
                            <li class="general-leng">
                                <a href="{{ url_current('ru') }}" class="link">
                                    <img src="/img/template/flags/ru.png" alt="">
                                    <span>Русский</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- FOOTER-1 Ends -->

    <!-- Footer Banner-2 Starts -->
    <section class="footer-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 gray-clr copy-right">
                    © Feel and Fly 2017. {{ trans('home.rights') }}
                </div>
                <div class="col-sm-6 goldfish">
                    {{ trans('home.development') }}:
                    <a href="http://goldfish-web.com/" target="_blank">
                        WEB-STUDIO GOLD FISH
                    </a>
                </div>

            </div>
        </div>
    </section>
    <!-- Footer Banner-2 Ends -->

</footer>