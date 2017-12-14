@component('mail::message')
# {{ trans('email.new_order') }} № {{ $model->order->order_number }}

{{ trans('email.new_order_from') }} {{ $username }}.

@component('mail::table')
| Фото | {{ trans('email.product_name') }} | {{ trans('email.color') }} | {{ trans('email.size') }} | {{ trans('email.price') }} | {{ trans('email.count') }} | {{ trans('email.sum') }} |
| :-------------: | :---------------------------------- | :--------: | :--------: | :----------: | :-----------: | :----------: |
@foreach($cartService->cart as $cartItem)
    | <a href="{{ url_product($cartItem['product']->slug, $model->language) }}"><img height="65px" src="{{ url('/') }}/{{ $cartItem['product']->images[0]->small }}" alt=""></a> | <a href="{{ url_product($cartItem['product']->slug, $model->language) }}">{{ $cartItem['product']->name }}</a> | <div class="product-color" style="background-color: {{ $cartItem['product']->color->html_code }};"></div> | <div class="product-size" style="">{{ $cartItem['product']->sizes[0]->name }}</div> | {{ $cartItem['product']->price[0]->price }} грн | {{ $cartItem['count'] }} | {{ set_format_price($cartItem['product']->price[0]->price, $cartItem['count']) }} грн |
@endforeach
@endcomponent
{{ trans('email.to_pay') }}: <span style="font-weight: 600; color: #ed1c24">{{ set_format_price($model->order->total_order_amount) }}</span> грн

<table>
    <tr>
        <td>{{ trans('email.customer') }}:</td>
        <td>{{ $username }}</td>
    </tr>
    <tr>
        <td>E-mail:</td>
        <td>{{ $model->order->email }}</td>
    </tr>
    <tr>
        <td>Телефон:</td>
        <td>{{ $model->order->phone_number }}</td>
    </tr>
    <tr>
        <td>{{ trans('email.payment') }}:</td>
        <td>
            @foreach ($model->payments as $payment)
                @if($payment->id == $model->order->payment_id)
                    {{ $payment->name }}
                @endif
            @endforeach
        </td>
    </tr>
    <tr>
        <td>{{ trans('email.delivery') }}:</td>
        <td>
            @foreach ($model->deliveries as $delivery)
                @if($delivery->id == $model->order->delivery_id)
                    {{ $delivery->name }}
                @endif
            @endforeach
        </td>
    </tr>
    <tr>
        <td>{{ trans('email.address') }}:</td>
        <td>{{ $model->order->address_delivery }}</td>
    </tr>

    @if($model->order->comment != null)
        <tr>
            <td>{{ trans('email.comment') }}:</td>
            <td>{{ $model->order->comment }}</td>
        </tr>
    @endif
</table>

<br>
{{ trans('email.thanks') }},<br>
{{ trans('email.shop') }} {{ config('app.name') }}
@endcomponent