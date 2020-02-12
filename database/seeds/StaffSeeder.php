<?php

use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Staff::create([
        	'user_id' => '1',
        	'contract_id' => '1',
        	'department_id' => '1',
        ]);

        \App\Staff::create([
        	'user_id' => '2',
        	'contract_id' => '2',
        	'department_id' => '1',
        ]);
    }
}
