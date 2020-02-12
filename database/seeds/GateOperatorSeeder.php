<?php

use Illuminate\Database\Seeder;

class GateOperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \App\Gateoperator::create([
            'username' => 'admin',
            'password' => '123',
            'name' => 'طراح',
            'lastname' => 'سیستم'
        ]);
    }
}
