<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 13.12.2017
 * Time: 12:13
 */

namespace App\Repositories;


use App\DatabaseModels\OrderProduct;

class OrderProductRepository
{
    public function createOrderProducts($model, $cartService)
    {
        foreach ($cartService->cart as $cartProduct)
        {
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $model->order->id;
            $orderProduct->product_id = $cartProduct['productId'];
            $orderProduct->size_id = $cartProduct['sizeId'];
            $orderProduct->product_count = $cartProduct['count'];
            $orderProduct->price = $cartProduct['product']->price[0]->price;
//            $orderProduct->code_1c = $orderProd->code_1c;
            $orderProduct->save();
        }
    }
}