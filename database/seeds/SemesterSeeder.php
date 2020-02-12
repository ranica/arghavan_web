<?php

use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Semester::create([
            'name' => 'نیمسال اول'
        ]);

        \App\Semester::create([
            'name' => 'نیمسال دوم'
        ]);

        \App\Semester::create([
            'name' => 'ترم تابستانی'
        ]);
    }
}
