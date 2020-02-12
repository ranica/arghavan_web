<?php

use Illuminate\Database\Seeder;

class MelliatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \App\Melliat::create([
            'name' => 'ایرانی'
        ]);
    }
}
