<?php

use App\DatabaseModels\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Category::truncate();
        $this->command->info('[categories] table truncated...');
        
        DB::beginTransaction();
        $this->seed();
        DB::commit();
        
        $this->command->info('[categories] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function seed()
    {
        $faker = Faker\Factory::create();
        
        //1
        $category = new Category();
        $category->parent_id = null;
        $category->icon = '/img/template/category-icon/jacket.png';
        $category->name_ru = 'Верхняя одежда';
        $category->name_uk = 'Верхній одяг';
        $category->slug = URLify::filter('Верхняя одежда');
        $category->description_ru = $faker->text(191);
        $category->description_uk = $faker->text(191);
        $category->save();
        
        //2
        $category = new Category();
        $category->parent_id = null;
        $category->icon = '/img/template/category-icon/hoodie.png';
        $category->name_ru = 'Свитшоты & толстовки';
        $category->name_uk = 'Світшоти & толстовки';
        $category->slug = URLify::filter('Свитшоты & толстовки');
        $category->description_ru = $faker->text(191);
        $category->description_uk = $faker->text(191);
        $category->save();
        
        //3
        $category = new Category();
        $category->parent_id = null;
        $category->icon = '/img/template/category-icon/jeans.png';
        $category->name_ru = 'Штаны';
        $category->name_uk = 'Штани';
        $category->slug = URLify::filter('Штаны');
        $category->description_ru = $faker->text(191);
        $category->description_uk = $faker->text(191);
        $category->save();
        
        //4
        $category = new Category();
        $category->parent_id = null;
        $category->icon = '/img/template/category-icon/shorts.png';
        $category->name_ru = 'Шорты';
        $category->name_uk = 'Шорти';
        $category->slug = URLify::filter('Шорты');
        $category->description_ru = $faker->text(191);
        $category->description_uk = $faker->text(191);
        $category->save();
        
        //5
        $category = new Category();
        $category->parent_id = null;
        $category->icon = '/img/template/category-icon/backpack.png';
        $category->name_ru = 'Аксессуары';
        $category->name_uk = 'Аксесуари';
        $category->slug = URLify::filter('Аксессуары');
        $category->description_ru = $faker->text(191);
        $category->description_uk = $faker->text(191);
        $category->save();
        
//        $faker_ru = Faker\Factory::create('ru');
//        $faker_uk = Faker\Factory::create('uk');
//
//        DB::table('categories')->insert([
//            'parent_id' => null,
//            'name_ru' => 'Верхняя одежда',
//            'name_uk' => 'Верхній одяг',
//            'slug' => URLify::filter('Верхняя одежда'),
//            'description_ru' => $faker_ru->text(191),
//            'description_uk' => $faker_uk->text(191)
//        ]);
//
//        DB::table('categories')->insert([
//            'parent_id' => null,
//            'name_ru' => 'Свитшоты & толстовки',
//            'name_uk' => 'Світшоти & толстовки',
//            'slug' => URLify::filter('Свитшоты & толстовки'),
//            'description_ru' => $faker_ru->text(191),
//            'description_uk' => $faker_uk->text(191)
//        ]);
//
//        DB::table('categories')->insert([
//            'parent_id' => null,
//            'name_ru' => 'Штаны',
//            'name_uk' => 'Штани',
//            'slug' => URLify::filter('Штаны'),
//            'description_ru' => $faker_ru->text(191),
//            'description_uk' => $faker_uk->text(191)
//        ]);
//
//        DB::table('categories')->insert([
//            'parent_id' => null,
//            'name_ru' => 'Шорты',
//            'name_uk' => 'Шорти',
//            'slug' => URLify::filter('Шорты'),
//            'description_ru' => $faker_ru->text(191),
//            'description_uk' => $faker_uk->text(191)
//        ]);
//
//        DB::table('categories')->insert([
//            'parent_id' => null,
//            'name_ru' => 'Аксессуары',
//            'name_uk' => 'Аксесуари',
//            'slug' => URLify::filter('Аксессуары'),
//            'description_ru' => $faker_ru->text(191),
//            'description_uk' => $faker_uk->text(191)
//        ]);
    }
}
