<?php

use App\DatabaseModels\ProductPromotion;
use Illuminate\Database\Seeder;

class ProductsPromotionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        ProductPromotion::truncate();
        $this->command->info('[products_promotions] table truncated...');

        DB::beginTransaction();
        $this->seed();
        DB::commit();

        $this->command->info('[products_promotions] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function seed()
    {
        $productPromotion = new ProductPromotion();
        $productPromotion->product_id = 1;
        $productPromotion->promotion_id = 1;
        $productPromotion->save();

        $productPromotion = new ProductPromotion();
        $productPromotion->product_id = 2;
        $productPromotion->promotion_id = 1;
        $productPromotion->save();

        $productPromotion = new ProductPromotion();
        $productPromotion->product_id = 3;
        $productPromotion->promotion_id = 1;
        $productPromotion->save();

        $productPromotion = new ProductPromotion();
        $productPromotion->product_id = 4;
        $productPromotion->promotion_id = 1;
        $productPromotion->save();

        $productPromotion = new ProductPromotion();
        $productPromotion->product_id = 5;
        $productPromotion->promotion_id = 2;
        $productPromotion->save();

        $productPromotion = new ProductPromotion();
        $productPromotion->product_id = 6;
        $productPromotion->promotion_id = 2;
        $productPromotion->save();

        $productPromotion = new ProductPromotion();
        $productPromotion->product_id = 3;
        $productPromotion->promotion_id = 2;
        $productPromotion->save();

        $productPromotion = new ProductPromotion();
        $productPromotion->product_id = 7;
        $productPromotion->promotion_id = 3;
        $productPromotion->save();

        $productPromotion = new ProductPromotion();
        $productPromotion->product_id = 8;
        $productPromotion->promotion_id = 3;
        $productPromotion->save();
        
        $productPromotion = new ProductPromotion();
        $productPromotion->product_id = 9;
        $productPromotion->promotion_id = 2;
        $productPromotion->save();
    }
}
