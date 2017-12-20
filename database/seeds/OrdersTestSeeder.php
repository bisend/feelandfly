<?php

use App\DatabaseModels\Order;
use App\DatabaseModels\OrderProduct;
use Illuminate\Database\Seeder;

class OrdersTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        
        for ($i = 1; $i <= 1000; $i++)
        {
            $order = new Order();
            $order->user_id = 28;
            $order->payment_id = 1;
            $order->delivery_id = 1;
            $order->status_id = 1;
            $order->total_products_count = 10;
            $order->total_order_amount = 10000;
            $order->address_delivery = 'rivne 123';
            $order->email = 'vboychenko54@gmail.com';
            $order->name = 'vladislav';
            $order->phone_number = '123123';
            $order->save();
            $order->order_number = 10000 + $order->id;
            $order->save();
            
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = 1;
            $orderProduct->size_id = 1;
            $orderProduct->product_count = 10;
            $orderProduct->price = 1000;
            $orderProduct->save();
        }
        DB::commit();
    }
}
