<?php

use Illuminate\Database\Seeder;

class KinTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Kintype::create([
            'name' => 'پدر'
        ]);

        \App\Kintype::create([
            'name' => 'مادر'
        ]);

         \App\Kintype::create([
            'name' => 'برادر'
        ]);

          \App\Kintype::create([
            'name' => 'خواهر'
        ]);
    }
}
