<?php

use Illuminate\Database\Seeder;

class CommonRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\CommonRange::create([
            'name' => 'امروز',
        ]);

        \App\CommonRange::create([
            'name' => 'هفته گذشته',
        ]);

        \App\CommonRange::create([
            'name' => 'ماه گذشته',
        ]);

        \App\CommonRange::create([
            'name' => 'شش ماه گذشته',
        ]);

        \App\CommonRange::create([
            'name' => 'سال گذشته',
        ]);
    }
}
