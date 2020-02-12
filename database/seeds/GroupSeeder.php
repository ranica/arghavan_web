<?php

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Group::create([
            'name' => 'کارمند'
        ]);

        \App\Group::create([
            'name' => 'اساتید'
        ]);

        \App\Group::create([
            'name' => 'دانشجویان'
        ]);
    }
}
