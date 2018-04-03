<?php

use App\DatabaseModels\Image;
use Illuminate\Database\Seeder;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Image::truncate();
        $this->command->info('[images] table truncated...');
        
        DB::beginTransaction();
        $this->seed();
        DB::commit();

        $this->command->info('[images] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
    
    public function seed()
    {
        for ($i = 1; $i <= 62; $i++)
        {
            for ($j = 1; $j <= 5; $j++)
            {
                $image = new Image();
                $image->original = "/img/product/original/$i-$j.jpg";
                $image->big = "/img/product/big/$i-$j.jpg";
                $image->medium = "/img/product/medium/$i-$j.jpg";
                $image->small = "/img/product/small/$i-$j.jpg";
                $image->save();
            }
        }

        $image = new Image();
        $image->original = "/img/product/original/red.jpg";
        $image->big = "/img/product/big/red.jpg";
        $image->medium = "/img/product/medium/red.jpg";
        $image->small = "/img/product/small/red.jpg";
        $image->save();

        $image = new Image();
        $image->original = "/img/product/original/green.jpg";
        $image->big = "/img/product/big/green.jpg";
        $image->medium = "/img/product/medium/green.jpg";
        $image->small = "/img/product/small/green.jpg";
        $image->save();

        $image = new Image();
        $image->original = "/img/product/original/blue.jpg";
        $image->big = "/img/product/big/blue.jpg";
        $image->medium = "/img/product/medium/blue.jpg";
        $image->small = "/img/product/small/blue.jpg";
        $image->save();

        $image = new Image();
        $image->original = "/img/product/original/yellow.jpg";
        $image->big = "/img/product/big/yellow.jpg";
        $image->medium = "/img/product/medium/yellow.jpg";
        $image->small = "/img/product/small/yellow.jpg";
        $image->save();

        $image = new Image();
        $image->original = "/img/product/original/lightblue.jpg";
        $image->big = "/img/product/big/lightblue.jpg";
        $image->medium = "/img/product/medium/lightblue.jpg";
        $image->small = "/img/product/small/lightblue.jpg";
        $image->save();

        $image = new Image();
        $image->original = "/img/product/original/pink.jpg";
        $image->big = "/img/product/big/pink.jpg";
        $image->medium = "/img/product/medium/pink.jpg";
        $image->small = "/img/product/small/pink.jpg";
        $image->save();

        $image = new Image();
        $image->original = "/img/product/original/gray.jpg";
        $image->big = "/img/product/big/gray.jpg";
        $image->medium = "/img/product/medium/gray.jpg";
        $image->small = "/img/product/small/gray.jpg";
        $image->save();

        $image = new Image();
        $image->original = "/img/product/original/white.jpg";
        $image->big = "/img/product/big/white.jpg";
        $image->medium = "/img/product/medium/white.jpg";
        $image->small = "/img/product/small/white.jpg";
        $image->save();

        $image = new Image();
        $image->original = "/img/product/original/orange.jpg";
        $image->big = "/img/product/big/orange.jpg";
        $image->medium = "/img/product/medium/orange.jpg";
        $image->small = "/img/product/small/orange.jpg";
        $image->save();

//        $image = new Image();
//        $image->original = "/img/template/slider/slide-1.jpg";
//        $image->save();
//
//        $image = new Image();
//        $image->original = "/img/template/slider/slide-3.jpg";
//        $image->save();
//
//        $image = new Image();
//        $image->original = "/img/template/slider/slide-4.jpg";
//        $image->save();
        
        
    }
}
