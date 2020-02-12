<?php

use Illuminate\Database\Seeder;

class GateGenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Gategender::create([            
            'gender' => 'زن و مرد'
         ]);
        
        \App\Gategender::create([            
            'gender' => 'مرد'
        ]);

        \App\Gategender::create([            
            'gender' => 'زن'
        ]);      
    }
}
