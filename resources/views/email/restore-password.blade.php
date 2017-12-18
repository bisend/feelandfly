@component('mail::message')
# {{ trans('email.restore_password') }}

{{ trans('email.welcome') }}, {{ $user->name }}.

{{ trans('email.your_new_password') }}:

# {{ $password }}

{{ trans('email.can_change_password') }}

{{ trans('email.thanks') }},<br>
{{ trans('email.shop') }} {{ config('app.name') }}
@endcomponent
