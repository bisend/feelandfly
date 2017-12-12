<!-- Modal -->
<div class="modal fade pop-up-messege" role="dialog" aria-hidden="true" tabindex="-1" data-social-email>
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form @submit.prevent="validateBeforeSubmit">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" data-social-email-close>&times;</button>
                    <h4 class="modal-title">Вход</h4>
                </div>
                <div class="modal-body">
                    <p style="text-align: center">Укажите email адрес для входа</p>
                    <input type="email"
                           v-model="email"
                           class="form-control social-email-input"
                           placeholder="Email"
                           data-social-email-input>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="theme-btn btn-white small-btn">
                        Подтвердить
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>