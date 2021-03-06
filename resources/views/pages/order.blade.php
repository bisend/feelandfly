@extends('layout')

@section('content')
    <!-- CONTENT AREA -->
    <article id="order-confirm" class="margin-after-header">

        <!--Breadcrumb Section Start-->
        <section class="breadcrumb-bg">
            <div class="container ">
                <div class="site-breadcumb white-clr no-flex-title">

                    {{--EDIT ORDER BUTTON--}}
                    <div class="edit-order-btn">
                        <a class="theme-btn btn-black" href="javascript:void(0);" data-target="#big-cart" data-toggle="modal">
                            {{ trans('order.edit_order') }}
                        </a>
                    </div>

                    {{--BREADCRUMB--}}
                    <h2 class="section-title wht fsz-36"> {{ trans('order.order_confirm') }} </h2>
                    <ol class="breadcrumb breadcrumb-menubar">
                        <li> <a href="{{ url_home($model->language) }}"> {{ trans('profile.home') }} </a> {{ trans('order.order_confirm') }} </li>
                    </ol>
                </div>
            </div>
        </section>
        <!--Breadcrumb Section End-->

        <!-- Page Starts-->
        <div class="container ptb-70">
            <div class="row">


                {{--ORDER FIELDS TO FILL--}}
                <aside class="col-md-7 col-sm-12">
                    <form @submit.prevent="validateBeforeSubmit">

                        <div class="profile-item">
                            <div class="profile-item-header">
                                <span><i class="fa fa-user" aria-hidden="true"></i></span> {{ trans('order.contact_data') }}
                            </div>
                            <div class="profile-item-body">
                                <div class="row">

                                    {{--NAME--}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="order-name-field">{{ trans('order.name') }}: <span class="field-required">*</span></label>
                                            <input type="text"
                                                   id="order-name-field"
                                                   data-order-name
                                                   v-model="orderConfirm.name"
                                                   placeholder="{{ trans('order.enter_name') }}"
                                                   class="form-control black-input">
                                        </div>
                                    </div>
                                    {{--NAME END--}}

                                    {{--PHONE--}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="order-phone-field">{{ trans('order.phone') }}: <span class="field-required">*</span></label>
                                            <the-mask type="tel"
                                                      id="order-phone-field"
                                                      data-order-phone
                                                      mask="(###)-###-##-##"
                                                      :masked="true"
                                                      v-model="orderConfirm.phone"
                                                      placeholder="(___)-___-__-__"
                                                      class="form-control black-input"></the-mask>
                                        </div>
                                    </div>
                                    {{--PHONE END--}}

                                    {{--EMAIL--}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="order-email-field">E-mail: <span class="field-required">*</span></label>
                                            <input type="email"
                                                   id="order-email-field"
                                                   data-order-email
                                                   v-model="orderConfirm.email"
                                                   placeholder="{{ trans('order.enter_email') }}"
                                                   class="form-control black-input">
                                        </div>
                                    </div>
                                    {{--EMAIL END--}}
                                </div>
                            </div>
                        </div>

                        <div class="profile-item order-dev">

                            <div class="profile-item-header">
                                <span><i class="fa fa-truck" aria-hidden="true"></i></span>{{ trans('order.payment_delivery') }}
                            </div>

                            <div class="profile-item-body">
                                <div class="row">

                                    {{--PAYMENT--}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ trans('order.payment') }}:</label>
                                            <div class="order-payment-method">
                                                {{ trans('order.full_pre_payment') }}
                                            </div>
                                        </div>
                                    </div>
                                    {{--PAYMENT END--}}

                                    {{--DELIVERY--}}
                                    <div class="col-md-12">
                                        <div class="form-group" data-order-delivery>
                                            <label for="order-delivery-field">{{ trans('order.delivery') }}: <span class="field-required">*</span></label>
                                            <v-select v-model="orderConfirm.delivery"
                                                      :transition="'slidedd'"
                                                      :placeholder="'{{ trans('order.choose_delivery') }}'"
                                                      :input-id="'order-delivery-field'"
                                                      :searchable="false"
                                                      :label="'name'"
                                                      :options="orderConfirm.deliveries"
                                                      :class="'country-select'">
                                                <template slot="options" slot-scope="option">
                                                    @{{ option.name }}
                                                </template>
                                                <span v-cloak slot="no-options">
                                                    {{ trans('order.no_results') }}
                                                </span>
                                            </v-select>
                                        </div>
                                    </div>
                                    {{--DELIVERY END--}}

                                    {{--NOVA POSHTA BLOCK--}}
                                    <div v-cloak v-if="orderConfirm.delivery &&
                                        (orderConfirm.delivery.name === 'Новая почта' ||
                                        orderConfirm.delivery.name === 'Нова пошта')" class="np-block">

                                        <div class="col-md-12">
                                            <div class="form-group" data-order-delivery-type>
                                                <label for="order-type-field">Тип доставки: <span class="field-required">*</span></label>
                                                <v-select v-model="orderConfirm.deliveryType"
                                                          :input-id="'order-type-field'"
                                                          :transition="'slidedd'"
                                                          :placeholder="'Тип доставки'"
                                                          :max-height="'200px'"
                                                          :class="'country-select'"
                                                          :searchable="false"
                                                          :label="'name'"
                                                          :options="orderConfirm.deliveryTypes">
                                                    <template slot="options" slot-scope="option">
                                                        @{{ option.name }}
                                                    </template>
                                                    <span v-cloak slot="no-options">
                                                        {{ trans('order.no_results') }}
                                                    </span>
                                                </v-select>
                                            </div>
                                        </div>

                                        {{--COUNTRY--}}
                                        <div v-if="orderConfirm.deliveryType" class="col-md-12" data-order-country>
                                            <div class="form-group">
                                                <label for="order-country-field">{{ trans('order.country') }}: <span class="field-required">*</span></label>
                                                <v-select v-if="orderConfirm.deliveryType &&
                                                          (orderConfirm.deliveryType.name === 'Номер отделения' ||
                                                          orderConfirm.deliveryType.name === 'Номер відділення')"
                                                          v-model="orderConfirm.country"
                                                          :input-id="'order-country-field'"
                                                          :transition="'slidedd'"
                                                          :placeholder="'{{ trans('order.choose_country') }}'"
                                                          :max-height="'200px'"
                                                          :class="'country-select'"
                                                          {{--:searchable="false"--}}
                                                          :disabled="true"
                                                          :label="'name'"
                                                          :options="[DEFAULT_COUNTRY]">
                                                    <span v-cloak slot="no-options">
                                                        {{ trans('order.no_results') }}
                                                    </span>
                                                </v-select>

                                                <v-select v-else
                                                          v-model="orderConfirm.country"
                                                          :input-id="'order-country-field'"
                                                          :transition="'slidedd'"
                                                          :placeholder="'{{ trans('order.choose_country') }}'"
                                                          :max-height="'200px'"
                                                          :class="'country-select'"
                                                          :label="'name'"
                                                          :options="orderConfirm.countries">
                                                    <template slot="options" slot-scope="option">
                                                        @{{ option.name }}
                                                    </template>
                                                    <span v-cloak slot="no-options">
                                                        {{ trans('order.no_results') }}
                                                    </span>
                                                </v-select>
                                            </div>
                                        </div>
                                        {{--COUNTRY END--}}

                                        <div v-cloak
                                             v-if="orderConfirm.country &&
                                             orderConfirm.deliveryType &&
                                             (orderConfirm.country.name === 'Украина' ||
                                              orderConfirm.country.name === 'Україна') &&
                                              (orderConfirm.deliveryType.name === 'Номер отделения' ||
                                              orderConfirm.deliveryType.name === 'Номер відділення')">
                                            {{--CITY--}}
                                            <div class="col-md-12">
                                                <div class="form-group" data-order-city>
                                                    <label for="order-city-field">{{ trans('order.city') }}: <span class="field-required">*</span></label>
                                                    <v-select v-model="orderConfirm.city"
                                                              @search="searchCity"
                                                              :input-id="'order-city-field'"
                                                              :transition="'slidedd'"
                                                              :max-height="'200px'"
                                                              :placeholder="'{{ trans('order.enter_city') }}'"
                                                              :on-change="searchWarehouses"
                                                              :filterable="false"
                                                              :class="'country-select'"
                                                              label="{{ $model->language == 'ru' ? 'DescriptionRu' : 'Description' }}"
                                                              :options="orderConfirm.cities">
                                                        <template slot="option" slot-scope="option">
                                                            @{{ (lang == 'ru') ? option.DescriptionRu : option.Description }}
                                                        </template>
                                                        <span v-cloak slot="no-options">
                                                            {{ trans('order.no_results') }}
                                                        </span>
                                                    </v-select>
                                                </div>
                                            </div>
                                            {{--CITY END--}}

                                            {{--WAREHOUSE--}}
                                            <div class="col-md-12">
                                                <div class="form-group" data-order-warehouse>
                                                    <label for="order-warehouse-field">{{ trans('order.warehouse') }}: <span class="field-required">*</span></label>
                                                    <v-select v-model="orderConfirm.warehouse"
                                                              :input-id="'order-warehouse-field'"
                                                              :transition="'slidedd'"
                                                              :max-height="'200px'"
                                                              :placeholder="'{{ trans('order.choose_warehouse') }}'"
                                                              :filterable="true"
                                                              :disabled="orderConfirm.disableWarehouse"
                                                              :class="'country-select'"
                                                              :label="'Number'"
                                                              :options="orderConfirm.warehouses">
                                                        <template slot="selected-option" slot-scope="option">
                                                            <span v-if="lang === 'ru'">
                                                                @{{ option.DescriptionRu }}
                                                            </span>
                                                            <span v-else>
                                                                @{{ option.Description }}
                                                            </span>
                                                            {{--<span v-if="lang === 'ru' && option.ShortAddressRu !== ''">--}}
                                                                {{--№@{{ option.Number }}:--}}
                                                                {{--@{{ option.ShortAddressRu }}--}}
                                                            {{--</span>--}}
                                                            {{--<span v-else>--}}
                                                                {{--№@{{ option.Number }}:--}}
                                                                {{--@{{ option.ShortAddress }}--}}
                                                            {{--</span>--}}
                                                        </template>
                                                        <template slot="option" slot-scope="option">
                                                            @{{ (lang == 'ru') ? option.DescriptionRu : option.Description }}
                                                        </template>
                                                        <span v-cloak slot="no-options">
                                                    {{ trans('order.no_results') }}
                                                </span>
                                                    </v-select>
                                                </div>
                                            </div>
                                            {{--WAREHOUSE END--}}
                                        </div>

                                        <div v-show="orderConfirm.country &&
                                        orderConfirm.deliveryType &&
                                        (orderConfirm.deliveryType.name === 'Адресная доставка' ||
                                        orderConfirm.deliveryType.name === 'Адресна доставка')">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="order-a-street-field">{{ trans('order.a_street_house_room') }}: <span class="field-required">*</span></label>
                                                    <input type="text"
                                                           id="order-a-street-field"
                                                           data-order-a-street
                                                           v-model="orderConfirm.aStreet"
                                                           placeholder="{{ trans('order.a_enter_str') }}"
                                                           class="form-control black-input">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="order-a-land-field">{{ trans('order.a_land_area_region') }}: <span class="field-required">*</span></label>
                                                    <input type="text"
                                                           id="order-a-land-field"
                                                           data-order-a-land
                                                           v-model="orderConfirm.aLand"
                                                           placeholder="{{ trans('order.a_enter_land') }}"
                                                           class="form-control black-input">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="order-a-city-field">{{ trans('order.a_city') }}: <span class="field-required">*</span></label>
                                                    <input type="text"
                                                           id="order-a-city-field"
                                                           data-order-a-city
                                                           v-model="orderConfirm.aCity"
                                                           placeholder="{{ trans('order.a_enter_city') }}"
                                                           class="form-control black-input">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="order-a-index-field">{{ trans('order.a_post_index') }}:</label>
                                                    <input type="text"
                                                           id="order-a-index-field"
                                                           data-order-a-index
                                                           v-model="orderConfirm.aIndex"
                                                           placeholder="{{ trans('order.a_enter_index') }}"
                                                           class="form-control black-input">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--NOVA POSHTA BLOCK END--}}


                                    {{--SELF-CHECKOUT MARKS--}}
                                    <div v-cloak v-show="orderConfirm.delivery &&
                                        (orderConfirm.delivery.name === 'Самовывоз' ||
                                        orderConfirm.delivery.name === 'Самовивіз')" class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-group" data-order-points>
                                                <label for="order-points-field">{{ trans('order.points') }}: <span class="field-required">*</span></label>
                                                <v-select v-model="orderConfirm.checkoutPoint"
                                                          :input-id="'order-points-field'"
                                                          :transition="'slidedd'"
                                                          order-a-index-field                   :placeholder="'{{ trans('order.choose_point') }}'"
                                                          :max-height="'200px'"
                                                          :class="'country-select'"
                                                          :searchable="false"
                                                          :label="'name'"
                                                          :options="orderConfirm.checkoutPoints">
                                                    <template slot="options" slot-scope="option">
                                                        @{{ option.name }}
                                                    </template>
                                                    <span v-cloak slot="no-options">
                                                        {{ trans('order.no_results') }}
                                                    </span>
                                                </v-select>
                                            </div>
                                        </div>
                                    </div>
                                    {{--SELF-CHECKOUT MARKS END--}}

                                    {{--COMMENT--}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ trans('order.comment') }}:</label>
                                            <textarea type="text"
                                                      v-model="orderConfirm.comment"
                                                      placeholder="{{ trans('order.comment') }}"
                                                      class="form-control black-input"></textarea>
                                        </div>
                                    </div>
                                    {{--COMMENT END--}}
                                </div>
                            </div>
                        </div>

                        {{--SUBMIT BTN--}}
                        <div class="order-save-btn">
                            <button type="submit" class="theme-btn btn-black">{{ trans('order.confirm') }}</button>
                        </div>
                        {{--SUBMIT BTN END--}}

                    </form>
                </aside>

                {{--ORDER PRODUCTS--}}
                <div class="col-md-5 col-sm-12">
                    <div class="profile-item">
                        <div class="profile-item-header">
                            <span><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>{{ trans('order.your_order') }}
                        </div>
                        <div class="profile-item-body">
                            <div class="order-products">

                                <div v-cloak class="order-prod-item" v-for="cartItem in cartItems">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <div class="order-prod-img">
                                                <a v-bind:href="'/product/' + cartItem.product.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'">
                                                    <img v-bind:src="cartItem.product.images[0].small" alt="">
                                                </a>

                                                <div v-if="cartItem.product.promotions != null && cartItem.product.promotions.length > 0 && cartItem.product.promotions[0].priority == 3"
                                                     class="prod-tag-1 font-2">
                                                    {{--<span> -@{{ cartItem.product.price[0].discount }}% </span>--}}
                                                    <span> SALE </span>
                                                </div>
                                                <div v-if="cartItem.product.promotions != null && cartItem.product.promotions.length > 0 && cartItem.product.promotions[0].priority == 1"
                                                     class="prod-tag-1 font-2 prod-tag-green">
                                                    <span> NEW </span>
                                                </div>
                                                <div v-if="cartItem.product.promotions != null && cartItem.product.promotions.length > 0 && cartItem.product.promotions[0].priority == 2"
                                                     class="prod-tag-1 font-2 prod-tag-violet">
                                                    <span> TOP </span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-8">
                                            <div class="order-detail-prod">

                                                <a class="prod-title block-inline" v-bind:href="'/product/' + cartItem.product.slug + '/{{ $model->language == 'ru' ? '' : $model->language }}'">
                                                    @{{ cartItem.product.name }}
                                                </a>
                                                <div class="productInfo-size-color">
                                                    <ul class="choose-clr list-inline border-hover">
                                                        <li>
                                                            <a class="active"
                                                               :style="{'background-color': '' + cartItem.product.color.html_code + ''}">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <ul class="choose-size list-inline border-hover">
                                                        <li>
                                                            <a class="active">
                                                                <span v-for="size in cartItem.product.sizes" v-if="size.id == cartItem.sizeId">
                                                                    @{{ size.name }}
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <p class="fsz-16 font-2 no-margin prod-price">
                                                    <span class="fw-300 gray-clr">
                                                        <span>@{{ cartItem.count }}</span> <sub>X</sub>
                                                    </span> @{{ cartItem.product.price[0].price }} грн
                                                    <del v-if="cartItem.product.promotions != null && cartItem.product.promotions.length > 0 && cartItem.product.promotions[0].priority == 3">
                                                        @{{ cartItem.product.price[0].old_price }} грн
                                                    </del>
                                                </p>
                                                <p class="fsz-16 font-2 no-margin order-prod-total">
                                                    {{ trans('order.sum') }}:<span>@{{ (cartItem.product.price[0].price * cartItem.count).toFixed(2) }} грн</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="order-total-price">
                                <p v-cloak class="fsz-18 font-2 no-margin order-prod-total">
                                    {{ trans('order.sum_order') }}:<span>@{{ totalAmount.toFixed(2) }} грн</span>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- / Page Ends -->


    </article>
    <!-- / CONTENT AREA -->
@endsection