<?php

use App\DatabaseModels\Category;
use App\DatabaseModels\MetaTag;
use App\DatabaseModels\Product;
use Illuminate\Database\Seeder;

class MetaTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        MetaTag::truncate();
        $this->command->info('[meta_tags] table truncated...');

        DB::beginTransaction();
        $this->seed();
        DB::commit();

        $this->command->info('[meta_tags] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function seed()
    {
        $metaTag = new MetaTag();
        $metaTag->page_name = 'home';
        $metaTag->meta_title_ru = 'FEEL and FLY - официальный сайт бренд молодежной одежды.';
        $metaTag->meta_title_uk = 'FEEL and FLY - офіційний сайт бренд молодіжного одягу.';
        $metaTag->meta_description_ru = 'Feel and Fly streetwear - бренд молодежной одежди в стиле streetwear.
         Качественная, удобная, стильная одежда по самым доступным ценам от производителя!';
        $metaTag->meta_description_uk = 'Feel and Fly streetwear - бренд молодежной одежди в стиле streetwear.
         Качественная, удобная, стильная одежда по самым доступным ценам от производителя!';
        $metaTag->meta_keywords_ru = 'lorem ipsum ru';
        $metaTag->meta_keywords_uk = 'lorem ipsum uk';
        $metaTag->meta_h1_ru = 'lorem ipsum ru';
        $metaTag->meta_h1_uk = 'lorem ipsum uk';
        $metaTag->save();

        $metaTag = new MetaTag();
        $metaTag->page_name = 'search';
        $metaTag->meta_title_ru = 'Результат поиска';
        $metaTag->meta_title_uk = 'Результат пошуку';
        $metaTag->meta_description_ru = 'lorem ipsum ru';
        $metaTag->meta_description_uk = 'lorem ipsum uk';
        $metaTag->meta_keywords_ru = 'lorem ipsum ru';
        $metaTag->meta_keywords_uk = 'lorem ipsum uk';
        $metaTag->meta_h1_ru = 'lorem ipsum ru';
        $metaTag->meta_h1_uk = 'lorem ipsum uk';
        $metaTag->save();

        $metaTag = new MetaTag();
        $metaTag->page_name = 'order';
        $metaTag->meta_title_ru = 'Оформление заказа | FEEL and FLY | Интернет-магазин';
        $metaTag->meta_title_uk = 'Оформлення замовлення | FEEL and FLY | Інтернет-магазин';
        $metaTag->meta_description_ru = 'lorem ipsum ru';
        $metaTag->meta_description_uk = 'lorem ipsum uk';
        $metaTag->meta_keywords_ru = 'lorem ipsum ru';
        $metaTag->meta_keywords_uk = 'lorem ipsum uk';
        $metaTag->meta_h1_ru = 'lorem ipsum ru';
        $metaTag->meta_h1_uk = 'lorem ipsum uk';
        $metaTag->save();

        $metaTag = new MetaTag();
        $metaTag->page_name = 'profile-personal-info';
        $metaTag->meta_title_ru = 'Личные данные | FEEL and FLY | Интернет-магазин';
        $metaTag->meta_title_uk = 'Особисті дані | FEEL and FLY | Інтернет-магазин';
        $metaTag->meta_description_ru = 'lorem ipsum ru';
        $metaTag->meta_description_uk = 'lorem ipsum uk';
        $metaTag->meta_keywords_ru = 'lorem ipsum ru';
        $metaTag->meta_keywords_uk = 'lorem ipsum uk';
        $metaTag->meta_h1_ru = 'lorem ipsum ru';
        $metaTag->meta_h1_uk = 'lorem ipsum uk';
        $metaTag->save();

        $metaTag = new MetaTag();
        $metaTag->page_name = 'profile-payment-delivery';
        $metaTag->meta_title_ru = 'Доставка и оплата | FEEL and FLY | Интернет-магазин';
        $metaTag->meta_title_uk = 'Доставка та оплата | FEEL and FLY | Інтернет-магазин';
        $metaTag->meta_description_ru = 'lorem ipsum ru';
        $metaTag->meta_description_uk = 'lorem ipsum uk';
        $metaTag->meta_keywords_ru = 'lorem ipsum ru';
        $metaTag->meta_keywords_uk = 'lorem ipsum uk';
        $metaTag->meta_h1_ru = 'lorem ipsum ru';
        $metaTag->meta_h1_uk = 'lorem ipsum uk';
        $metaTag->save();

        $metaTag = new MetaTag();
        $metaTag->page_name = 'profile-wish-list';
        $metaTag->meta_title_ru = 'Список желаний | FEEL and FLY | Интернет-магазин';
        $metaTag->meta_title_uk = 'Список бажань | FEEL and FLY | Інтернет-магазин';
        $metaTag->meta_description_ru = 'lorem ipsum ru';
        $metaTag->meta_description_uk = 'lorem ipsum uk';
        $metaTag->meta_keywords_ru = 'lorem ipsum ru';
        $metaTag->meta_keywords_uk = 'lorem ipsum uk';
        $metaTag->meta_h1_ru = 'lorem ipsum ru';
        $metaTag->meta_h1_uk = 'lorem ipsum uk';
        $metaTag->save();

        $metaTag = new MetaTag();
        $metaTag->page_name = 'profile-my-orders';
        $metaTag->meta_title_ru = 'Мои заказы | FEEL and FLY | Интернет-магазин';
        $metaTag->meta_title_uk = 'Мої замовлення | FEEL and FLY | Інтернет-магазин';
        $metaTag->meta_description_ru = 'lorem ipsum ru';
        $metaTag->meta_description_uk = 'lorem ipsum uk';
        $metaTag->meta_keywords_ru = 'lorem ipsum ru';
        $metaTag->meta_keywords_uk = 'lorem ipsum uk';
        $metaTag->meta_h1_ru = 'lorem ipsum ru';
        $metaTag->meta_h1_uk = 'lorem ipsum uk';
        $metaTag->save();

        $metaTag = new MetaTag();
        $metaTag->page_name = 'lookbook-all';
        $metaTag->meta_title_ru = 'Lookbook | FEEL and FLY | Интернет-магазин';
        $metaTag->meta_title_uk = 'Lookbook | FEEL and FLY | Інтернет-магазин';
        $metaTag->meta_description_ru = 'lorem ipsum ru';
        $metaTag->meta_description_uk = 'lorem ipsum uk';
        $metaTag->meta_keywords_ru = 'lorem ipsum ru';
        $metaTag->meta_keywords_uk = 'lorem ipsum uk';
        $metaTag->meta_h1_ru = 'lorem ipsum ru';
        $metaTag->meta_h1_uk = 'lorem ipsum uk';
        $metaTag->save();

        $metaTag = new MetaTag();
        $metaTag->page_name = 'about';
        $metaTag->meta_title_ru = 'О нас | FEEL and FLY | Интернет-магазин';
        $metaTag->meta_title_uk = 'Про нас | FEEL and FLY | Інтернет-магазин';
        $metaTag->meta_description_ru = 'lorem ipsum ru';
        $metaTag->meta_description_uk = 'lorem ipsum uk';
        $metaTag->meta_keywords_ru = 'lorem ipsum ru';
        $metaTag->meta_keywords_uk = 'lorem ipsum uk';
        $metaTag->meta_h1_ru = 'lorem ipsum ru';
        $metaTag->meta_h1_uk = 'lorem ipsum uk';
        $metaTag->save();

        $metaTag = new MetaTag();
        $metaTag->page_name = 'contact';
        $metaTag->meta_title_ru = 'Контакты | FEEL and FLY | Интернет-магазин';
        $metaTag->meta_title_uk = 'Контакти | FEEL and FLY | Інтернет-магазин';
        $metaTag->meta_description_ru = 'lorem ipsum ru';
        $metaTag->meta_description_uk = 'lorem ipsum uk';
        $metaTag->meta_keywords_ru = 'lorem ipsum ru';
        $metaTag->meta_keywords_uk = 'lorem ipsum uk';
        $metaTag->meta_h1_ru = 'lorem ipsum ru';
        $metaTag->meta_h1_uk = 'lorem ipsum uk';
        $metaTag->save();

        $metaTag = new MetaTag();
        $metaTag->page_name = 'cooperation';
        $metaTag->meta_title_ru = 'Сотрудничество | FEEL and FLY | Интернет-магазин';
        $metaTag->meta_title_uk = 'Співпраця | FEEL and FLY | Інтернет-магазин';
        $metaTag->meta_description_ru = 'lorem ipsum ru';
        $metaTag->meta_description_uk = 'lorem ipsum uk';
        $metaTag->meta_keywords_ru = 'lorem ipsum ru';
        $metaTag->meta_keywords_uk = 'lorem ipsum uk';
        $metaTag->meta_h1_ru = 'lorem ipsum ru';
        $metaTag->meta_h1_uk = 'lorem ipsum uk';
        $metaTag->save();

        $metaTag = new MetaTag();
        $metaTag->page_name = 'payment-delivery';
        $metaTag->meta_title_ru = 'Оплата и доставка | FEEL and FLY | Интернет-магазин';
        $metaTag->meta_title_uk = 'Оплата та доставка | FEEL and FLY | Інтернет-магазин';
        $metaTag->meta_description_ru = 'lorem ipsum ru';
        $metaTag->meta_description_uk = 'lorem ipsum uk';
        $metaTag->meta_keywords_ru = 'lorem ipsum ru';
        $metaTag->meta_keywords_uk = 'lorem ipsum uk';
        $metaTag->meta_h1_ru = 'lorem ipsum ru';
        $metaTag->meta_h1_uk = 'lorem ipsum uk';
        $metaTag->save();

        $metaTag = new MetaTag();
        $metaTag->page_name = 'error';
        $metaTag->meta_title_ru = 'Ошибка | FEEL and FLY | Интернет-магазин';
        $metaTag->meta_title_uk = 'Помилка | FEEL and FLY | Інтернет-магазин';
        $metaTag->meta_description_ru = 'lorem ipsum ru';
        $metaTag->meta_description_uk = 'lorem ipsum uk';
        $metaTag->meta_keywords_ru = 'lorem ipsum ru';
        $metaTag->meta_keywords_uk = 'lorem ipsum uk';
        $metaTag->meta_h1_ru = 'lorem ipsum ru';
        $metaTag->meta_h1_uk = 'lorem ipsum uk';
        $metaTag->save();

        $metaTag = new MetaTag();
        $metaTag->page_name = 'order-payment';
        $metaTag->meta_title_ru = 'Ваш заказ | FEEL and FLY | Интернет-магазин';
        $metaTag->meta_title_uk = 'Ваше замовлення | FEEL and FLY | Інтернет-магазин';
        $metaTag->meta_description_ru = 'lorem ipsum ru';
        $metaTag->meta_description_uk = 'lorem ipsum uk';
        $metaTag->meta_keywords_ru = 'lorem ipsum ru';
        $metaTag->meta_keywords_uk = 'lorem ipsum uk';
        $metaTag->meta_h1_ru = 'lorem ipsum ru';
        $metaTag->meta_h1_uk = 'lorem ipsum uk';
        $metaTag->save();

//        for ($i = 1; $i <= 620; $i++)
//        {
//            $product = Product::whereId($i)->first();
//            $metaTag = new MetaTag();
//            $metaTag->page_name = 'product';
//            $metaTag->title_ru = "$product->name_ru | FEEL and FLY | Интернет-магазин";
//            $metaTag->title_uk = "$product->name_uk | FEEL and FLY | Інтернет-магазин";
//            $metaTag->description_ru = 'lorem ipsum ru';
//            $metaTag->description_uk = 'lorem ipsum uk';
//            $metaTag->keywords_ru = 'lorem ipsum ru';
//            $metaTag->keywords_uk = 'lorem ipsum uk';
//            $metaTag->h1_ru = 'lorem ipsum ru';
//            $metaTag->h1_uk = 'lorem ipsum uk';
//            $metaTag->save();
//        }
//
//        for ($i = 1; $i <= 5; $i++)
//        {
//            $category = Category::whereId($i)->first();
//            $metaTag = new MetaTag();
//            $metaTag->page_name = 'category';
//            $metaTag->title_ru = "$category->name_ru | FEEL and FLY | Интернет-магазин";
//            $metaTag->title_uk = "$category->name_uk | FEEL and FLY | Інтернет-магазин";
//            $metaTag->description_ru = 'lorem ipsum ru';
//            $metaTag->description_uk = 'lorem ipsum uk';
//            $metaTag->keywords_ru = 'lorem ipsum ru';
//            $metaTag->keywords_uk = 'lorem ipsum uk';
//            $metaTag->h1_ru = 'lorem ipsum ru';
//            $metaTag->h1_uk = 'lorem ipsum uk';
//            $metaTag->save();
//        }
    }
}
