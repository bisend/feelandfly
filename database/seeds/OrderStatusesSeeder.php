<?php

use App\DatabaseModels\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        OrderStatus::truncate();
        $this->command->info('[order_statuses] table truncated...');

        DB::beginTransaction();
//        $this->seed();
        DB::commit();

        $this->command->info('[order_statuses] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function seed()
    {
        $orderStatus = new OrderStatus();
        $orderStatus->name_uk = 'Новий';
        $orderStatus->name_ru = 'Новый';
        $orderStatus->slug = URLify::filter('Новий');
        $orderStatus->is_default = true;
        $orderStatus->save();

        $orderStatus = new OrderStatus();
        $orderStatus->name_uk = 'Прийнято';
        $orderStatus->name_ru = 'Принят';
        $orderStatus->slug = URLify::filter('Прийнято');
        $orderStatus->save();

        $orderStatus = new OrderStatus();
        $orderStatus->name_uk = 'Відхилено';
        $orderStatus->name_ru = 'Отклонен';
        $orderStatus->slug = URLify::filter('Відхилено');
        $orderStatus->save();

        $orderStatus = new OrderStatus();
        $orderStatus->name_uk = 'Відправлено';
        $orderStatus->name_ru = 'Отправлен';
        $orderStatus->slug = URLify::filter('Відправлено');
        $orderStatus->save();

        $orderStatus = new OrderStatus();
        $orderStatus->name_uk = 'Оплачено';
        $orderStatus->name_ru = 'Оплачен';
        $orderStatus->slug = URLify::filter('Оплачено');
        $orderStatus->save();
    }
}
