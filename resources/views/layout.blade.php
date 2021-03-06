<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>

    {{--META TAGS--}}
    @include('layout.head-meta')
    {{--/META TAGS--}}

    {{--HEAD CSS--}}
    @include('layout.head-css-js')
    {{--/HEAD CSS--}}

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120901958-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-120901958-1');
    </script>
</head>

<body id="home" class="wide">

{{--WRAPPER--}}
<main class="wrapper">
    @include('modals.big-cart')

    @include('modals.pop-up')

    @include('modals.social-email')

    @include('modals.restore-password')

    @include('modals.notify')

    {{--HEADER--}}
    @include('layout.header')
    {{--/HEADER--}}

    {{--CONTENT--}}
    @yield('content')
    {{--/CONTENT--}}

    {{--FOOTER--}}
    @include('layout.footer')
    {{--/FOOTER--}}

    {{--SCROLL TO TOP--}}
    <div id="to-top" class="to-top"> <i class="fa fa-angle-up"></i> </div>
    {{--/SCROLL TO TOP--}}

</main>
{{--/WRAPPER--}}

{{--MODALS--}}
    {{--LOADER--}}
    @include('modals.loader')
    {{--/LOADER--}}
    {{--Product Preview Popup--}}
{{--    @include('modals.product-preview')--}}
    {{--/Product Preview Popup--}}

    {{--Popup: Login-Dark--}}
    @include('modals.login')
    {{--/Popup: Login-Dark--}}
    @include('modals.register')
{{--/MODALS--}}

{{--PHP TO JS VARIABLES--}}
@include ('php-js-vars')
{{--/PHP TO JS VARIABLES--}}

{{--JS Global--}}
@include('layout.body-js')
{{--/JS Global--}}

</body>
</html>