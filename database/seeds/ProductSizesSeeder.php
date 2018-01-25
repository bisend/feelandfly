<?php

use App\DatabaseModels\ProductSize;
use App\DatabaseModels\Size;
use Illuminate\Database\Seeder;

class ProductSizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        ProductSize::truncate();
        $this->command->info('[product_sizes] table truncated...');

        DB::beginTransaction();
        $this->seed();
        DB::commit();

        $this->command->info('[product_sizes] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
    
    public function seed()
    {
        $sizes = Size::get();
        for($i = 1; $i <= 620; $i++)
        {
            foreach ($sizes as $size)
            {
                $productSize = new ProductSize();
                $productSize->product_id = $i;
                $productSize->size_id = $size->id;
                $productSize->save();
            }
        }
    }
}
