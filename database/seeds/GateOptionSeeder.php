<?php

use Illuminate\Database\Seeder;

class GateOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gateoption = \App\Gateoption::create([
        	'startDate' => \Carbon\Carbon::now()->modify('-2 years'),
        	'endDate' =>  \Carbon\Carbon::now()->modify('+2 years'),
        	'genzonew_id' => '1',
        	'genzonem_id' => '1',
        	'emergency' => '0',
        	'port' => '1430'
        ]);

        /*
        Fill gatedevice_gateoption table
         */
        $gateoption->gatedevices()->attach([ 2, 3 ]);
    }
}
