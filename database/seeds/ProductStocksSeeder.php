<?php

use App\DatabaseModels\ProductStock;
use Illuminate\Database\Seeder;

class ProductStocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        ProductStock::truncate();
        $this->command->info('[product_stocks] table truncated...');

        $this->seed();

        $this->command->info('[product_stocks] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
    
    public function seed()
    {
        for ($i = 1; $i <= 3100; $i++)
        {
            for ($j = 1; $j <= 3; $j++)
            {
                $productStock = new ProductStock();
                $productStock->product_size_id = $i;
                $productStock->user_type_id = $j;
                $productStock->stock = rand(3, 20);
                $productStock->save();
            }
        }
    }
}
