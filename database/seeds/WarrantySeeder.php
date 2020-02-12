<?php

use Illuminate\Database\Seeder;

class WarrantySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Warranty::create([
        	'name' => 'کارت ملی'
        ]);

        \App\Warranty::create([
        	'name' => 'گواهی نامه'
        ]);

        \App\Warranty::create([
        	'name' => 'شناسنامه'
        ]);
    }
}
