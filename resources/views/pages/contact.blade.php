@extends('layout')

@section('content')

    <article class="margin-after-header">

        <!--Breadcrumb Section Start-->
        <section class="breadcrumb-bg">
            <div class="container ">
                <div class="site-breadcumb">
                    <h1 class="section-title fsz-36">
                        {{ trans('header.contacts') }}
                    </h1>
                </div>
            </div>
        </section>
        <!--Breadcrumb Section End-->


        <div class="container ptb-70" style="padding-top: 10px;">

            {{--content--}}

            <div class="row">
                <div class="about-block-contacts col-xs-12">
                    <div class="about-contacts-container">

                    @if($model->language == 'ru')
                        <p><strong>Тел.:</strong> +380978657461</p>
                        <p><strong>Адрес:</strong> г. Ровно, ул. Соборна 420 (ж)</p>
                        <p><strong>Email:</strong> <a class="btn_link" href="mailto:feelfly2015@gmail.com">feelfly2015@gmail.com</a></p>
                        <p><strong>Мы в социальных сетях:</strong></p>
                        <ul>
                            <li>facebook:
                                <a class="btn_link" href="http://facebook.com/FeelAndFlyUA" target="_blank" rel="noopener noreferrer">http://facebook.com/FeelAndFlyUA</a>
                            </li>
                            <li>vk:
                                <a class="btn_link" href="https://vk.com/feel_and_fly" target="_blank" rel="noopener noreferrer">https://vk.com/feel_and_fly</a>
                            </li>
                            <li>instagram:
                                <a class="btn_link" href="https://www.instagr.am/feel_and_fly/" target="_blank" rel="noopener noreferrer">https://www.instagr.am/feel_and_fly/</a>
                            </li>
                        </ul>
                    @elseif($model->language == 'uk')
                        <p><strong>Тел.:</strong> +380978657461</p>
                        <p><strong>Адреса:</strong> м. Рівне, вул. Соборна 420 (ж)</p>
                        <p><strong>Email:</strong> <a class="btn_link" href="mailto:feelfly2015@gmail.com">feelfly2015@gmail.com</a></p>
                        <p><strong>Ми в соціальних мережах:</strong></p>
                        <ul>
                            <li>facebook:
                                <a class="btn_link" href="http://facebook.com/FeelAndFlyUA" target="_blank" rel="noopener noreferrer">http://facebook.com/FeelAndFlyUA</a>
                            </li>
                            <li>vk:
                                <a class="btn_link" href="https://vk.com/feel_and_fly" target="_blank" rel="noopener noreferrer">https://vk.com/feel_and_fly</a>
                            </li>
                            <li>instagram:
                                <a class="btn_link" href="https://www.instagr.am/feel_and_fly/" target="_blank" rel="noopener noreferrer">https://www.instagr.am/feel_and_fly/</a>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>



    </article>

@endsection