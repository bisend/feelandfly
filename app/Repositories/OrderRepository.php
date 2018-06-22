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
use App\DatabaseModels\Profile;

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
        $order->delivery_id = $data['deliveryId'];
        $order->status_id = $orderStatus->id;
        $order->total_products_count = $cartService->totalCount;
        $order->total_order_amount = $cartService->totalAmount;
        $order->email = $data['email'];
        $order->name = $data['name'];
        $order->phone_number = $data['phone'];
        $order->comment =  $data['comment'] != '' ? $data['comment'] : null;



        $order->checkout_point_id = $data['checkoutPointId'];
        $order->delivery_type_id = $data['npDeliveryTypeId'];
        $order->country_name = $data['countryName'];
        $order->country_code = $data['countryCode'];
        $order->np_city = $data['npCity'];
        $order->np_city_ref = $data['npCityRef'];
        $order->np_warehouse = $data['npWarehouse'];
        $order->np_warehouse_ref = $data['npWarehouseRef'];
        $order->a_street = $data['aStreet'];
        $order->a_land = $data['aLand'];
        $order->a_city = $data['aCity'];
        $order->post_index = $data['postIndex'];

        if (!is_null($data['countryName']) && $data['countryCode'] !== 'UA')
        {
            $order->delivery_price = 400;
        }

        if(auth()->check())
        {
            $user = auth()->user();

            $profile = Profile::whereUserId($user->id)->first();

            $profile->delivery_id = $data['deliveryId'];
            $profile->delivery_type_id = $data['npDeliveryTypeId'];
            $profile->checkout_point_id = $data['checkoutPointId'];
            $profile->country_name = $data['countryName'];
            $profile->country_code = $data['countryCode'];
            $profile->np_city = $data['npCity'];
            $profile->np_city_ref = $data['npCityRef'];
            $profile->np_warehouse = $data['npWarehouse'];
            $profile->np_warehouse_ref = $data['npWarehouseRef'];
            $profile->a_street = $data['aStreet'];
            $profile->a_land = $data['aLand'];
            $profile->a_city = $data['aCity'];
            $profile->post_index =  $data['postIndex'];

            $profile->save();
        }

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

    public function getOrder($model)
    {
        return Order::whereOrderNumber($model->orderNumber)->first();
    }

    public function getOrderStatuses($model)
    {
        return OrderStatus::get([
            'id',
            "name_$model->language as name",
            'slug',
            'is_default'
        ]);
    }
}