<?php

use Illuminate\Database\Seeder;

class DeviceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\DeviceType::create([
            'name' => 'گیت'
        ]);

        \App\DeviceType::create([
            'name' => 'دستگاه اثرانگشت '
        ]);

        \App\DeviceType::create([
            'name' => 'آنتن تردد'
        ]);
    }
}
