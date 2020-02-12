<?php

use Illuminate\Database\Seeder;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\University::create([
            'name' => 'ادبیات و علوم انسانی',
        ]);

        \App\University::create([
            'name' => 'علوم اجتماعی',
        ]);

        \App\University::create([
            'name' => 'علوم پایه',
        ]);

        \App\University::create([
            'name' => 'علوم و تحقیقات اسلامی',
        ]);

        \App\University::create([
            'name' => 'فنی و مهندسی',
        ]);

        \App\University::create([
            'name' => 'معماری و شهرسازی',
        ]);

        \App\University::create([
            'name' => 'کشاورزی و منابع طبیعی',
        ]);
    }
}
