<?php

use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Level::create([
            'name' => 'سطح یک',
            'description' => 'دسترسی کامل طراح سیستم به تمام بخش ها'
        ]);

        \App\Level::create([
            'name' => 'سطح دو',
            'description' => 'دسترسی کامل کارمند مربوطه به استثنا بخش های مد نظر طراح'
        ]);

        \App\Level::create([
            'name' => 'سطح سه',
            'description' => 'دسترسی هر شخص به کارتابل خود'
        ]);
    }
}
