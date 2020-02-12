<?php

use Illuminate\Database\Seeder;

class GateDirectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Gatedirect::create([
            'name' => 'ورود',
            'type' => 0
        ]);

        \App\Gatedirect::create([
            'name' => 'خروج',
            'type' => 0
        ]);

        \App\Gatedirect::create([
            'name' => 'ورود و خروج',
            'type' => 1
        ]);
    }
}
