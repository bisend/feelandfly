<?php

use App\DatabaseModels\Category;
use App\DatabaseModels\Product;
use Illuminate\Database\Seeder;

class MetaTagsProdsCatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->command->info('start...');

        DB::beginTransaction();
        $this->seed();
        DB::commit();

        $this->command->info('seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function seed()
    {
        for ($i = 1; $i <= 620; $i++)
        {
            $product = Product::whereId($i)->first();
            $product->meta_tag_id = $i + 13;
            $product->save();
        }

        for ($i = 1; $i <= 5; $i++)
        {
            $category = Category::whereId($i)->first();
            $category->meta_tag_id = $i + 633;
            $category->save();
        }
    }
}
