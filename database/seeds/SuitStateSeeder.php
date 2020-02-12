<?php

use Illuminate\Database\Seeder;

class SuitStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \App\SuitState::create([
            'suit' => 'خوابگاهی می باشد'
        ]);

        \App\SuitState::create([
            'suit' => 'خوابگاهی نمی باشد'
        ]);
    }
}
