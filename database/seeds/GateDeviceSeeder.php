<?php

use Illuminate\Database\Seeder;

class GateDeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pass = \App\Gatepass::where('name', 'like', '%'.'کارت'.'%')
                    ->get()[0];
        /**
         * Logical Device
         */
        \App\Gatedevice::create([
            'name' => 'ثبت دستی تردد',
            'number' => '0',
            'ip' => '8.8.8.8',
            'type' => '1', // Logical
            'device_type_id' => '1', // gate or antenna
            'state' => '1', // active
            'gatepass_id' => $pass->id,
            'gategender_id' => '3',
            'zone_id' => '1',
            'gatedirect_id' => '3',
            'netState' => '0',
            'timepass' => '5',
            'timeserver' => '5'
        ]);

        $gate_device_one = \App\Gatedevice::create([
        	'name' => 'دستگاه شماره یک',
            'number' => '1',
    		'ip' => '192.168.10.10',
            'type' => '0',
    		'state' => '1',
            'device_type_id' => '1', // gate or antenna
            'gatepass_id' => $pass->id,
    		'gategender_id' => '1',
    		'zone_id' => '1',
    		'gatedirect_id' => '3',
    		'netState' => '1',
    		'timepass' => '5',
    		'timeserver' => '5'
        ]);

        $gate_device_two = \App\Gatedevice::create([
        	'name' => 'دستگاه شماره دو',
            'number' => '2',
    		'ip' => '192.168.10.20',
            'type' => '0',
            'state' => '1',
            'device_type_id' => '1', // gate or antenna
            'gatepass_id' => $pass->id,
    		'gategender_id' => '1',
    		'zone_id' => '1',
    		'gatedirect_id' => '3',
    		'netState' => '1',
    		'timepass' => '5',
    		'timeserver' => '5'
        ]);

        $gate_device_one->fingerprintDevices()->attach([1]);


    }
}
