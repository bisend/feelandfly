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
        DB::beginTransaction();
        $this->seed();
        DB::commit();
        
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
                    $product->slug = str_slug($prod->name_ru . ' ' . $color->name_ru);
                    $product->category_id = $prod->category_id;
                    $product->breadcrumb_category_id = null;
                    $product->description_ru = $faker->text(191);
                    $product->description_uk = $faker->text(191);
                    $product->vendor_code = $faker->ean8;
                    $product->rating = mt_rand(1.00, 5.00);
                    $product->save();
                    $product->meta_title_ru = "$product->name_ru купить в интернет-магазине FEEL and FLY";
                    $product->meta_title_uk = "$product->name_uk купить в интернет-магазине FEEL and FLY";
                    $product->meta_description_ru = "Купить $product->name_ru за лучшими ценами в интернет-магазине FEEL and FLY ? (068) 000 00 00 ? (093) 000 00 00 ? Бесплатная доставка по Украине";
                    $product->meta_description_uk = "Купити $product->name_uk за найкращими цiнами в iнтернет-магазині FEEL and FLY ? (068) 000 00 00 ? (093) 000 00 00 ? Безкоштовна доставка по Україні";
                    $product->meta_keywords_ru = "$product->name_ru купить в интернет-магазине FEEL and FLY";
                    $product->meta_keywords_uk = "$product->name_uk купить в интернет-магазине FEEL and FLY";
                    $product->meta_h1_ru = $product->name_ru;
                    $product->meta_h1_uk = $product->name_uk;
                    $product->save();
                }
            }
        }
    }
}
