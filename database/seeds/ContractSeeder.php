<?php

use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \App\Contract::create([
            'name' => 'رسمی'
        ]);

        \App\Contract::create([
            'name' => 'پیمانی'
        ]);

        \App\Contract::create([
            'name' => 'قرار دادی'
        ]);
    }
}
