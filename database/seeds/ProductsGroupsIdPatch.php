<?php

use App\DatabaseModels\Product;
use Illuminate\Database\Seeder;

class ProductsGroupsIdPatch extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::beginTransaction();
        $this->seed();
        DB::commit();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function seed()
    {
        for ($i = 1; $i <= 62; $i++)
        {
            $product = Product::whereId($i)->first();
            $product->group_id = $i; 
            $product->save();
        }
        
        $groupId = 1;
        $counter = 1;
        for ($i = 63; $i <= 620; $i++)
        {
            if ($counter > 9)
            {
                $counter = 1;
                $groupId++;
            }
            $product = Product::whereId($i)->first();
            $product->group_id = $groupId;
            $product->save();
            
            $counter++;
        }
    }
}
