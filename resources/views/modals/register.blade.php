<div class="modal fade popups-wrap popups-dark white-clr" id="register-popup" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <button type="button" class="close close-btn popup-cls" data-dismiss="modal" aria-label="Close">
                <i class="fa-times fa"></i> </button>
            <div class="login-wrap">
                <div class="col-sm-4 text-center">
                    <div class="pb-30">
                        <a href="{{ url_home($model->language) }}">
                            <img alt="logo" src="/img/template/logo/logo-white.png">
                        </a>
                    </div>
                </div>
                <div class="col-sm-7">
                    <h2 class="fsz-30 section-title">{{ trans('register-modal.title') }}</h2>
                    <!--<p class="sub-detail fsz-16"> Login and buy </p>-->
                    <div class="row">
                        <div class="col-sm-6 pb-25">
                            <a href="/user/login/facebook{{ $model->language == 'uk' ? '/' . $model->language : '' }}"
                               class="theme-btn btn-white small-btn"> <i class="fa fa-facebook"></i>
                                <span>Facebook</span>
                            </a>
                        </div>
                        <div class="col-sm-6 pb-25">
                            <a href="/user/login/google{{ $model->language == 'uk' ? '/' . $model->language : '' }}"
                               class="theme-btn btn-white small-btn">
                                <i class="fa fa-google-plus"></i>
                                <span>Google+</span>
                            </a>
                        </div>
                    </div>
                    <div class="login-form">
                        <p class="fsz-18 section-title pb-25">
                            {{ trans('register-modal.register_profile') }}
                        </p>
                        <form method="POST" class="login" @submit.prevent="validateBeforeSubmit">
                            <div class="form-group auth-form-group">
                                <label for="register-modal-input-name">
                                    {{ trans('register-modal.name') }}:
                                    <span class="field-required">*</span>
                                </label>
                                <input data-register-name
                                       id="register-modal-input-name"
                                       v-model="name"
                                       name="name"
                                       autocomplete="off"
                                       type="text"
                                       placeholder="{{ trans('register-modal.name') }}"
                                       class="form-control">
                            </div>
                            <div class="form-group auth-form-group">
                                <label for="register-modal-input-email">
                                    {{ trans('register-modal.email') }}:
                                    <span class="field-required">*</span>
                                </label>
                                <input data-register-email
                                       id="register-modal-input-email"
                                       v-model="email"
                                       name="email"
                                       autocomplete="off"
                                       type="text"
                                       placeholder="{{ trans('register-modal.email') }}"
                                       class="form-control">
                            </div>
                            <div class="form-group auth-form-group">
                                <label for="register-modal-input-password">
                                    {{ trans('register-modal.password') }}:
                                    <span class="field-required">*</span>
                                </label>
                                <input data-register-password
                                       id="register-modal-input-password"
                                       v-model="password"
                                       name="password"
                                       type="password"
                                       placeholder="{{ trans('register-modal.password') }}"
                                       class="form-control">
                            </div>
                            <div class="form-group auth-form-group">
                                <label for="register-modal-input-confirm">
                                    {{ trans('register-modal.confirm') }}:
                                    <span class="field-required">*</span>
                                </label>
                                <input data-register-confirm
                                       id="register-modal-input-confirm"
                                       v-model="confirmPassword"
                                       name="confirm"
                                       type="password"
                                       placeholder="{{ trans('register-modal.confirm') }}"
                                       class="form-control">
                            </div>
                            <div class="form-group auth-form-group">
                                <button class="theme-btn btn-white-1 small-btn" type="submit">
                                    {{ trans('register-modal.register') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>