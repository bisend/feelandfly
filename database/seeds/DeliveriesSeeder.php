<?php

use App\DatabaseModels\Delivery;
use Illuminate\Database\Seeder;

class DeliveriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Delivery::truncate();
        $this->command->info('[deliveries] table truncated...');

        DB::beginTransaction();
        $this->seed();
        DB::commit();

        $this->command->info('[deliveries] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
    
    public function seed()
    {
        $deliveries = [
            0 => [
                'name_uk' => 'Нова пошта',
                'name_ru' => 'Новая почта',
                'slug' => URLify::filter('Новая почта'),
            ],
            1 => [
                'name_uk' => 'Автолюкс',
                'name_ru' => 'Автолюкс',
                'slug' => URLify::filter('Автолюкс'),
            ],
            2 => [
                'name_uk' => 'Інтайм',
                'name_ru' => 'Интайм',
                'slug' => URLify::filter('Интайм'),
            ],
            3 => [
                'name_uk' => 'Самовивіз',
                'name_ru' => 'Самовывоз',
                'slug' => URLify::filter('Самовывоз'),
            ]
        ];

        foreach ($deliveries as $key => $delivery)
        {
            $model = new Delivery();
            $model->name_uk = $delivery['name_uk'];
            $model->name_ru = $delivery['name_ru'];
            $model->slug = $delivery['slug'];
            $model->save();
        }
    }
}
