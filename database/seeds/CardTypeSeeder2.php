<?php

use Illuminate\Database\Seeder;

class CardTypeSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Cardtype::create([
            'name' => 'کارمندی'
        ]);

        \App\Cardtype::create([
            'name' => 'اساتید'
        ]);

        \App\Cardtype::create([
            'name' => 'خودرو'
        ]);


        \App\Cardtype::create([
            'name' => 'سایر'
        ]);
    }
}
