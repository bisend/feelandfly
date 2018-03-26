<?php

namespace App\Http\Controllers;

use App\DatabaseModels\Order;
use App\Helpers\Languages;
use App\Services\OrderPaymentService;
use App\Services\ProfileService;
use App\ViewModels\OrderPaymentViewModel;

class OrderPaymentController extends LayoutController
{
    protected $orderPaymentService;

    public function __construct(ProfileService $profileService, OrderPaymentService $orderPaymentService)
    {
        parent::__construct($profileService);

        $this->orderPaymentService = $orderPaymentService;
    }

    public function index($orderNumber = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new OrderPaymentViewModel('order-payment', $language, $orderNumber);

        $this->orderPaymentService->fill($model);

        \Debugbar::info($model);

        return view('pages.order-payment', compact('model'));
    }

    public function liqpayCallbackHandler()
    {
        if (request()->ajax())
        {
            abort(500);
        }

        $request = request()->all();

        $data = $request['data'];

        $private_key = config('services.liqpay.private_key');

        $signature = base64_encode( sha1( ( $private_key . $data . $private_key), 1));

        if ($signature != $request['signature'])
        {
            abort(500);
        }

        $data = json_decode(base64_decode($data), true);

        if ($data['status'] == 'success' || $data['status'] == 'sandbox')
        {
            $order = Order::whereOrderNumber($data['order_id'])->first();
            $order->status_id = 5;
            $order->save();
        }
        else
        {
            $order = Order::whereOrderNumber($data['order_id'])->first();
            $order->status_id = 3;
            $order->save();
        }

        return redirect('/order/payment/' . $data['order_id']);
    }
}
