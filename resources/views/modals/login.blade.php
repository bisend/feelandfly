<div class="modal fade popups-wrap popups-dark white-clr" id="login-popup" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <h2 class="fsz-30 section-title"> ДОБРО ПОЖАЛОВАТЬ В НАШ МАГАЗИН </h2>
                    <!--<p class="sub-detail fsz-16"> Login and buy </p>-->
                    <div class="row">
                        <div class="col-sm-6 pb-25">
                            <a href="/user/login/facebook{{ $model->language == 'uk' ? '/' . $model->language : '' }}" class="theme-btn btn-white small-btn"> <i class="fa fa-facebook"></i>
                                <span>Facebook</span>
                            </a>
                        </div>
                        <div class="col-sm-6 pb-25">
                            <a href="/user/login/google{{ $model->language == 'uk' ? '/' . $model->language : '' }}" class="theme-btn btn-white small-btn">
                                <i class="fa fa-google-plus"></i>
                                <span>Google+</span>
                            </a>
                        </div>
                    </div>
                    <div class="login-form">
                        <p class="fsz-18 section-title pb-25">
                            ВОЙДИТЕ В ПРОФИЛЬ
                        </p>
                        <form class="login" @submit.prevent="validateBeforeSubmit">
                            <div class="form-group auth-form-group">
                                <input data-login-email
                                       type="text"
                                       v-model="email"
                                       placeholder="Електронный адрес" class="form-control">
                            </div>
                            <div class="form-group auth-form-group">
                                <input data-login-password
                                       type="password"
                                       v-model="password"
                                       placeholder="Пароль" class="form-control">
                            </div>
                            <div class="form-group">
                                <button class="theme-btn btn-white-1 small-btn" type="submit">
                                    Войти
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>