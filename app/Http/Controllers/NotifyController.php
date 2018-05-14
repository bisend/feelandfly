<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DatabaseModels\ProductNotification;

class NotifyController extends Controller
{
    public function createNotify()
    {
        $email = request('email');
        $name = request('name');
        $count = request('count');
        $productId = request('productId');
        $sizeId = request('sizeId');

        $productNotify = new ProductNotification();
        $productNotify->product_id = $productId;
        $productNotify->size_id = $sizeId;
        $productNotify->email = $email;
        $productNotify->name = $name;
        $productNotify->count = $count;
        $productNotify->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
