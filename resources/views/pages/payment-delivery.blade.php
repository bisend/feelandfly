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
                            Оплата и доставка
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
                            <li><a href="{{ url_personal_info($model->language) }}"> Основная информация </a></li>
                            <li><a href="javascript:void(0);" style="color: #000;"> Оплата и доставка </a></li>
                            <li><a href="{{ url_wish_list($model->language) }}">Избранное</a></li>
                            <li><a href="/user/logout">Выход</a></li>
                        </ul>
                    </div>
                </aside>
                <!-- Sidebar Ends -->

                <div class="visible-xs pt-70"></div>

                <!-- Product Details Starts-->
                <aside class="col-md-9 col-sm-8" id="profile-payment-delivery">
                    <div class="profile-item">
                        <div class="profile-item-header">
                            <span><i class="fa fa-credit-card" aria-hidden="true"></i></span> оплата и доставка
                        </div>
                        <div class="profile-item-body">
                            <div class="row">
                                <form @submit.prevent="validateBeforeSubmit">
                                    <div class="col-md-4">
                                        <div class="drop-menu-select" tabindex="1" data-profile-payment style="color: rgb(85, 85, 85); font-weight: 500;">
                                            <div class="select">
                                                @if($model->selectedPaymentId != null)
                                                    @foreach($model->payments as $payment)
                                                        @if($payment->id == $model->selectedPaymentId)
                                                            <span>{{ $payment->name }}</span>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <span>Выберите способ оплаты</span>
                                                @endif
                                                <i class="fa fa-caret-down"></i>
                                            </div>
                                            <input type="hidden" name="gender">
                                            <ul class="dropeddown" style="display: none;">
                                                @foreach($model->payments as $payment)
                                                    <li v-on:click="setSelectedPaymentId({{$payment->id}})">{{ $payment->name }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="drop-menu-select" tabindex="1" data-profile-delivery style="color: rgb(85, 85, 85); font-weight: 500;">
                                            <div class="select">
                                                @if($model->selectedDeliveryId != null)
                                                @foreach($model->deliveries as $delivery)
                                                    @if($delivery->id == $model->selectedDeliveryId)
                                                        <span>{{ $delivery->name }}</span>
                                                    @endif
                                                @endforeach
                                                @else
                                                    <span>Выберите способ доставки</span>
                                                @endif
                                                <i class="fa fa-caret-down"></i>
                                            </div>
                                            <input type="hidden" name="gender">
                                            <ul class="dropeddown" style="display: none;">
                                                @foreach($model->deliveries as $delivery)
                                                    <li v-on:click="setSelectedDeliveryId({{$delivery->id}})">{{ $delivery->name }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text"
                                                   data-profile-address
                                                   v-model="address"
                                                   placeholder="Адрес доставки" class="form-control black-input">
                                        </div>
                                    </div>

                                    <div class="profile-item-save">
                                        <button type="submit" class="theme-btn btn-black" href="#"> Сохранить </button>
                                    </div>
                                </form>
                            </div>
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

@push('js')
<script defer src="/template/js/main.js"></script>
{{--<script defer src="/template/plugins/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>--}}
@endpush