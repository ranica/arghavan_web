<?php

use Illuminate\Database\Seeder;

class GatePassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Gatepass::create([
            'name' => 'دستی'
        ]);

        \App\Gatepass::create([
            'name' => 'کارت'
        ]);

        \App\Gatepass::create([
            'name' => 'اثر انگشت'
        ]);

        \App\Gatepass::create([
            'name' => 'خودرو'
        ]);

        \App\Gatepass::create([
            'name' => 'تشخیص چهره'
        ]);

        \App\Gatepass::create([
            'name' => 'کارت و اثرانگشت'
        ]);

        \App\Gatepass::create([
            'name' => 'کارت و تشخیص چهره'
        ]);

         \App\Gatepass::create([
            'name' => 'اثرانگشت و تشخیص چهره'
        ]);
    }
}
