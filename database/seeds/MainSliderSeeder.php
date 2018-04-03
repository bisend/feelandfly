<?php

use App\DatabaseModels\MainSlider;
use Illuminate\Database\Seeder;

class MainSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        
        $slide = new MainSlider();
        $slide->image = "/img/template/slider/slide-1.jpg";
        $slide->save();
        
        $slide = new MainSlider();
        $slide->image = "/img/template/slider/slide-3.jpg";
        $slide->save();
        
        $slide = new MainSlider();
        $slide->image = "/img/template/slider/slide-4.jpg";
        $slide->save();
        
        DB::commit();
    }
}
