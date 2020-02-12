<?php

use Illuminate\Database\Seeder;

class NativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Native::create([
            'native' => 'بومی'
        ]);

          \App\Native::create([
            'native' => 'غیر بومی'
        ]);    
    }
}
