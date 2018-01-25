<?php

use App\DatabaseModels\Color;
use Illuminate\Database\Seeder;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Color::truncate();
        $this->command->info('[colors] table truncated...');

        DB::beginTransaction();
        $this->seed();
        DB::commit();

        $this->command->info('[colors] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
    
    public function seed()
    {
        //black
        $color = new Color();
        $color->name_ru = 'черный';
        $color->name_uk = 'чорний';
        $color->slug = URLify::filter('черный');
        $color->html_code = 'rgb(0,0,0)';
        $color->save();

        //red
        $color = new Color();
        $color->name_ru = 'красный';
        $color->name_uk = 'червоний';
        $color->slug = URLify::filter('красный');
        $color->html_code = 'rgb(255,0,0)';
        $color->save();

        //green
        $color = new Color();
        $color->name_ru = 'зеленый';
        $color->name_uk = 'зелений';
        $color->slug = URLify::filter('зеленый');
        $color->html_code = 'rgb(0,255,0)';
        $color->save();

        //blue
        $color = new Color();
        $color->name_ru = 'синий';
        $color->name_uk = 'синій';
        $color->slug = URLify::filter('синий');
        $color->html_code = 'rgb(0,0,255)';
        $color->save();

        //yellow
        $color = new Color();
        $color->name_ru = 'желтый';
        $color->name_uk = 'жовтий';
        $color->slug = URLify::filter('желтый');
        $color->html_code = 'rgb(255,255,0)';
        $color->save();

        //lightblue
        $color = new Color();
        $color->name_ru = 'голубой';
        $color->name_uk = 'голубий';
        $color->slug = URLify::filter('голубой');
        $color->html_code = 'rgb(0,255,255)';
        $color->save();

        //pink
        $color = new Color();
        $color->name_ru = 'розовый';
        $color->name_uk = 'рожевий';
        $color->slug = URLify::filter('розовый');
        $color->html_code = 'rgb(255,0,255)';
        $color->save();

        //gray
        $color = new Color();
        $color->name_ru = 'серый';
        $color->name_uk = 'сірий';
        $color->slug = URLify::filter('серый');
        $color->html_code = 'rgb(192,192,192)';
        $color->save();

        //white
        $color = new Color();
        $color->name_ru = 'белый';
        $color->name_uk = 'білий';
        $color->slug = URLify::filter('белый');
        $color->html_code = 'rgb(255,255,255)';
        $color->save();
        
        //orange
        $color = new Color();
        $color->name_ru = 'оранжевый';
        $color->name_uk = 'помаранчевий';
        $color->slug = URLify::filter('оранжевый');
        $color->html_code = 'rgb(255,165,0)';
        $color->save();
    }
}
