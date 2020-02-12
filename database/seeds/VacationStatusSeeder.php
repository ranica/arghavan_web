<?php

use Illuminate\Database\Seeder;

class VacationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\VacationStatus::create([
        	'name' => 'در حال بررسی'
        ]);

        \App\VacationStatus::create([
        	'name' => 'درخواست موافقت شده'
        ]);

        \App\VacationStatus::create([
        	'name' => 'درخواست مخالفت شده'
        ]);
    }
}
