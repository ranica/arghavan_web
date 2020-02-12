<?php

use Illuminate\Database\Seeder;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // دوره تحصیلی
        \App\Part::create([
            'name' => 'روزانه'
        ]);

        \App\Part::create([
            'name' => 'شبانه'
        ]);

        \App\Part::create([
            'name' => 'آموزش محور - روزانه'
        ]);

        \App\Part::create([
            'name' => 'آموزش محور - شبانه'
        ]);

        \App\Part::create([
            'name' => 'نیمه حضوری'
        ]);
    }
}
