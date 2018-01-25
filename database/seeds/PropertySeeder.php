<?php

use App\DatabaseModels\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Property::truncate();
        $this->command->info('[properties] table truncated...');

        DB::beginTransaction();
        $this->seed();
        DB::commit();

        $this->command->info('[properties] table seeded...');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
    
    public function seed()
    {
        for ($i = 1; $i <= 620; $i++)
        {
            for ($j = 1; $j <= 4; $j++)
            {
                if ($j = 1)
                {
                    $property = new Property();
                    $property->product_id = $i;
                    $property->property_name_id = $j;
                    $property->property_value_id = rand(1, 5);
                    $property->save();
                }
                if ($j = 2)
                {
                    $property = new Property();
                    $property->product_id = $i;
                    $property->property_name_id = $j;
                    $property->property_value_id = rand(6, 9);
                    $property->save();
                }
                if ($j = 3)
                {
                    for ($k = 10; $k <= 14; $k++)
                    {
                        $property = new Property();
                        $property->product_id = $i;
                        $property->property_name_id = $j;
                        $property->property_value_id = $k;
                        $property->save();
                    }
                }
                if ($j = 4)
                {
                    $property = new Property();
                    $property->product_id = $i;
                    $property->property_name_id = $j;
                    $property->property_value_id = rand(15, 24);
                    $property->save();
                }
            }
        }
    }
}
