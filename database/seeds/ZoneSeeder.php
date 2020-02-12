<?php

use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Zone::create([
        	'name' => 'سر درب برادران'
        ]);

        \App\Zone::create([
        	'name' => 'سر درب خواهران'
        ]);
    }
}
