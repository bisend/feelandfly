<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $this->seed();
    }

    public function seed()
    {
        $faker = Faker\Factory::create();
        
        for ($i = 1; $i <= 10000; $i++)
        {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->email
            ]);
        }
    }
}
