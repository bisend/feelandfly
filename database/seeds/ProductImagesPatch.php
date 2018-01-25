<?php

use App\DatabaseModels\ProductImage;
use Illuminate\Database\Seeder;

class ProductImagesPatch extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        
        $imageId = 311;
        $counter = 1;
        for ($i = 63; $i <= 620; $i++)
        {
            if ($counter > 9)
            {
                $counter = 1;
                $imageId = 311;
            }
            for ($k = 1; $k <= 5; $k++)
            {
                $productImage = new ProductImage();
                $productImage->product_id = $i;
                $productImage->image_id = $imageId;
                $productImage->save();
            }
            $counter++;
            $imageId++;
        }
        
        DB::commit();
    }
}