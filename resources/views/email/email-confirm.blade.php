@component('mail::message')
# {{ trans('email.email_confirm') }}

{{ trans('email.welcome') }}, {{ $user->name }}.

{{ trans('email.for_confirm') }}
@component('mail::button', ['url' => $confirmationUrl])
{{ trans('email.confirm_email') }}
@endcomponent
<a href="{{ $confirmationUrl }}">{{ $confirmationUrl }}</a>

{{ trans('email.thanks') }},<br>
{{ trans('email.shop') }} {{ config('app.name') }}
@endcomponent
