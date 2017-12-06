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
                    <h2 class="fsz-30 section-title"> ДОБРО ПОЖАЛОВАТЬ В НАШ МАГАЗИН </h2>
                    <!--<p class="sub-detail fsz-16"> Login and buy </p>-->
                    <div class="row">
                        <div class="col-sm-6 pb-25">
                            <a href="javascript:void(0);" class="theme-btn btn-white small-btn"> <i class="fa fa-facebook"></i>
                                <span>Facebook</span>
                            </a>
                        </div>
                        <div class="col-sm-6 pb-25">
                            <a href="javascript:void(0);" class="theme-btn btn-white small-btn">
                                <i class="fa fa-google-plus-square"></i>
                                <span>Google+</span>
                            </a>
                        </div>
                    </div>
                    <div class="login-form">
                        <p class="fsz-18 section-title pb-25">
                            ЗАРЕГИСТРИРУЙТЕ ПРОФИЛЬ
                        </p>
                        <form method="POST" class="login" @submit.prevent="validateBeforeSubmit">
                            <div class="form-group auth-form-group">
                                <input data-register-name
                                       v-model="name"
                                       name="name"
                                       autocomplete="off"
                                       type="text" placeholder="Имя" class="form-control">
                            </div>
                            <div class="form-group auth-form-group">
                                <input data-register-email
                                       v-model="email"
                                       name="email"
                                       autocomplete="off"
                                       type="text" placeholder="Електронный адрес" class="form-control">
                            </div>
                            <div class="form-group auth-form-group">
                                <input data-register-password
                                       v-model="password"
                                       name="password"
                                       type="password" placeholder="Пароль" class="form-control">
                            </div>
                            <div class="form-group auth-form-group">
                                <input data-register-confirm
                                       v-model="confirmPassword"
                                       name="confirm"
                                       type="password" placeholder="Подтвердите пароль" class="form-control">
                            </div>
                            <div class="form-group auth-form-group">
                                <button class="theme-btn btn-white-1 small-btn" type="submit">
                                    Зарегистрироваться
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>