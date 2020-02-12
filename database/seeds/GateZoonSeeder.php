<?php

use Illuminate\Database\Seeder;

class GateZoonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Gatezone::create([
            'name' => 'به تکرار تردد حساس نباشد'
        ]);

        \App\Gatezone::create([
            'name' => 'تردد دوم توسط نگهبان صادر شود'
        ]);

        \App\Gatezone::create([
            'name' => 'تردد دوم اتوماتیک صادر شود'
        ]);

    }
}
