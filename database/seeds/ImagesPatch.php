<?php

use App\DatabaseModels\Image;
use Illuminate\Database\Seeder;

class ImagesPatch extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seed();
    }

    public function seed()
    {
        $image = new Image();
        $image->original = "/img/test/red.jpg";
        $image->big = "/img/test/red.jpg";
        $image->medium = "/img/test/red.jpg";
        $image->small = "/img/test/red.jpg";
        $image->save();
        
        $image = new Image();
        $image->original = "/img/test/green.jpg";
        $image->big = "/img/test/green.jpg";
        $image->medium = "/img/test/green.jpg";
        $image->small = "/img/test/green.jpg";
        $image->save();
        
        $image = new Image();
        $image->original = "/img/test/blue.png";
        $image->big = "/img/test/blue.png";
        $image->medium = "/img/test/blue.png";
        $image->small = "/img/test/blue.png";
        $image->save();
        
        $image = new Image();
        $image->original = "/img/test/yellow.jpg";
        $image->big = "/img/test/yellow.jpg";
        $image->medium = "/img/test/yellow.jpg";
        $image->small = "/img/test/yellow.jpg";
        $image->save();
        
        $image = new Image();
        $image->original = "/img/test/lightblue.jpg";
        $image->big = "/img/test/lightblue.jpg";
        $image->medium = "/img/test/lightblue.jpg";
        $image->small = "/img/test/lightblue.jpg";
        $image->save();
        
        $image = new Image();
        $image->original = "/img/test/pink.jpg";
        $image->big = "/img/test/pink.jpg";
        $image->medium = "/img/test/pink.jpg";
        $image->small = "/img/test/pink.jpg";
        $image->save();
        
        $image = new Image();
        $image->original = "/img/test/gray.gif";
        $image->big = "/img/test/gray.gif";
        $image->medium = "/img/test/gray.gif";
        $image->small = "/img/test/gray.gif";
        $image->save();
        
        $image = new Image();
        $image->original = "/img/test/white.png";
        $image->big = "/img/test/white.png";
        $image->medium = "/img/test/white.png";
        $image->small = "/img/test/white.png";
        $image->save();
        
        $image = new Image();
        $image->original = "/img/test/orange.png";
        $image->big = "/img/test/orange.png";
        $image->medium = "/img/test/orange.png";
        $image->small = "/img/test/orange.png";
        $image->save();
    }
}
