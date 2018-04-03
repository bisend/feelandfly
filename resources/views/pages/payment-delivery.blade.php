@extends('layout')

@section('content')
    <!-- CONTENT AREA -->
    <article class="margin-after-header">

        <!--Breadcrumb Section Start-->
        <section class="breadcrumb-bg">
            <div class="theme-container container ">
                <div class="site-breadcumb white-clr breadcrumb-dis-block">
                    <h2 class="section-title wht fsz-36">{{ trans('profile.my_profile') }}</h2>
                    <ol class="breadcrumb breadcrumb-menubar">
                        <li>
                            <a href="{{ url_home($model->language) }}">
                                {{ trans('profile.home') }}
                            </a>
                            {{ trans('profile.payment_delivery') }}
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
                <aside class="col-md-3 col-sm-12 sidebar">
                    <div class="widget-wrap">
                        <h2 class="widget-title title-profile-bar">{{ trans('profile.my_profile') }}</h2>
                        <ul class="account-list with-border">
                            <li><a href="{{ url_personal_info($model->language) }}">{{ trans('profile.personal_info') }}</a></li>
                            <li><a href="javascript:void(0);" style="color: #000;">{{ trans('profile.payment_delivery') }}</a></li>
                            <li><a href="{{ url_wish_list($model->language) }}">{{ trans('profile.wish_list') }}</a></li>
                            <li><a href="{{ url_my_orders($model->language) }}">{{ trans('profile.my_orders') }}</a></li>
                            <li><a href="/user/logout">{{ trans('profile.log_out') }}</a></li>
                        </ul>
                    </div>
                </aside>
                <!-- Sidebar Ends -->

                <div class="visible-xs pt-70"></div>

                <!-- Product Details Starts-->
                <aside class="col-md-9 col-sm-12" id="profile-payment-delivery">
                    <div class="profile-item">
                        <div class="profile-item-header">
                            <span><i class="fa fa-credit-card" aria-hidden="true"></i></span>{{ trans('profile.payment_delivery') }}
                        </div>
                        <div class="profile-item-body">
                            <div class="row">
                                <form @submit.prevent="validateBeforeSubmit">
                                    <div class="col-md-12 kab-margin-mob">
                                        <div class="form-group">
                                            <label>{{ trans('order.payment') }}:</label>
                                            <div class="order-payment-method">
                                                {{ trans('order.full_pre_payment') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 kab-margin-mob">
                                        <div class="form-group" data-profile-delivery>
                                            <label for="profile-delivery-field">
                                                {{ trans('order.delivery') }}:
                                                <span class="field-required">*</span>
                                            </label>
                                            <v-select v-model="delivery"
                                                      :transition="'slidedd'"
                                                      :placeholder="'{{ trans('order.choose_delivery') }}'"
                                                      :input-id="'profile-delivery-field'"
                                                      :label="'name'"
                                                      :searchable="false"
                                                      :options="deliveries"
                                                      :class="'country-select delivery-select'">
                                                <template slot="options" slot-scope="option">
                                                    @{{ option.name }}
                                                </template>
                                                <span v-cloak slot="no-options">
                                                    {{ trans('order.no_results') }}
                                                </span>
                                            </v-select>
                                        </div>
                                    </div>


                                    {{--NOVA POSHTA BLOCK--}}
                                    <div v-cloak v-if="delivery &&
                                        (delivery.name === 'Новая почта' ||
                                        delivery.name === 'Нова пошта')" class="np-block">

                                        <div class="col-md-12">
                                            <div class="form-group" data-profile-delivery-type>
                                                <label for="profile-type-field">Тип доставки:
                                                    <span class="field-required">*</span>
                                                </label>
                                                <v-select v-model="deliveryType"
                                                          :input-id="'profile-type-field'"
                                                          :transition="'slidedd'"
                                                          :placeholder="'Тип доставки'"
                                                          :max-height="'200px'"
                                                          :class="'country-select delivery-select'"
                                                          :searchable="false"
                                                          :options="['{{ trans('order.addressna_dostavka') }}', '{{ trans('order.number_warehouse') }}']">
                                                    <span v-cloak slot="no-options">
                                                        {{ trans('order.no_results') }}
                                                    </span>
                                                </v-select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="profile-item-save kab-margin-mob">
                                        <button type="submit" class="theme-btn btn-black">
                                            {{ trans('profile.save') }}
                                        </button>
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