<?php

use App\DatabaseModels\UserType;
use Illuminate\Database\Seeder;

class UserTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        UserType::truncate();
        $this->command->info('[user_types] table truncated...');

        DB::beginTransaction();
        $this->seed();
        DB::commit();

        $this->command->info('[user_types] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function seed()
    {
        $userType = new UserType();
        $userType->type_ru = 'Розничный клиент';
        $userType->type_uk = 'Роздрібний клієнт';
        $userType->slug = URLify::filter('Розничный клиент');
        $userType->is_default = true;
        $userType->save();

        $userType = new UserType();
        $userType->type_ru = 'Дропшиппер';
        $userType->type_uk = 'Дропшиппер';
        $userType->slug = URLify::filter('Дропшиппер');
        $userType->save();

        $userType = new UserType();
        $userType->type_ru = 'Оптовый клиент';
        $userType->type_uk = 'Оптовий клієнт';
        $userType->slug = URLify::filter('Оптовый клиент');
        $userType->save();

        $userType = new UserType();
        $userType->type_ru = 'Менеджер';
        $userType->type_uk = 'Менеджер';
        $userType->slug = URLify::filter('Менеджер');
        $userType->save();
    }
}
