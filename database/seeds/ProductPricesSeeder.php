<?php

use App\DatabaseModels\ProductPrice;
use Illuminate\Database\Seeder;

class ProductPricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        ProductPrice::truncate();
        $this->command->info('[product_prices] table truncated...');

        $this->seed();

        $this->command->info('[product_prices] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
    
    public function seed()
    {
        for ($i = 1; $i <= 620; $i++)
        {
            for ($j = 1; $j <= 3; $j++)
            {
                $productPrice = new ProductPrice();
                $productPrice->product_id = $i;
                $productPrice->user_type_id = $j;
                $productPrice->price = rand(400, 3000);
                $productPrice->save();
            }
        }
    }
}
