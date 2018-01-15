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
        $promotion->slug = URLify::filter('Распродажа');
        $promotion->save();

        $promotion = new Promotion();
        $promotion->name_ru = 'Новинки';
        $promotion->name_uk = 'Новинки';
        $promotion->slug = URLify::filter('Новинки');
        $promotion->save();

        $promotion = new Promotion();
        $promotion->name_ru = 'Топ продаж';
        $promotion->name_uk = 'Топ продаж';
        $promotion->slug = URLify::filter('Топ продаж');
        $promotion->save();

        DB::commit();
    }
}
