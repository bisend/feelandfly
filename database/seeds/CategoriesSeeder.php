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
//        $this->seed();
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
        $category->slug = str_slug('Верхняя одежда');
        $category->description_ru = $faker->text(191);
        $category->description_uk = $faker->text(191);
        $category->save();
        $category->meta_title_ru = "$category->name_ru купить в интернет-магазине Feel And Fly";
        $category->meta_title_uk = "$category->name_uk купить в интернет-магазине Feel And Fly";
        $category->meta_description_ru = "Купить $category->name_ru за лучшими ценами в интернет-магазине Feel And Fly ? (068) 000 00 00 ? (093) 000 00 00 ? Бесплатная доставка по Украине";
        $category->meta_description_uk = "Купити $category->name_uk за найкращими цiнами в iнтернет-магазині Feel And Fly ? (068) 000 00 00 ? (093) 000 00 00 ? Безкоштовна доставка по Україні";
        $category->meta_keywords_ru = "$category->name_ru купить в интернет-магазине Feel And Fly";
        $category->meta_keywords_uk = "$category->name_uk купить в интернет-магазине Feel And Fly";
        $category->meta_h1_ru = $category->name_ru;
        $category->meta_h1_uk = $category->name_uk;
        $category->save();
        
        //2
        $category = new Category();
        $category->parent_id = null;
        $category->icon = '/img/template/category-icon/hoodie.png';
        $category->name_ru = 'Свитшоты & толстовки';
        $category->name_uk = 'Світшоти & толстовки';
        $category->slug = str_slug('Свитшоты & толстовки');
        $category->description_ru = $faker->text(191);
        $category->description_uk = $faker->text(191);
        $category->save();
        $category->meta_title_ru = "$category->name_ru купить в интернет-магазине Feel And Fly";
        $category->meta_title_uk = "$category->name_uk купить в интернет-магазине Feel And Fly";
        $category->meta_description_ru = "Купить $category->name_ru за лучшими ценами в интернет-магазине Feel And Fly ? (068) 000 00 00 ? (093) 000 00 00 ? Бесплатная доставка по Украине";
        $category->meta_description_uk = "Купити $category->name_uk за найкращими цiнами в iнтернет-магазині Feel And Fly ? (068) 000 00 00 ? (093) 000 00 00 ? Безкоштовна доставка по Україні";
        $category->meta_keywords_ru = "$category->name_ru купить в интернет-магазине Feel And Fly";
        $category->meta_keywords_uk = "$category->name_uk купить в интернет-магазине Feel And Fly";
        $category->meta_h1_ru = $category->name_ru;
        $category->meta_h1_uk = $category->name_uk;
        $category->save();
        
        //3
        $category = new Category();
        $category->parent_id = null;
        $category->icon = '/img/template/category-icon/jeans.png';
        $category->name_ru = 'Штаны';
        $category->name_uk = 'Штани';
        $category->slug = str_slug('Штаны');
        $category->description_ru = $faker->text(191);
        $category->description_uk = $faker->text(191);
        $category->save();
        $category->meta_title_ru = "$category->name_ru купить в интернет-магазине Feel And Fly";
        $category->meta_title_uk = "$category->name_uk купить в интернет-магазине Feel And Fly";
        $category->meta_description_ru = "Купить $category->name_ru за лучшими ценами в интернет-магазине Feel And Fly ? (068) 000 00 00 ? (093) 000 00 00 ? Бесплатная доставка по Украине";
        $category->meta_description_uk = "Купити $category->name_uk за найкращими цiнами в iнтернет-магазині Feel And Fly ? (068) 000 00 00 ? (093) 000 00 00 ? Безкоштовна доставка по Україні";
        $category->meta_keywords_ru = "$category->name_ru купить в интернет-магазине Feel And Fly";
        $category->meta_keywords_uk = "$category->name_uk купить в интернет-магазине Feel And Fly";
        $category->meta_h1_ru = $category->name_ru;
        $category->meta_h1_uk = $category->name_uk;
        $category->save();
        
        //4
        $category = new Category();
        $category->parent_id = null;
        $category->icon = '/img/template/category-icon/shorts.png';
        $category->name_ru = 'Шорты';
        $category->name_uk = 'Шорти';
        $category->slug = str_slug('Шорты');
        $category->description_ru = $faker->text(191);
        $category->description_uk = $faker->text(191);
        $category->save();
        $category->meta_title_ru = "$category->name_ru купить в интернет-магазине Feel And Fly";
        $category->meta_title_uk = "$category->name_uk купить в интернет-магазине Feel And Fly";
        $category->meta_description_ru = "Купить $category->name_ru за лучшими ценами в интернет-магазине Feel And Fly ? (068) 000 00 00 ? (093) 000 00 00 ? Бесплатная доставка по Украине";
        $category->meta_description_uk = "Купити $category->name_uk за найкращими цiнами в iнтернет-магазині Feel And Fly ? (068) 000 00 00 ? (093) 000 00 00 ? Безкоштовна доставка по Україні";
        $category->meta_keywords_ru = "$category->name_ru купить в интернет-магазине Feel And Fly";
        $category->meta_keywords_uk = "$category->name_uk купить в интернет-магазине Feel And Fly";
        $category->meta_h1_ru = $category->name_ru;
        $category->meta_h1_uk = $category->name_uk;
        $category->save();
        
        //5
        $category = new Category();
        $category->parent_id = null;
        $category->icon = '/img/template/category-icon/backpack.png';
        $category->name_ru = 'Аксессуары';
        $category->name_uk = 'Аксесуари';
        $category->slug = str_slug('Аксессуары');
        $category->description_ru = $faker->text(191);
        $category->description_uk = $faker->text(191);
        $category->save();
        $category->meta_title_ru = "$category->name_ru купить в интернет-магазине Feel And Fly";
        $category->meta_title_uk = "$category->name_uk купить в интернет-магазине Feel And Fly";
        $category->meta_description_ru = "Купить $category->name_ru за лучшими ценами в интернет-магазине Feel And Fly ? (068) 000 00 00 ? (093) 000 00 00 ? Бесплатная доставка по Украине";
        $category->meta_description_uk = "Купити $category->name_uk за найкращими цiнами в iнтернет-магазині Feel And Fly ? (068) 000 00 00 ? (093) 000 00 00 ? Безкоштовна доставка по Україні";
        $category->meta_keywords_ru = "$category->name_ru купить в интернет-магазине Feel And Fly";
        $category->meta_keywords_uk = "$category->name_uk купить в интернет-магазине Feel And Fly";
        $category->meta_h1_ru = $category->name_ru;
        $category->meta_h1_uk = $category->name_uk;
        $category->save();
    }
}
