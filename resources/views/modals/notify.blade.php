<!-- Modal -->
<div class="modal fade pop-up-messege" role="dialog" aria-hidden="true" tabindex="-1" data-notify>
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form @submit.prevent="validateBeforeSubmit">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" data-notify-close>&times;</button>
                    <h4 class="modal-title">{{ trans('layout.notify') }}</h4>
                </div>
                <div class="modal-body">
                    <p style="text-align: center">{{ trans('layout.notify_text') }}</p>
                    
                    <div class="form-group">
                            <label for="notify-email">{{ trans('profile.email') }}: <span class="field-required">*</span></label>
                            <input id="notify-email" type="email"
                               v-model="notify.email"
                               class="form-control black-input"
                               placeholder="{{ trans('profile.email') }}"
                               data-notify-email>
                        </div>
                    
                    <div class="form-group">
                        <label for="notify-name">{{ trans('profile.name') }}:</label>
                        <input id="notify-name" type="text"
                           v-model="notify.name"
                           class="form-control black-input"
                           placeholder="{{ trans('profile.name') }}"
                           data-notify-name>
                    </div>
                
                    <div class="form-group">
                        <label for="notify-count">{{ trans('layout.notify_count') }}: <span class="field-required">*</span></label>
                        <input id="notify-count" type="number"
                           v-model="notify.count"
                           @change="toInteger(notify.count)"
                           class="form-control black-input"
                           data-notify-count>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="theme-btn btn-white small-btn">
                        {{ trans('layout.submit_email') }}
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>