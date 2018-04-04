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
        for ($i = 1; $i <= 32; $i++)
        {
            $productPromotion = new ProductPromotion();

            if ($i <= 16)
            {
                $productPromotion->product_id = $i;
                $productPromotion->promotion_id = 1;
            }

            if ($i > 16 && $i <= 24)
            {
                $productPromotion->product_id = $i;
                $productPromotion->promotion_id = 2;
            }

            if ($i > 24 && $i <= 32)
            {
                $productPromotion->product_id = $i;
                $productPromotion->promotion_id = 3;
            }

            $productPromotion->save();
        }
    }
}
