@extends('layout')

@section('content')
    <article class="margin-after-header">
        <!--Breadcrumb Section Start-->
        <section class="breadcrumb-bg">
            <div class="theme-container container ">
                <div class="site-breadcumb white-clr no-flex-title">
                    {{--BREADCRUMB--}}
                    <h2 class="section-title wht fsz-36"> {{ trans('order.order_payment') }} </h2>
                    <ol class="breadcrumb breadcrumb-menubar">
                        <li> <a href="{{ url_home($model->language) }}"> {{ trans('profile.home') }} </a> {{ trans('order.order_payment') }} </li>
                    </ol>
                </div>
            </div>
        </section>
        <!--Breadcrumb Section End-->

        <!-- Page Starts-->
        <div class="container theme-container ptb-70 payment-section">
            <div class="row">
                <div class="col-md-12">
                    <div class="payment-section-header">
                        Оплата заказа
                    </div>
                    <ul>
                        <li><span>{{ trans('order.order_number') }}</span>: {{ $model->order->order_number }}</li>
                        <li><span>Дата</span>: {{ $model->order->created_at }}</li>
                        <li><span>{{ trans('order.sum') }}</span>: {{ $model->order->total_order_amount }} грн</li>
                        @if(!is_null($model->order->country_code) && $model->order->country_code != 'UA')
                            <li><span>{{ trans('order.delivery_price') }}</span>: {{ trans('order.novaya_p2') }}</li>
                            <li><span>{{ trans('order.to_pay') }}</span>: {{ set_format_price($model->order->total_order_amount + 400.00) }} грн</li>
                        @else
                            <li><span>{{ trans('order.delivery_price') }}</span>: {{ trans('order.novaya_p') }}</li>
                        @endif
                        <li><span>Статус</span>: {{ $model->status->name }}</li>
                    </ul>

                </div>

                @if($model->status->is_default)
                    <div class="col-md-12 payment-section-text">{{ trans('order.call') }}</div>
                    <div class="col-md-12 payment-section-btn">
                        {!! $model->form !!}
                    </div>
                @endif
            </div>
        </div>

    </article>
@endsection