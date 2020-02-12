<?php

use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Field::create([
            'name' => 'نرم افزار',
            'university_id' => 1,
        ]);

         \App\Field::create([
            'name' => 'مکانیک',
            'university_id' => 1,
        ]);

         \App\Field::create([
            'name' => 'زبان فارسی',
            'university_id' => 2,
        ]);
    }
}
