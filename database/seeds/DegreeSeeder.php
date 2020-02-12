<?php

use Illuminate\Database\Seeder;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \App\Degree::create([
            'name' => 'کاردانی'
        ]);

        \App\Degree::create([
            'name' => 'کارشناسی'
        ]);

        \App\Degree::create([
            'name' => 'کارشناسی ارشد'
        ]);

        \App\Degree::create([
            'name' => 'دکتری'
        ]);

    }
}
