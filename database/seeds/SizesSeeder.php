<?php

use App\DatabaseModels\Size;
use Illuminate\Database\Seeder;

class SizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Size::truncate();
        $this->command->info('[sizes] table truncated...');

        $this->seed();

        $this->command->info('[sizes] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
    
    public function seed()
    {
        $size = new Size();
        $size->name_ru = 'S';
        $size->name_uk = 'S';
        $size->slug = URLify::filter('S');
        $size->save();

        $size = new Size();
        $size->name_ru = 'M';
        $size->name_uk = 'M';
        $size->slug = URLify::filter('M');
        $size->save();

        $size = new Size();
        $size->name_ru = 'L';
        $size->name_uk = 'L';
        $size->slug = URLify::filter('L');
        $size->save();

        $size = new Size();
        $size->name_ru = 'XL';
        $size->name_uk = 'XL';
        $size->slug = URLify::filter('XL');
        $size->save();

        $size = new Size();
        $size->name_ru = 'XXL';
        $size->name_uk = 'XXL';
        $size->slug = URLify::filter('XXL');
        $size->save();
    }
}
