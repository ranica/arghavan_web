<?php

use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $unkownCard =  \App\Card::create([
                	'cdn' => '0000000',
                	'startDate' => '2018-01-01',
                	'endDate' => '2022-01-01',
                	'state' => '1',
                	'cardtype_id' => '1',
                	// 'group_id' => '1',
                	// 'user_id' => '1',
            	]);

       $rootCard =  \App\Card::create([
            // 'cdn' => 'B697AF1F',
            'cdn' => '3063394079',
            'startDate' => '2018-01-01',
            'endDate' => '2022-01-01',
            'state' => '1',
            'cardtype_id' => '1',
            // 'group_id' => '1',
            // 'user_id' => '2',
        ]);

       $Card01 =  \App\Card::create([
            // 'cdn' => '7A096AD9',
            'cdn' => '2047437529',
            'startDate' => '2018-01-01',
            'endDate' => '2022-01-01',
            'state' => '1',
            'cardtype_id' => '1',
            // 'group_id' => '1',
            // 'user_id' => '2',
        ]);


       $rootCard->users()->attach(2);
       $Card01->users()->attach(3);
    }
}
