<?php

use App\DatabaseModels\PropertyName;
use Illuminate\Database\Seeder;

class PropertyNamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        PropertyName::truncate();
        $this->command->info('[property_names] table truncated...');

        $this->seed();

        $this->command->info('[property_names] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
    
    public function seed()
    {
        $propertyName = new PropertyName();
        $propertyName->name_ru = 'Тип';
        $propertyName->name_uk = 'Тип';
        $propertyName->slug = URLify::filter('Тип');
        $propertyName->save();

        $propertyName = new PropertyName();
        $propertyName->name_ru = 'Сезон';
        $propertyName->name_uk = 'Сезон';
        $propertyName->slug = URLify::filter('Сезон');
        $propertyName->save();

        $propertyName = new PropertyName();
        $propertyName->name_ru = 'Размер';
        $propertyName->name_uk = 'Розмір';
        $propertyName->slug = URLify::filter('Размер');
        $propertyName->save();

        $propertyName = new PropertyName();
        $propertyName->name_ru = 'Цвет';
        $propertyName->name_uk = 'Колір';
        $propertyName->slug = URLify::filter('Цвет');
        $propertyName->save();
    }
}
