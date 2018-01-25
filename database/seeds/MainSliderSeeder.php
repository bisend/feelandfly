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
        $slide->image_id = 320;
        $slide->save();
        
        $slide = new MainSlider();
        $slide->image_id = 321;
        $slide->save();
        
        $slide = new MainSlider();
        $slide->image_id = 322;
        $slide->save();
        
        DB::commit();
    }
}
