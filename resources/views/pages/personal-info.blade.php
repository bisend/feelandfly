@extends('layout')

@section('content')

    <!-- CONTENT AREA -->
    <article>

        <!--Breadcrumb Section Start-->
        <section class="breadcrumb-bg">
            <div class="theme-container container ">
                <div class="site-breadcumb white-clr">
                    <h2 class="section-title wht fsz-36"> Мой профиль </h2>
                    <ol class="breadcrumb breadcrumb-menubar">
                        <li>
                            <a href="{{ url_home($model->language) }}">
                                Главная
                            </a>
                            Мой профиль
                        </li>
                    </ol>
                </div>
            </div>
        </section>
        <!--Breadcrumb Section End-->

        <!-- Page Starts-->
        <div class="container theme-container ptb-70">
            <div class="row">
                <!-- Sidebar Starts -->
                <aside class="col-md-3 col-sm-4 sidebar">
                    <div class="widget-wrap">
                        <h2 class="widget-title title-profile-bar"> Мой профиль </h2>
                        <ul class="account-list with-border">
                            <li>
                                <a href="javascript:void(0);">
                                    Основная информация
                                </a>
                            </li>
                            <li class="active"><a href="">Оплата и доставка </a></li>
                            <li ><a href="/user/logout">Выход</a></li>
                        </ul>
                    </div>
                </aside>
                <!-- Sidebar Ends -->

                <div class="visible-xs pt-70"></div>

                <!-- Product Details Starts-->
                <aside class="col-md-9 col-sm-8">
                    <div class="profile-item">
                        <div class="profile-item-header">
                            <span><i class="fa fa-user" aria-hidden="true"></i></span> ОСНОВНАЯ ИНФОРМАЦИЯ
                        </div>
                        <div class="profile-item-body" id="personal-info">
                            <div class="row">
                                <form @submit.prevent="validateBeforeSubmit">
                                    {{ csrf_field() }}
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <input type="text"
                                                   data-profile-name
                                                   v-model="name"
                                                   placeholder="Имя" class="form-control black-input">
                                        </div>
                                    </div>
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<input type="text" placeholder="Прізвище" class="form-control black-input">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <input type="text"
                                                   data-profile-email
                                                   v-model="email"
                                                   placeholder="Електронный адрес" class="form-control black-input">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <input type="text"
                                                   data-profile-phone
                                                   v-model="phone"
                                                   placeholder="Номер телефона" class="form-control black-input">
                                        </div>
                                    </div>

                                    <div class="profile-item-save">
                                        <button type="submit" class="theme-btn btn-black" href="#"> Сохранить </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="profile-item">
                        <div class="profile-item-header">
                            <span><i class="fa fa-unlock-alt" aria-hidden="true"></i></span> Смена пароля
                        </div>
                        <div class="profile-item-body" id="change-password">
                            <form @submit.prevent="validateBeforeSubmit">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <input type="password"
                                                   data-profile-old-password
                                                   v-model="oldPassword"
                                                   placeholder="Старый пароль" class="form-control black-input">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <input type="password"
                                                   data-profile-new-password
                                                   v-model="newPassword"
                                                   placeholder="Новый пароль" class="form-control black-input">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <input type="password"
                                                   data-profile-confirm-new-password
                                                   v-model="confirmNewPassword"
                                                   placeholder="Повторите новый пароль" class="form-control black-input">
                                        </div>
                                    </div>

                                    <div class="profile-item-save">
                                        <button type="submit" class="theme-btn btn-black" href="#"> Сохранить </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </aside>
                <!-- Product Details Ends -->



            </div>
        </div>
        <!-- / Page Ends -->


    </article>
    <!-- / CONTENT AREA -->

@endsection