<?php

use App\DatabaseModels\Color;
use App\DatabaseModels\Product;
use Illuminate\Database\Seeder;

class ProductsPatch extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seed();
        $this->command->info('[products_patch] table seeded...');
    }

    public function seed()
    {
        $products = Product::get();
        $colors = Color::get();

        $faker = Faker\Factory::create();

        foreach ($products as $prod)
        {
            foreach ($colors as $color)
            {
                if ($color->id != 1)
                {
                    $product = new Product();
                    $product->name_ru = $prod->name_ru . ' ' . $color->name_ru;
                    $product->name_uk = $prod->name_uk . ' ' . $color->name_uk;
                    $product->slug = URLify::filter($prod->name_ru . ' ' . $color->name_ru);
                    $product->category_id = $prod->category_id;
                    $product->breadcrumb_category_id = null;
                    $product->description_ru = $faker->text(191);
                    $product->description_uk = $faker->text(191);
                    $product->vendor_code = $faker->ean8;
                    $product->rating = mt_rand(1.00, 5.00);
                    $product->save();
                }
            }
        }
    }
}
