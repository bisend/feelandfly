<?php

use App\DatabaseModels\Product;
use App\DatabaseModels\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        ProductCategory::truncate();
        $this->command->info('[product_category] table truncated...');

        $this->seed();

        $this->command->info('[product_category] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function seed()
    {
        DB::beginTransaction();

        $products = Product::get([
            'id',
            'category_id'
        ]);

        foreach ($products as $product)
        {
            $productCategory = new ProductCategory();
            $productCategory->product_id = $product->id;
            $productCategory->category_id = $product->category_id;
            $productCategory->save();
        }

        DB::commit();
    }
}
