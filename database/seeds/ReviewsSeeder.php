<?php

use App\DatabaseModels\Review;
use Illuminate\Database\Seeder;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Review::truncate();
        $this->command->info('[reviews] table truncated...');

        $this->seed();

        $this->command->info('[reviews] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function seed()
    {
        $faker = Faker\Factory::create();
        
        DB::beginTransaction();

        for ($i = 1; $i <= 620; $i++)
        {
            for ($j = 1; $j <= 10; $j++)
            {
                $review = new Review();

                $review->product_id = $i;

                $review->review = $faker->text(200);

                $review->name = $faker->name();

                $review->email = $faker->email;

                $review->rating = rand(1, 5);

                $review->is_moderated = true;

                $review->save();
            }
        }
        DB::commit();
    }
}
