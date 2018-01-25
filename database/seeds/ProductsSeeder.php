<?php

use App\DatabaseModels\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Product::truncate();
        $this->command->info('[products] table truncated...');
        
        DB::beginTransaction();
        $this->seed();
        DB::commit();
        
        $this->command->info('[products] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
    
    public function seed()
    {
        $faker = Faker\Factory::create();

        //category 1
        //1
        $product = new Product();
        $product->name_ru = 'БОМБЕР FEEL&FLY NASA NAVY';
        $product->name_uk = 'БОМБЕР FEEL&FLY NASA NAVY';
        $product->slug = URLify::filter('БОМБЕР FEEL&FLY NASA NAVY');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //2
        $product = new Product();
        $product->name_ru = 'БОМБЕР FEEL&FLY FRANKLIN GREEN';
        $product->name_uk = 'БОМБЕР FEEL&FLY FRANKLIN GREEN';
        $product->slug = URLify::filter('БОМБЕР FEEL&FLY FRANKLIN GREEN');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //3
        $product = new Product();
        $product->name_ru = 'МАНТИЯ FEEL&FLY TYSON BLACK';
        $product->name_uk = 'МАНТИЯ FEEL&FLY TYSON BLACK';
        $product->slug = URLify::filter('МАНТИЯ FEEL&FLY TYSON BLACK');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //4
        $product = new Product();
        $product->name_ru = 'КУРТКА FEEL&FLY DENVER NAVY';
        $product->name_uk = 'КУРТКА FEEL&FLY DENVER NAVY';
        $product->slug = URLify::filter('КУРТКА FEEL&FLY DENVER NAVY');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //5
        $product = new Product();
        $product->name_ru = 'БОМБЕР FEEL&FLY LITE NAVY';
        $product->name_uk = 'БОМБЕР FEEL&FLY LITE NAVY';
        $product->slug = URLify::filter('БОМБЕР FEEL&FLY LITE NAVY');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //6
        $product = new Product();
        $product->name_ru = 'БОМБЕР FEEL&FLY LITE BLACK';
        $product->name_uk = 'БОМБЕР FEEL&FLY LITE BLACK';
        $product->slug = URLify::filter('БОМБЕР FEEL&FLY LITE BLACK');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //7
        $product = new Product();
        $product->name_ru = 'КУРТКА FEEL&FLY DENVER BLACK';
        $product->name_uk = 'КУРТКА FEEL&FLY DENVER BLACK';
        $product->slug = URLify::filter('КУРТКА FEEL&FLY DENVER BLACK');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //8
        $product = new Product();
        $product->name_ru = 'КУРТКА FEEL&FLY PRADO BLACK';
        $product->name_uk = 'КУРТКА FEEL&FLY PRADO BLACK';
        $product->slug = URLify::filter('КУРТКА FEEL&FLY PRADO BLACK');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //9
        $product = new Product();
        $product->name_ru = 'КУРТКА FEEL&FLY BUTTON BLACK';
        $product->name_uk = 'КУРТКА FEEL&FLY BUTTON BLACK';
        $product->slug = URLify::filter('КУРТКА FEEL&FLY BUTTON BLACK');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //10
        $product = new Product();
        $product->name_ru = 'БОМБЕР FEEL&FLY FRANKLIN CAMO';
        $product->name_uk = 'БОМБЕР FEEL&FLY FRANKLIN CAMO';
        $product->slug = URLify::filter('БОМБЕР FEEL&FLY FRANKLIN CAMO');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //11
        $product = new Product();
        $product->name_ru = 'КУРТКА FEEL&FLY PRADO NAVY';
        $product->name_uk = 'КУРТКА FEEL&FLY PRADO NAVY';
        $product->slug = URLify::filter('КУРТКА FEEL&FLY PRADO NAVY');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //12
        $product = new Product();
        $product->name_ru = 'БОМБЕР FEEL&FLY RANGER GREEN';
        $product->name_uk = 'БОМБЕР FEEL&FLY RANGER GREEN';
        $product->slug = URLify::filter('БОМБЕР FEEL&FLY RANGER GREEN');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //13
        $product = new Product();
        $product->name_ru = 'ЗИМНЯЯ ПАРКА FEEL&FLY OBAMA CAMO';
        $product->name_uk = 'ЗИМНЯЯ ПАРКА FEEL&FLY OBAMA CAMO';
        $product->slug = URLify::filter('ЗИМНЯЯ ПАРКА FEEL&FLY OBAMA CAMO');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //14
        $product = new Product();
        $product->name_ru = 'БОМБЕР FEEL&FLY LITE GREEN';
        $product->name_uk = 'БОМБЕР FEEL&FLY LITE GREEN';
        $product->slug = URLify::filter('БОМБЕР FEEL&FLY LITE GREEN');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //15
        $product = new Product();
        $product->name_ru = 'ПАРКА FEEL&FLY EAGLE BLACK';
        $product->name_uk = 'ПАРКА FEEL&FLY EAGLE BLACK';
        $product->slug = URLify::filter('ПАРКА FEEL&FLY EAGLE BLACK');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //16
        $product = new Product();
        $product->name_ru = 'КУРТКА FEEL&FLY POCKET BLACK';
        $product->name_uk = 'КУРТКА FEEL&FLY POCKET BLACK';
        $product->slug = URLify::filter('КУРТКА FEEL&FLY POCKET BLACK');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //17
        $product = new Product();
        $product->name_ru = 'АНОРАК FEEL&FLY BALANCE NAVY/BLUE';
        $product->name_uk = 'АНОРАК FEEL&FLY BALANCE NAVY/BLUE';
        $product->slug = URLify::filter('АНОРАК FEEL&FLY BALANCE NAVY/BLUE');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //18
        $product = new Product();
        $product->name_ru = 'КУРТКА FEEL&FLY TORRETO NAVY';
        $product->name_uk = 'КУРТКА FEEL&FLY TORRETO NAVY';
        $product->slug = URLify::filter('КУРТКА FEEL&FLY TORRETO NAVY');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //19
        $product = new Product();
        $product->name_ru = 'ДВУХСТОРОННЯЯ БЕЗРУКАВКА FEEL&FLY СRACKER BLAK/CAMO';
        $product->name_uk = 'ДВУХСТОРОННЯЯ БЕЗРУКАВКА FEEL&FLY СRACKER BLAK/CAMO';
        $product->slug = URLify::filter('ДВУХСТОРОННЯЯ БЕЗРУКАВКА FEEL&FLY СRACKER BLAK/CAMO');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //20
        $product = new Product();
        $product->name_ru = 'КУРТКА FEEL&FLY ARMOR GRAY';
        $product->name_uk = 'КУРТКА FEEL&FLY ARMOR GRAY';
        $product->slug = URLify::filter('КУРТКА FEEL&FLY ARMOR GRAY');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //21
        $product = new Product();
        $product->name_ru = 'КУРТКА FEEL&FLY BUTTON NAVY';
        $product->name_uk = 'КУРТКА FEEL&FLY BUTTON NAVY';
        $product->slug = URLify::filter('КУРТКА FEEL&FLY BUTTON NAVY');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //22
        $product = new Product();
        $product->name_ru = 'АНОРАК FEEL&FLY COVER NAVY/GRAY';
        $product->name_uk = 'АНОРАК FEEL&FLY COVER NAVY/GRAY';
        $product->slug = URLify::filter('АНОРАК FEEL&FLY COVER NAVY/GRAY');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //23
        $product = new Product();
        $product->name_ru = 'КУРТКА FEEL&FLY CONNECT BLACK';
        $product->name_uk = 'КУРТКА FEEL&FLY CONNECT BLACK';
        $product->slug = URLify::filter('КУРТКА FEEL&FLY CONNECT BLACK');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //24
        $product = new Product();
        $product->name_ru = 'КУРТКА FEEL&FLY MEMBRANA COFFEE';
        $product->name_uk = 'КУРТКА FEEL&FLY MEMBRANA COFFEE';
        $product->slug = URLify::filter('КУРТКА FEEL&FLY MEMBRANA COFFEE');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //25
        $product = new Product();
        $product->name_ru = 'АНОРАК FEEL&FLY HALF GRAY';
        $product->name_uk = 'АНОРАК FEEL&FLY HALF GRAY';
        $product->slug = URLify::filter('АНОРАК FEEL&FLY HALF GRAY');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //26
        $product = new Product();
        $product->name_ru = 'КУРТКА FEEL&FLY VERES BLACK / OLIVE';
        $product->name_uk = 'КУРТКА FEEL&FLY VERES BLACK / OLIVE';
        $product->slug = URLify::filter('КУРТКА FEEL&FLY VERES BLACK / OLIVE');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //27
        $product = new Product();
        $product->name_ru = 'АНОРАК FEEL&FLY TAILOR BLACK';
        $product->name_uk = 'АНОРАК FEEL&FLY TAILOR BLACK';
        $product->slug = URLify::filter('АНОРАК FEEL&FLY TAILOR BLACK');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //28
        $product = new Product();
        $product->name_ru = 'ПАРКА FEEL&FLY FELIX KHAKI';
        $product->name_uk = 'ПАРКА FEEL&FLY FELIX KHAKI';
        $product->slug = URLify::filter('ПАРКА FEEL&FLY FELIX KHAKI');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //29
        $product = new Product();
        $product->name_ru = 'БЕЗРУКАВКА FEEL&FLY FISHER GREEN';
        $product->name_uk = 'БЕЗРУКАВКА FEEL&FLY FISHER GREEN';
        $product->slug = URLify::filter('БЕЗРУКАВКА FEEL&FLY FISHER GREEN');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //30
        $product = new Product();
        $product->name_ru = 'БОМБЕР FEEL&FLY MORGAN NAVY MELANGE';
        $product->name_uk = 'БОМБЕР FEEL&FLY MORGAN NAVY MELANGE';
        $product->slug = URLify::filter('БОМБЕР FEEL&FLY MORGAN NAVY MELANGE');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //31
        $product = new Product();
        $product->name_ru = 'БОМБЕР FEEL&FLY SAAB GRAY MELANGE';
        $product->name_uk = 'БОМБЕР FEEL&FLY SAAB GRAY MELANGE';
        $product->slug = URLify::filter('БОМБЕР FEEL&FLY SAAB GRAY MELANGE');
        $product->category_id = 1;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //category 2
        //32
        $product = new Product();
        $product->name_ru = 'ЗИППЕР FEEL&FLY VAUDE BLACK';
        $product->name_uk = 'ЗИППЕР FEEL&FLY VAUDE BLACK';
        $product->slug = URLify::filter('ЗИППЕР FEEL&FLY VAUDE BLACK');
        $product->category_id = 2;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //33
        $product = new Product();
        $product->name_ru = 'ЗИППЕР FEEL&FLY VAUDE NAVY';
        $product->name_uk = 'ЗИППЕР FEEL&FLY VAUDE NAVY';
        $product->slug = URLify::filter('ЗИППЕР FEEL&FLY VAUDE NAVY');
        $product->category_id = 2;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //34
        $product = new Product();
        $product->name_ru = 'ЗИППЕР FEEL&FLY HOLDY GRAY';
        $product->name_uk = 'ЗИППЕР FEEL&FLY HOLDY GRAY';
        $product->slug = URLify::filter('ЗИППЕР FEEL&FLY HOLDY GRAY');
        $product->category_id = 2;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //35
        $product = new Product();
        $product->name_ru = 'ЗИППЕР FEEL&FLY STAR GRAY';
        $product->name_uk = 'ЗИППЕР FEEL&FLY STAR GRAY';
        $product->slug = URLify::filter('ЗИППЕР FEEL&FLY STAR GRAY');
        $product->category_id = 2;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //category 3
        //36
        $product = new Product();
        $product->name_ru = 'ШТАНЫ FEEL&FLY JOGGER STRETCH BLACK';
        $product->name_uk = 'ШТАНЫ FEEL&FLY JOGGER STRETCH BLACK';
        $product->slug = URLify::filter('ШТАНЫ FEEL&FLY JOGGER STRETCH BLACK');
        $product->category_id = 3;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //37
        $product = new Product();
        $product->name_ru = 'ШТАНЫ FEEL&FLY CARGO BLACK';
        $product->name_uk = 'ШТАНЫ FEEL&FLY CARGO BLACK';
        $product->slug = URLify::filter('ШТАНЫ FEEL&FLY CARGO BLACK');
        $product->category_id = 3;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //38
        $product = new Product();
        $product->name_ru = 'ШТАНЫ FEEL&FLY CARGO NAVY';
        $product->name_uk = 'ШТАНЫ FEEL&FLY CARGO NAVY';
        $product->slug = URLify::filter('ШТАНЫ FEEL&FLY CARGO NAVY');
        $product->category_id = 3;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //39
        $product = new Product();
        $product->name_ru = 'ШТАНЫ FEEL&FLY CHINOS DARK BLUE';
        $product->name_uk = 'ШТАНЫ FEEL&FLY CHINOS DARK BLUE';
        $product->slug = URLify::filter('ШТАНЫ FEEL&FLY CHINOS DARK BLUE');
        $product->category_id = 3;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //40
        $product = new Product();
        $product->name_ru = 'ШТАНЫ FEEL&FLY JOGGER DARK BLUE';
        $product->name_uk = 'ШТАНЫ FEEL&FLY JOGGER DARK BLUE';
        $product->slug = URLify::filter('ШТАНЫ FEEL&FLY JOGGER DARK BLUE');
        $product->category_id = 3;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //41
        $product = new Product();
        $product->name_ru = 'ШТАНЫ FEEL&FLY JOGGER STRETCH BLUE';
        $product->name_uk = 'ШТАНЫ FEEL&FLY JOGGER STRETCH BLUE';
        $product->slug = URLify::filter('ШТАНЫ FEEL&FLY JOGGER STRETCH BLUE');
        $product->category_id = 3;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //42
        $product = new Product();
        $product->name_ru = 'ШТАНЫ FEEL&FLY FOREST BLACK';
        $product->name_uk = 'ШТАНЫ FEEL&FLY FOREST BLACK';
        $product->slug = URLify::filter('ШТАНЫ FEEL&FLY FOREST BLACK');
        $product->category_id = 3;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //43
        $product = new Product();
        $product->name_ru = 'ШТАНЫ FEEL&FLY CARGO CAMO NATO';
        $product->name_uk = 'ШТАНЫ FEEL&FLY CARGO CAMO NATO';
        $product->slug = URLify::filter('ШТАНЫ FEEL&FLY CARGO CAMO NATO');
        $product->category_id = 3;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //44
        $product = new Product();
        $product->name_ru = 'ШТАНЫ FEEL&FLY BUCKLE GRAY';
        $product->name_uk = 'ШТАНЫ FEEL&FLY BUCKLE GRAY';
        $product->slug = URLify::filter('ШТАНЫ FEEL&FLY BUCKLE GRAY');
        $product->category_id = 3;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //45
        $product = new Product();
        $product->name_ru = 'СПОРТИВНЫЕ ШТАНЫ FEEL&FLY MAFIA BLACK';
        $product->name_uk = 'СПОРТИВНЫЕ ШТАНЫ FEEL&FLY MAFIA BLACK';
        $product->slug = URLify::filter('СПОРТИВНЫЕ ШТАНЫ FEEL&FLY MAFIA BLACK');
        $product->category_id = 3;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //46
        $product = new Product();
        $product->name_ru = 'ШТАНЫ FEEL&FLY CARGO BROWN';
        $product->name_uk = 'ШТАНЫ FEEL&FLY CARGO BROWN';
        $product->slug = URLify::filter('ШТАНЫ FEEL&FLY CARGO BROWN');
        $product->category_id = 3;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //category 4
        //47
        $product = new Product();
        $product->name_ru = 'ШОРТЫ FEEL&FLY CARGO BLACK';
        $product->name_uk = 'ШОРТЫ FEEL&FLY CARGO BLACK';
        $product->slug = URLify::filter('ШОРТЫ FEEL&FLY CARGO BLACK');
        $product->category_id = 4;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //48
        $product = new Product();
        $product->name_ru = 'ШОРТЫ FEEL&FLY STRETCH CARGO BLUE';
        $product->name_uk = 'ШОРТЫ FEEL&FLY STRETCH CARGO BLUE';
        $product->slug = URLify::filter('ШОРТЫ FEEL&FLY STRETCH CARGO BLUE');
        $product->category_id = 4;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //49
        $product = new Product();
        $product->name_ru = 'ШОРТЫ FEEL&FLY HOLDY GRAY';
        $product->name_uk = 'ШОРТЫ FEEL&FLY HOLDY GRAY';
        $product->slug = URLify::filter('ШОРТЫ FEEL&FLY HOLDY GRAY');
        $product->category_id = 4;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //50
        $product = new Product();
        $product->name_ru = ' ШОРТЫ FEEL&FLY FLAX LITE BLUE';
        $product->name_uk = ' ШОРТЫ FEEL&FLY FLAX LITE BLUE';
        $product->slug = URLify::filter(' ШОРТЫ FEEL&FLY FLAX LITE BLUE');
        $product->category_id = 4;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //51
        $product = new Product();
        $product->name_ru = 'ШОРТЫ FEEL&FLY DERBY NAVY/GRAY';
        $product->name_uk = 'ШОРТЫ FEEL&FLY DERBY NAVY/GRAY';
        $product->slug = URLify::filter('ШОРТЫ FEEL&FLY DERBY NAVY/GRAY');
        $product->category_id = 4;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //52
        $product = new Product();
        $product->name_ru = 'ШОРТЫ FEEL&FLY SUNRISE GRAY/MINT';
        $product->name_uk = 'ШОРТЫ FEEL&FLY SUNRISE GRAY/MINT';
        $product->slug = URLify::filter('ШОРТЫ FEEL&FLY SUNRISE GRAY/MINT');
        $product->category_id = 4;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //53
        $product = new Product();
        $product->name_ru = 'ШОРТЫ FEEL&FLY SUNRISE NAVY/YELLOW';
        $product->name_uk = 'ШОРТЫ FEEL&FLY SUNRISE NAVY/YELLOW';
        $product->slug = URLify::filter('ШОРТЫ FEEL&FLY SUNRISE NAVY/YELLOW');
        $product->category_id = 4;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //54
        $product = new Product();
        $product->name_ru = 'ШОРТЫ FEEL&FLY SUNRISE NAVY/BLUE';
        $product->name_uk = 'ШОРТЫ FEEL&FLY SUNRISE NAVY/BLUE';
        $product->slug = URLify::filter('ШОРТЫ FEEL&FLY SUNRISE NAVY/BLUE');
        $product->category_id = 4;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //category 5
        //55
        $product = new Product();
        $product->name_ru = 'РЮКЗАК FEEL&FLY BACKPACK 25L MELANGE';
        $product->name_uk = 'РЮКЗАК FEEL&FLY BACKPACK 25L MELANGE';
        $product->slug = URLify::filter('РЮКЗАК FEEL&FLY BACKPACK 25L MELANGE');
        $product->category_id = 5;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //56
        $product = new Product();
        $product->name_ru = 'РЮКЗАК FEEL&FLY BACKPACK 23L GRAY';
        $product->name_uk = 'РЮКЗАК FEEL&FLY BACKPACK 23L GRAY';
        $product->slug = URLify::filter('РЮКЗАК FEEL&FLY BACKPACK 23L GRAY');
        $product->category_id = 5;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //57
        $product = new Product();
        $product->name_ru = 'РЮКЗАК FEEL&FLY BACKPACK 23L NAVY';
        $product->name_uk = 'РЮКЗАК FEEL&FLY BACKPACK 23L NAVY';
        $product->slug = URLify::filter('РЮКЗАК FEEL&FLY BACKPACK 23L NAVY');
        $product->category_id = 5;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //58
        $product = new Product();
        $product->name_ru = 'РЮКЗАК FEEL&FLY BACKPACK 23L BLACK';
        $product->name_uk = 'РЮКЗАК FEEL&FLY BACKPACK 23L BLACK';
        $product->slug = URLify::filter('РЮКЗАК FEEL&FLY BACKPACK 23L BLACK');
        $product->category_id = 5;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //59
        $product = new Product();
        $product->name_ru = 'СНЭПБЭК FEEL&FLY SAMPLE #1 BLACK';
        $product->name_uk = 'СНЭПБЭК FEEL&FLY SAMPLE #1 BLACK';
        $product->slug = URLify::filter('СНЭПБЭК FEEL&FLY SAMPLE #1 BLACK');
        $product->category_id = 5;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //60
        $product = new Product();
        $product->name_ru = 'СНЭПБЭК FEEL&FLY SAMPLE #3 BLACK';
        $product->name_uk = 'СНЭПБЭК FEEL&FLY SAMPLE #3 BLACK';
        $product->slug = URLify::filter('СНЭПБЭК FEEL&FLY SAMPLE #3 BLACK');
        $product->category_id = 5;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //61
        $product = new Product();
        $product->name_ru = 'СНЭПБЭК FEEL&FLY SAMPLE #4 BLACK';
        $product->name_uk = 'СНЭПБЭК FEEL&FLY SAMPLE #4 BLACK';
        $product->slug = URLify::filter('СНЭПБЭК FEEL&FLY SAMPLE #4 BLACK');
        $product->category_id = 5;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();

        //62
        $product = new Product();
        $product->name_ru = 'СНЭПБЭК FEEL&FLY SAMPLE #2 BLACK';
        $product->name_uk = 'СНЭПБЭК FEEL&FLY SAMPLE #2 BLACK';
        $product->slug = URLify::filter('СНЭПБЭК FEEL&FLY SAMPLE #2 BLACK');
        $product->category_id = 5;
        $product->breadcrumb_category_id = null;
        $product->description_ru = $faker->text(191);
        $product->description_uk = $faker->text(191);
        $product->vendor_code = $faker->ean8;
        $product->rating = mt_rand(1.00, 5.00);
        $product->save();
    }
}
