@component('mail::message')
# {{ trans('email.your_order') }} № {{ $model->order->order_number }}

{{ trans('email.welcome') }}, {{ $username }}.

@component('mail::table')
| Фото | {{ trans('email.product_name') }} | {{ trans('email.color') }} | {{ trans('email.size') }} | {{ trans('email.price') }} | {{ trans('email.count') }} | {{ trans('email.sum') }} |
| :-------------: | :---------------------------------- | :--------: | :--------: | :----------: | :-----------: | :----------: |
@foreach($cartService->cart as $cartItem)
    | <a href="{{ url_product($cartItem['product']->slug, $model->language) }}">
        <img height="65px" src="{{ url('/') }}/{{ $cartItem['product']->images[0]->small }}" alt="">
    </a> |
    <a href="{{ url_product($cartItem['product']->slug, $model->language) }}">
        {{ $cartItem['product']->name }}</a>
    | <div class="product-color" style="background-color: {{ $cartItem['product']->color->html_code }};"></div> |
    <div class="product-size" style="">{{ $cartItem['product']->sizes[0]->name }}</div>
    | {{ $cartItem['product']->price[0]->price }} грн | {{ $cartItem['count'] }}
    | {{ set_format_price($cartItem['product']->price[0]->price, $cartItem['count']) }} грн |
@endforeach
@endcomponent

{{--<table>--}}
    {{--<thead>--}}
        {{--<tr>--}}
            {{--<th>Фото</th>--}}
            {{--<th>{{ trans('email.product_name') }}</th>--}}
            {{--<th>{{ trans('email.color') }}</th>--}}
            {{--<th>{{ trans('email.size') }}</th>--}}
            {{--<th>{{ trans('email.price') }}</th>--}}
            {{--<th>{{ trans('email.count') }}</th>--}}
            {{--<th>{{ trans('email.sum') }}</th>--}}
        {{--</tr>--}}
    {{--</thead>--}}
    {{--<tbody>--}}
    {{--@foreach($cartService->cart as $cartItem)--}}
        {{--<tr>--}}
            {{--<td>--}}
                {{--<a href="{{ url_product($cartItem['product']->slug, $model->language) }}">--}}
                    {{--<img height="65px" src="{{ url('/') }}/{{ $cartItem['product']->images[0]->small }}" alt="">--}}
                {{--</a>--}}
            {{--</td>--}}
            {{--<td>--}}
                {{--<a href="{{ url_product($cartItem['product']->slug, $model->language) }}">--}}
                    {{--{{ $cartItem['product']->name }}--}}
                {{--</a>--}}
            {{--</td>--}}
            {{--<td>--}}
                {{--<div class="product-color" style="background-color: {{ $cartItem['product']->color->html_code }};"></div>--}}
            {{--</td>--}}
            {{--<td>--}}
                {{--<div class="product-size" style="">--}}
                    {{--{{ $cartItem['product']->sizes[0]->name }}--}}
                {{--</div>--}}
            {{--</td>--}}
            {{--<td>--}}
                {{--{{ $cartItem['product']->price[0]->price }} грн--}}
            {{--</td>--}}
            {{--<td>--}}
                {{--{{ $cartItem['count'] }}--}}
            {{--</td>--}}
            {{--<td>--}}
                {{--{{ set_format_price($cartItem['product']->price[0]->price, $cartItem['count']) }} грн--}}
            {{--</td>--}}
        {{--</tr>--}}
    {{--@endforeach--}}
    {{--</tbody>--}}
{{--</table>--}}
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
            {{ trans('order.full_pre_payment') }}
        </td>
    </tr>
    <tr>
        <td>{{ trans('email.delivery') }}:</td>
        <td>
            @php($deliveryName = '')
            @foreach ($model->deliveries as $delivery)
                @if($delivery->id == $model->order->delivery_id)
                    @php($deliveryName = $delivery->name)
                    {{ $delivery->name }}
                @endif
            @endforeach
        </td>
    </tr>
    @if($deliveryName == 'Самовывоз' || $deliveryName == 'Самовивіз')

        @php($checkOutPointName = '')
        @foreach($model->checkoutPoints as $checkoutPoint)
            @if($model->order->checkout_point_id == $checkoutPoint->id)
                @php($checkOutPointName = $checkoutPoint->name)
            @endif
        @endforeach

        <tr>
            <td>{{ trans('email.checkout_point') }}:</td>
            <td>{{ $checkOutPointName }}</td>
        </tr>

    @endif

    @if($deliveryName == 'Новая почта' || $deliveryName == 'Нова пошта')

        @php($deliveryTypeName = '')
        @foreach($model->deliveryTypes as $deliveryType)
            @if($model->order->delivery_type_id == $deliveryType->id)
                @php($deliveryTypeName = $deliveryType->name)
            @endif
        @endforeach

        <tr>
            <td>Тип доставки:</td>
            <td>{{ $deliveryTypeName }}</td>
        </tr>

        @if($deliveryTypeName == 'Адресная доставка' || $deliveryTypeName == 'Адресна доставка')
            <tr>
                <td>{{ trans('order.country') }}:</td>
                <td>{{ $model->order->country_name }}</td>
            </tr>
            <tr>
                <td>{{ trans('order.a_street_house_room') }}:</td>
                <td>{{ $model->order->a_street }}</td>
            </tr>
            <tr>
                <td>{{ trans('order.a_land_area_region') }}:</td>
                <td>{{ $model->order->a_land }}</td>
            </tr>
            <tr>
                <td>{{ trans('order.a_city') }}:</td>
                <td>{{ $model->order->a_city }}</td>
            </tr>
            @if(!is_null($model->order->post_index))
                <tr>
                    <td>{{ trans('order.a_post_index') }}:</td>
                    <td>{{ $model->order->post_index }}</td>
                </tr>
            @endif
        @endif

        @if($deliveryTypeName == 'Номер отделения' || $deliveryTypeName == 'Номер відділення')
            <tr>
                <td>{{ trans('order.city') }}:</td>
                <td>{{ $model->order->np_city }}</td>
            </tr>
            <tr>
                <td>{{ trans('order.number_warehouse') }}:</td>
                <td>{{ $model->order->np_warehouse }}</td>
            </tr>
        @endif
    @endif

    @if(!is_null($model->order->comment))
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