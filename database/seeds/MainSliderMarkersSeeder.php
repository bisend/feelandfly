<?php

use App\DatabaseModels\MainSliderMarker;
use Illuminate\Database\Seeder;

class MainSliderMarkersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        $marker = new MainSliderMarker();
        $marker->slide_id = 1;
        $marker->product_id = 10;
        $marker->position_x = 212;
        $marker->position_y = 40;
        $marker->priority = 1002;
        $marker->save();
        
        $marker = new MainSliderMarker();
        $marker->slide_id = 1;
        $marker->product_id = 11;
        $marker->position_x = 555;
        $marker->position_y = 40;
        $marker->priority = 1001;
        $marker->save();

        $marker = new MainSliderMarker();
        $marker->slide_id = 1;
        $marker->product_id = 12;
        $marker->position_x = 897;
        $marker->position_y = 40;
        $marker->priority = 1000;
        $marker->save();

        $marker = new MainSliderMarker();
        $marker->slide_id = 2;
        $marker->product_id = 13;
        $marker->position_x = 537;
        $marker->position_y = 35;
        $marker->priority = 1000;
        $marker->save();

        $marker = new MainSliderMarker();
        $marker->slide_id = 3;
        $marker->product_id = 14;
        $marker->position_x = 490;
        $marker->position_y = -64;
        $marker->priority = 1000;
        $marker->save();
        
        DB::commit();
    }
}
