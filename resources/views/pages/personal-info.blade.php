@extends('layout')

@section('content')

    <!-- CONTENT AREA -->
    <article class="margin-after-header">

        <!--Breadcrumb Section Start-->
        <section class="breadcrumb-bg">
            <div class="container ">
                <div class="site-breadcumb white-clr breadcrumb-dis-block">
                    <h2 class="section-title wht fsz-36">{{ trans('profile.my_profile') }}</h2>
                    <ol class="breadcrumb breadcrumb-menubar">
                        <li>
                            <a href="{{ url_home($model->language) }}">
                                {{ trans('profile.home') }}
                            </a>
                            {{ trans('profile.personal_info') }}
                        </li>
                    </ol>
                </div>
            </div>
        </section>
        <!--Breadcrumb Section End-->

        <!-- Page Starts-->
        <div class="container ptb-70">
            <div class="row">
                <!-- Sidebar Starts -->
                <aside class="col-md-3 col-sm-4 sidebar">
                    <div class="widget-wrap">
                        <h2 class="widget-title title-profile-bar">{{ trans('profile.my_profile') }}</h2>
                        <ul class="account-list with-border">
                            <li><a href="javascript:void(0);" style="color: #000;">{{ trans('profile.personal_info') }}</a></li>
                            <li><a href="{{ url_payment_delivery($model->language) }}">{{ trans('profile.payment_delivery') }}</a></li>
                            <li><a href="{{ url_wish_list($model->language) }}">{{ trans('profile.wish_list') }}</a></li>
                            <li><a href="{{ url_my_orders($model->language) }}">{{ trans('profile.my_orders') }}</a></li>
                            <li><a href="/user/logout">{{ trans('profile.log_out') }}</a></li>
                        </ul>
                    </div>
                </aside>
                <!-- Sidebar Ends -->

                <div class="visible-xs pt-70"></div>

                <!-- Product Details Starts-->
                <aside class="col-md-9 col-sm-8">
                    <div class="profile-item">
                        <div class="profile-item-header">
                            <span><i class="fa fa-user" aria-hidden="true"></i></span>{{ trans('profile.personal_info') }}
                        </div>
                        <div class="profile-item-body" id="personal-info">
                            <div class="row">
                                <form @submit.prevent="validateBeforeSubmit">
                                    {{ csrf_field() }}
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="profile-name-input">
                                                {{ trans('profile.name') }}:
                                                <span class="field-required">*</span>
                                            </label>
                                            <input type="text"
                                                   id="profile-name-input"
                                                   data-profile-name
                                                   v-model="name"
                                                   placeholder="{{ trans('profile.name') }}"
                                                   class="form-control black-input">
                                        </div>
                                    </div>
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<input type="text" placeholder="Прізвище" class="form-control black-input">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="profile-email-input">
                                                {{ trans('profile.email') }}:
                                                <span class="field-required">*</span>
                                            </label>
                                            <input type="text"
                                                   data-profile-email
                                                   id="profile-email-input"
                                                   v-model="email"
                                                   placeholder="{{ trans('profile.email') }}"
                                                   class="form-control black-input">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="profile-phone-input">
                                                {{ trans('profile.phone') }}:
                                                <span class="field-required">*</span>
                                            </label>
                                            <the-mask type="tel"
                                                      id="profile-phone-input"
                                                      data-profile-phone
                                                      mask="(###)-###-##-##"
                                                      :masked="true"
                                                      v-model="phone"
                                                      placeholder="(___)-___-__-__"
                                                      class="form-control black-input"></the-mask>
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

                    <div class="profile-item">
                        <div class="profile-item-header">
                            <span><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>{{ trans('profile.change_password') }}
                        </div>
                        <div class="profile-item-body" id="change-password">
                            <form @submit.prevent="validateBeforeSubmit">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="profile-old-password-input">
                                                {{ trans('profile.old_password') }}:
                                                <span class="field-required">*</span>
                                            </label>
                                            <input type="password"
                                                   id="profile-old-password-input"
                                                   data-profile-old-password
                                                   v-model="oldPassword"
                                                   placeholder="{{ trans('profile.old_password') }}"
                                                   class="form-control black-input">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="profile-new-password-input">
                                                {{ trans('profile.new_password') }}:
                                                <span class="field-required">*</span>
                                            </label>
                                            <input type="password"
                                                   data-profile-new-password
                                                   id="profile-new-password-input"
                                                   v-model="newPassword"
                                                   placeholder="{{ trans('profile.new_password') }}"
                                                   class="form-control black-input">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="profile-confirm-password-input">
                                                {{ trans('profile.repeat') }}:
                                                <span class="field-required">*</span>
                                            </label>
                                            <input type="password"
                                                   id="profile-confirm-password-input"
                                                   data-profile-confirm-new-password
                                                   v-model="confirmNewPassword"
                                                   placeholder="{{ trans('profile.repeat') }}"
                                                   class="form-control black-input">
                                        </div>
                                    </div>

                                    <div class="profile-item-save kab-margin-mob">
                                        <button type="submit" class="theme-btn btn-black">
                                            {{ trans('profile.save') }}
                                        </button>
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