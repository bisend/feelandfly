<?php

use App\DatabaseModels\ProductGroup;
use Illuminate\Database\Seeder;

class ProductGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 62; $i++)
        {
            $productGroup = new ProductGroup();
            $productGroup->save();
        }
    }
}
