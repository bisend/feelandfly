<?php

use App\DatabaseModels\WishListProduct;
use Illuminate\Database\Seeder;

class WLProductsTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        
        for ($i = 1; $i <= 200; $i++)
        {
            for ($k = 1; $k <= 5; $k++)
            {
                $wlprod = new WishListProduct();
                $wlprod->wish_list_id = 1;
                $wlprod->product_id = $i;
                $wlprod->size_id = $k;
                $wlprod->save();
            }
        }

        DB::commit();
    }
}
