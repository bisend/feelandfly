<?php

use App\DatabaseModels\Promotion;
use Illuminate\Database\Seeder;

class PromotionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        $promotion = new Promotion();
        $promotion->name_ru = 'Распродажа';
        $promotion->name_uk = 'Розпродаж';
        $promotion->slug = str_slug('Распродажа');
        $promotion->priority = 3;
        $promotion->save();

        $promotion = new Promotion();
        $promotion->name_ru = 'Новинки';
        $promotion->name_uk = 'Новинки';
        $promotion->slug = str_slug('Новинки');
        $promotion->save();
        $promotion->priority = 1;

        $promotion = new Promotion();
        $promotion->name_ru = 'Топ продаж';
        $promotion->name_uk = 'Топ продаж';
        $promotion->slug = str_slug('Топ продаж');
        $promotion->priority = 2;
        $promotion->save();

        DB::commit();
    }
}
