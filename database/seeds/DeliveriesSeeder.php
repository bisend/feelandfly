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
                'slug' => str_slug('Новая почта'),
            ],
            1 => [
                'name_uk' => 'Самовивіз',
                'name_ru' => 'Самовывоз',
                'slug' => str_slug('Самовывоз'),
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
