<?php

use App\DatabaseModels\Blog;
use Illuminate\Database\Seeder;

class BlogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Blog::truncate();
        $this->command->info('[blogs] table truncated...');

//        $this->seed();

        $this->command->info('[blogs] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
    
    public function seed()
    {
        $faker = Faker\Factory::create();
        DB::beginTransaction();
        
        for ($i = 323; $i <= 328; $i++)
        {
            $blog = new Blog();
            $blog->image_id = $i;
            $t = $faker->sentence(15, true);
            $blog->title_ru = $t;
            $blog->title_uk = $faker->sentence(15, true);
            $blog->slug = URLify::filter($t);
            $blog->description_ru = $faker->randomHtml(1, 4);
            $blog->description_uk = $faker->randomHtml(1, 4);
            $blog->short_description_ru = $faker->text(80);
            $blog->short_description_uk = $faker->text(80);
            $blog->save();
        }
       
        DB::commit();
    }
}
