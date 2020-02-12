<?php

use Illuminate\Database\Seeder;

class SystemInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\SystemInfo::create([
            'key' => 'uni_system',
            'value' => '1',
        ]);
    }
}
