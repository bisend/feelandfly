<?php

use App\DatabaseModels\PropertyValue;
use Illuminate\Database\Seeder;

class PropertyValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        PropertyValue::truncate();
        $this->command->info('[property_values] table truncated...');

        $this->seed();

        $this->command->info('[property_values] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
    
    public function seed()
    {
        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'Верхняя одежда';
        $propertyValue->name_uk = 'Верхній одяг';
        $propertyValue->slug = URLify::filter('Верхняя одежда');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'Свитшоты & толстовки';
        $propertyValue->name_uk = 'Світшоти & толстовки';
        $propertyValue->slug = URLify::filter('Свитшоты & толстовки');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'Штаны';
        $propertyValue->name_uk = 'Штани';
        $propertyValue->slug = URLify::filter('Штаны');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'Шорты';
        $propertyValue->name_uk = 'Шорти';
        $propertyValue->slug = URLify::filter('Шорты');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'Аксессуары';
        $propertyValue->name_uk = 'Аксесуари';
        $propertyValue->slug = URLify::filter('Аксессуары');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'Зима';
        $propertyValue->name_uk = 'Зима';
        $propertyValue->slug = URLify::filter('Зима');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'Весна';
        $propertyValue->name_uk = 'Весна';
        $propertyValue->slug = URLify::filter('Весна');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'Лето';
        $propertyValue->name_uk = 'Літо';
        $propertyValue->slug = URLify::filter('Лето');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'Осень';
        $propertyValue->name_uk = 'Осінь';
        $propertyValue->slug = URLify::filter('Осень');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'S';
        $propertyValue->name_uk = 'S';
        $propertyValue->slug = URLify::filter('S');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'M';
        $propertyValue->name_uk = 'M';
        $propertyValue->slug = URLify::filter('M');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'L';
        $propertyValue->name_uk = 'L';
        $propertyValue->slug = URLify::filter('L');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'XL';
        $propertyValue->name_uk = 'XL';
        $propertyValue->slug = URLify::filter('XL');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'XXL';
        $propertyValue->name_uk = 'XXL';
        $propertyValue->slug = URLify::filter('XXL');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'Черный';
        $propertyValue->name_uk = 'Чорний';
        $propertyValue->slug = URLify::filter('Черный');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'Красный';
        $propertyValue->name_uk = 'Червоний';
        $propertyValue->slug = URLify::filter('Красный');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'Зеленый';
        $propertyValue->name_uk = 'Зелений';
        $propertyValue->slug = URLify::filter('Зеленый');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'Синий';
        $propertyValue->name_uk = 'Синій';
        $propertyValue->slug = URLify::filter('Синий');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'Желтый';
        $propertyValue->name_uk = 'Жовтий';
        $propertyValue->slug = URLify::filter('Желтый');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'Голубой';
        $propertyValue->name_uk = 'Голубий';
        $propertyValue->slug = URLify::filter('Голубой');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'Розовый';
        $propertyValue->name_uk = 'Рожевий';
        $propertyValue->slug = URLify::filter('Розовый');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'Серый';
        $propertyValue->name_uk = 'Сірий';
        $propertyValue->slug = URLify::filter('Серый');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'Белый';
        $propertyValue->name_uk = 'Білий';
        $propertyValue->slug = URLify::filter('Белый');
        $propertyValue->save();

        $propertyValue = new PropertyValue();
        $propertyValue->name_ru = 'Оранжевый';
        $propertyValue->name_uk = 'Помаранчевий';
        $propertyValue->slug = URLify::filter('Оранжевый');
        $propertyValue->save();
    }
}
