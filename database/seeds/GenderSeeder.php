<?php

use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Gender::create([
            'gender' => 'مرد'
        ]);

        \App\Gender::create([
            'gender' => 'زن'
        ]);
    }
}
