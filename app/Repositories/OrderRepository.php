<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 13.12.2017
 * Time: 11:48
 */

namespace App\Repositories;


use App\DatabaseModels\Order;
use App\DatabaseModels\OrderStatus;

/**
 * Class OrderRepository
 * @package App\Repositories
 */
class OrderRepository
{
    /**
     * save order to DB and return $order
     * @param $data
     * @param $userId
     * @param $userTypeId
     * @param $model
     * @param $cartService
     * @return Order
     */
    public function createOrder($data, $userId, $userTypeId, $model, $cartService)
    {
        $orderStatus = OrderStatus::whereIsDefault(true)->first();

        $order = new Order();
        $order->user_id = $userId;
        $order->payment_id = $data['paymentId'];
        $order->delivery_id = $data['deliveryId'];
        $order->status_id = $orderStatus->id;
        $order->total_products_count = $cartService->totalCount;
        $order->total_order_amount = $cartService->totalAmount;
        $order->address_delivery = $data['address'];
        $order->email = $data['email'];
        $order->name = $data['name'];
        $order->phone_number = $data['phone'];
        $order->comment =  $data['comment'] != '' ? $data['comment'] : null;
        $order->save();
        $order->order_number = $order->id + 10000;
        $order->save();

        return $order;
    }

    /**
     * return orders for user
     * @param $model
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getOrders($model)
    {
        return Order::with([
            'status' => function ($query) use ($model) {
                $query->select([
                    'id',
                    "name_$model->language as name",
                    'slug'
                ]);
            }
        ])->whereUserId($model->user->id)
            ->orWhere('email', '=', $model->user->email)
            ->orderBy('created_at', 'desc')
            ->offset($model->ordersOffset)
            ->limit($model->ordersLimit)
            ->get();
    }

    /**
     * return count of orders for user
     * @param $model
     * @return int
     */
    public function getTotalOrdersCount($model)
    {
        return Order::whereUserId($model->user->id)->orWhere('email', '=', $model->user->email)->count();
    }
}