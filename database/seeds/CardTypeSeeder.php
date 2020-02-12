<?php

use Illuminate\Database\Seeder;

class CardTypeSeeder extends Seeder
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
            'name' => 'آموزش'
        ]);

        \App\Cardtype::create([
            'name' => 'اساتید'
        ]);

        \App\Cardtype::create([
            'name' => 'خودرو'
        ]);

        \App\Cardtype::create([
            'name' => 'موقت'
        ]);

        \App\Cardtype::create([
            'name' => 'سایر'
        ]);
    }
}
