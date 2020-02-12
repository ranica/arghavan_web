<?php

use Illuminate\Database\Seeder;

class VacationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\VacationType::create([
            'name' => 'روزانه',
        ]);

        \App\VacationType::create([
            'name' => 'ساعتی',
        ]);
    }
}
