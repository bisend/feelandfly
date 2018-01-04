<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 13.12.2017
 * Time: 12:13
 */

namespace App\Repositories;


use App\DatabaseModels\OrderProduct;

/**
 * Class OrderProductRepository
 * @package App\Repositories
 */
class OrderProductRepository
{
    /**
     * save order products to DB
     * @param $model
     * @param $cartService
     */
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

    /**
     * return order products
     * @param $orderId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getOrderProducts($orderId)
    {
        return OrderProduct::whereOrderId($orderId)->get();
    }
}