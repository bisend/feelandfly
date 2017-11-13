<?php

use App\DatabaseModels\Image;
use App\DatabaseModels\ProductImage;
use Illuminate\Database\Seeder;

class ProductImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        ProductImage::truncate();
        $this->command->info('[product_images] table truncated...');

        $this->seed();

        $this->command->info('[product_images] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function seed()
    {
        $limit = 5;
        for ($i = 1; $i <= 62; $i++)
        {
            $offset = ($i - 1) * $limit;
            $images = Image::limit($limit)
                ->offset($offset)
                ->get();
            foreach ($images as $image)
            {
                $product_image = new ProductImage();
                $product_image->product_id = $i;
                $product_image->image_id = $image->id;
                $product_image->save();
            }
        }
    }
}
