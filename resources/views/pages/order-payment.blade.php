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
        <div class="container theme-container ptb-70">
            <div class="row">
                <div class="col-md-12">
                    <div>{{ trans('order.order_number') }}: {{ $model->order->order_number }}</div>
                    <div>Дата: {{ $model->order->created_at }}</div>
                    <div>{{ trans('order.sum') }}: {{ $model->order->total_order_amount }} грн</div>

                    @if(!is_null($model->order->country) && ($model->order->country != 'Украина' || $model->order->country != 'Україна'))
                        <div>{{ trans('order.delivery_price') }}: {{ trans('order.novaya_p2') }}</div>
                        <div>{{ trans('order.to_pay') }}: {{ set_format_price($model->order->total_order_amount + 400.00) }} грн</div>
                    @else
                        <div>{{ trans('order.delivery_price') }}: {{ trans('order.novaya_p') }}</div>
                    @endif

                    <div>Статус: {{ $model->status->name }}</div>
                </div>

                @if($model->status->is_default)
                    <div class="col-md-12">{{ trans('order.call') }}</div>
                    <div class="col-md-12">
                        {!! $model->form !!}
                    </div>
                @endif
            </div>
        </div>

    </article>
@endsection