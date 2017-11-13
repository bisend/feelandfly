<?php

use App\DatabaseModels\Product;
use Illuminate\Database\Seeder;

class ProductsColorsIdPatch extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $this->seed();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function seed()
    {
        for ($i = 1; $i <= 62; $i++)
        {
            $product = Product::whereId($i)->first();
            $product->color_id = 1;
            $product->save();
        }

        $colorId = 2;
        $counter = 1;
        for ($i = 63; $i <= 620; $i++)
        {
            if ($counter > 9)
            {
                $counter = 1;
                $colorId = 2;
            }
            $product = Product::whereId($i)->first();
            $product->color_id = $colorId;
            $product->save();

            $counter++;
            $colorId++;
        }
    }
}
