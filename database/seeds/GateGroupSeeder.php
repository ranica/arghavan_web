<?php

use Illuminate\Database\Seeder;

class GateGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gate_group_man =  \App\Gategroup::create([
            'name' => ' گروه یک - حراست برادران',
            'description' => 'حراست برادران'
         ]);

        $gate_group_woman = \App\Gategroup::create([
            'name' => ' گروه دو - حراست خواهران',
            'description' => 'حراست خواهران'
         ]);

        $gate_group_man->gatedevices()->attach(2);
        $gate_group_woman->gatedevices()->attach(3);

    }
}
