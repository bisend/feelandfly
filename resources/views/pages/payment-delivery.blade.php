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

                                        {{--NP DELIVERY TYPE--}}
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
                                                          :label="'name'"
                                                          :options="deliveryTypes">
                                                    <template slot="options" slot-scope="option">
                                                        @{{ option.name }}
                                                    </template>
                                                    <span v-cloak slot="no-options">
                                                        {{ trans('order.no_results') }}
                                                    </span>
                                                </v-select>
                                            </div>
                                        </div>
                                        {{--NP DELIVERY TYPE END--}}

                                        {{--COUNTRY--}}
                                        <div v-if="deliveryType" class="col-md-12" data-profile-country>
                                            <div class="form-group">
                                                <label for="profile-country-field">
                                                    {{ trans('order.country') }}:
                                                    <span class="field-required">*</span>
                                                </label>
                                                <v-select v-if="deliveryType &&
                                                          (deliveryType.name === 'Номер отделения' ||
                                                          deliveryType.name === 'Номер відділення')"
                                                          v-model="country"
                                                          :input-id="'profile-country-field'"
                                                          :transition="'slidedd'"
                                                          :placeholder="'{{ trans('order.choose_country') }}'"
                                                          :max-height="'200px'"
                                                          :class="'country-select'"
                                                          {{--:searchable="false"--}}
                                                          :disabled="true"
                                                          :label="'name'"
                                                          :options="DEFAULT_COUNTRY">
                                                    <span v-cloak slot="no-options">
                                                        {{ trans('order.no_results') }}
                                                    </span>
                                                </v-select>

                                                <v-select v-else
                                                          v-model="country"
                                                          :input-id="'profile-country-field'"
                                                          :transition="'slidedd'"
                                                          :placeholder="'{{ trans('order.choose_country') }}'"
                                                          :max-height="'200px'"
                                                          :class="'country-select'"
                                                          :label="'name'"
                                                          :options="countries">
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
                                             v-if="country &&
                                             deliveryType &&
                                             (country.name === 'Украина' ||
                                              country.name === 'Україна') &&
                                              (deliveryType.name === 'Номер отделения' ||
                                              deliveryType.name === 'Номер відділення')">
                                            {{--CITY--}}
                                            <div class="col-md-12">
                                                <div class="form-group" data-profile-city>
                                                    <label for="order-city-field">{{ trans('order.city') }}:
                                                        <span class="field-required">*</span>
                                                    </label>
                                                    <v-select v-model="city"
                                                              @search="searchCity"
                                                              :input-id="'order-city-field'"
                                                              :transition="'slidedd'"
                                                              :max-height="'200px'"
                                                              :placeholder="'{{ trans('order.enter_city') }}'"
                                                              :on-change="searchWarehouses"
                                                              :filterable="false"
                                                              :class="'country-select'"
                                                              label="{{ $model->language == 'ru' ? 'DescriptionRu' : 'Description' }}"
                                                              :options="cities">
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
                                                <div class="form-group" data-profile-warehouse>
                                                    <label for="order-warehouse-field">{{ trans('order.warehouse') }}:
                                                        <span class="field-required">*</span>
                                                    </label>
                                                    <v-select v-model="warehouse"
                                                              :input-id="'order-warehouse-field'"
                                                              :transition="'slidedd'"
                                                              :max-height="'200px'"
                                                              :placeholder="'{{ trans('order.choose_warehouse') }}'"
                                                              :filterable="true"
                                                              :disabled="disableWarehouse"
                                                              :class="'country-select'"
                                                              :label="'Number'"
                                                              :options="warehouses">
                                                        <template slot="selected-option" slot-scope="option">
                                                            <span v-if="lang === 'ru' && option.ShortAddressRu !== ''">
                                                                №@{{ option.Number }}:
                                                                @{{ option.ShortAddressRu }}
                                                            </span>
                                                            <span v-else>
                                                                №@{{ option.Number }}:
                                                                @{{ option.ShortAddress }}
                                                            </span>
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

                                        <div v-show="country &&
                                        deliveryType &&
                                        (deliveryType.name === 'Адресная доставка' ||
                                        deliveryType.name === 'Адресна доставка')">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="profile-a-street-field">{{ trans('order.a_street_house_room') }}:
                                                        <span class="field-required">*</span>
                                                    </label>
                                                    <input type="text"
                                                           id="profile-a-street-field"
                                                           data-profile-a-street
                                                           v-model="aStreet"
                                                           placeholder="{{ trans('order.a_enter_str') }}"
                                                           class="form-control black-input">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="profile-a-land-field">{{ trans('order.a_land_area_region') }}: <span class="field-required">*</span></label>
                                                    <input type="text"
                                                           id="profile-a-land-field"
                                                           data-profile-a-land
                                                           v-model="aLand"
                                                           placeholder="{{ trans('order.a_enter_land') }}"
                                                           class="form-control black-input">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="profile-a-city-field">{{ trans('order.a_city') }}: <span class="field-required">*</span></label>
                                                    <input type="text"
                                                           id="profile-a-city-field"
                                                           data-profile-a-city
                                                           v-model="aCity"
                                                           placeholder="{{ trans('order.a_enter_city') }}"
                                                           class="form-control black-input">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="profile-a-index-field">{{ trans('order.a_post_index') }}:</label>
                                                    <input type="text"
                                                           id="profile-a-index-field"
                                                           data-profile-a-index
                                                           v-model="aIndex"
                                                           placeholder="{{ trans('order.a_enter_index') }}"
                                                           class="form-control black-input">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    {{--NOVA POSHTA END--}}

                                    {{--SELF-CHECKOUT MARKS--}}
                                    <div v-cloak v-show="delivery &&
                                        (delivery.name === 'Самовывоз' ||
                                        delivery.name === 'Самовивіз')" class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-group" data-profile-points>
                                                <label for="order-points-field">{{ trans('order.points') }}:
                                                    <span class="field-required">*</span>
                                                </label>
                                                <v-select v-model="checkoutPoint"
                                                          :input-id="'profile-points-field'"
                                                          :transition="'slidedd'"
                                                          :placeholder="'{{ trans('order.choose_point') }}'"
                                                          :max-height="'200px'"
                                                          :class="'country-select'"
                                                          :searchable="false"
                                                          :label="'name'"
                                                          :options="checkoutPoints">
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