<?php

use App\DatabaseModels\Payment;
use Illuminate\Database\Seeder;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Payment::truncate();
        $this->command->info('[payments] table truncated...');

        DB::beginTransaction();
        $this->seed();
        DB::commit();

        $this->command->info('[payments] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function seed()
    {
        $payments = [
            0 => [
                'name_uk' => 'Безготівковий розрахунок',
                'name_ru' => 'Безналичный расчет',
                'slug' => URLify::filter('Безналичный расчет'),
            ],
            1 => [
                'name_uk' => 'Накладений платіж',
                'name_ru' => 'Наложенный платеж',
                'slug' => URLify::filter('Наложенный платеж'),
            ],
            2 => [
                'name_uk' => 'Готівкою',
                'name_ru' => 'Наличными',
                'slug' => URLify::filter('Наличными'),
            ]
        ];

        foreach ($payments as $key => $payment)
        {
            $model = new Payment();
            $model->name_uk = $payment['name_uk'];
            $model->name_ru = $payment['name_ru'];
            $model->slug = $payment['slug'];
            $model->save();
        }
    }
}
