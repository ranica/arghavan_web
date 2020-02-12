<?php

use Illuminate\Database\Seeder;

class GateTrafficSeeder extends Seeder
{
    /**
     * Run the gatedateabase seeds.
     *
     * @return void
     */
    public function run()
    {
        $gateoperator = \App\gateoperator::first();
        $user1 = \App\User::first();

        $user2 = \App\User::skip(1)
                          ->take(1)
                          ->get()[0];
        // $user3 = \App\User::skip(2)
        //                   ->take(1)
        //                   ->get()[0];

        $gate2 = \App\Gatedevice::where('name' , 'like', '%'.'دستگاه شماره یک'.'%')
                    ->get()[0];
        $pass1 = \App\Gatepass::where('name', 'like', '%'.'کارت'.'%')
                    ->get()[0];

        $message = \App\Gatemessage::where('message', 'like' , 'تردد انجام شد')
                ->get()[0];
        $direct = \App\Gatedirect::where('name', 'like' , 'ورود')
                ->get()[0];
        $directOut = \App\Gatedirect::where('name', 'like' , 'خروج')
                ->get()[0];

    	/*
    	First Pass
    	 */
        \App\Gatetraffic::create([
        	'user_id' => $user1->id,
        	'gatedate' => \Carbon\Carbon::now(),
        	'gatedevice_id' => $gate2->id,
        	'gatepass_id' => $pass1->id, //Pass by Card
        	'gatedirect_id' => $direct->id, //input
            'gatemessage_id' => $message->id,
        	'gateoperator_id' => $gateoperator->id
        ]);

        \App\Gatetraffic::create([
	    	'user_id' => $user1->id,
	    	'gatedate' => \Carbon\Carbon::now()->modify('-30 minutes'),
	    	'gatedevice_id' => $gate2->id,
	    	'gatepass_id' => $pass1->id, //Pass by Card
	    	'gatedirect_id' => $directOut->id, //output
	    	'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
   		 ]);

        /*
        Second Pass
         */
        \App\Gatetraffic::create([
        	'user_id' => $user2->id,
        	'gatedate' => \Carbon\Carbon::now()->modify('-1 hour'),
        	'gatedevice_id' => $gate2->id,
        	'gatepass_id' => $pass1->id, //Pass by Card
        	'gatedirect_id' => $direct->id, //input
        	'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

        \App\Gatetraffic::create([
	    	'user_id' => $user2->id,
	    	'gatedate' => \Carbon\Carbon::now()->modify('-1 hour +20 minutes'),
	    	'gatedevice_id' => $gate2->id,
	    	'gatepass_id' => $pass1->id, //Pass by Card
	    	'gatedirect_id' => $directOut->id, //output
	    	'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
   		 ]);

        /*
        Thirdy Pass
         */
        \App\Gatetraffic::create([
        	'user_id' => $user1->id,
        	'gatedate' => \Carbon\Carbon::now()->modify('-2 hour +10 minutes'),
        	'gatedevice_id' => $gate2->id,
        	'gatepass_id' => $pass1->id, //Pass by Card
        	'gatedirect_id' => $direct->id, //input
        	'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

        \App\Gatetraffic::create([
	    	'user_id' => $user1->id,
	    	'gatedate' =>  \Carbon\Carbon::now()->modify('-2 hour +30 minutes'),
	    	'gatedevice_id' => $gate2->id,
	    	'gatepass_id' => $pass1->id, //Pass by Card
	    	'gatedirect_id' => $directOut->id, //output
	    	'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
   		 ]);
        /*
        ****************************
         */
        // \App\Gatetraffic::create([
        //     'user_id' => $user3->id,
        //     'gatedate' =>  \Carbon\Carbon::now()->modify('-2 hour +16 minutes'),
        //     'gatedevice_id' => $gate2->id,
        //     'gatepass_id' => $pass1->id, //Pass by Card
        //     'gatedirect_id' => $direct->id, //input
        //    'gatemessage_id' => $message->id,
        //     'gateoperator_id' => $gateoperator->id
        // ]);

        // \App\Gatetraffic::create([
        //     'user_id' => $user3->id,
        //     'gatedate' => \Carbon\Carbon::now()->modify('-2 hour +17 minutes'),
        //     'gatedevice_id' => $gate2->id,
        //     'gatepass_id' => $pass1->id, //Pass by Card
        //     'gatedirect_id' => $directOut->id, //output
        //     'gatemessage_id' => $message->id,
        //     'gateoperator_id' => $gateoperator->id
        //  ]);

        /*
        ****************************
         */
        // \App\Gatetraffic::create([
        //     'user_id' => $user3->id,
        //     'gatedate' => \Carbon\Carbon::now()->modify('-2 hour +50 minutes'),
        //     'gatedevice_id' => $gate2->id,
        //     'gatepass_id' => $pass1->id, //Pass by Card
        //     'gatedirect_id' => $direct->id, //input
        //     'gatemessage_id' => $message->id,
        //     'gateoperator_id' => $gateoperator->id
        // ]);

        // \App\Gatetraffic::create([
        //     'user_id' => $user3->id,
        //     'gatedate' => \Carbon\Carbon::now()->modify('-2 hour +51 minutes'),
        //     'gatedevice_id' => $gate2->id,
        //     'gatepass_id' => $pass1->id, //Pass by Card
        //     'gatedirect_id' => $directOut->id, //output
        //     'gatemessage_id' => $message->id,
        //     'gateoperator_id' => $gateoperator->id
        //  ]);
         /*
        ************************
         */
        \App\Gatetraffic::create([
            'user_id' => $user2->id,
            'gatedate' => \Carbon\Carbon::now()->modify('-1 day  +1 hour'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $direct->id, //input
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

        \App\Gatetraffic::create([
            'user_id' => $user2->id,
            'gatedate' => \Carbon\Carbon::now()->modify('-1 day  +1 hour + 30 minutes'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $directOut->id, //output
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
         ]);

        /*
        ************************
         */
        \App\Gatetraffic::create([
            'user_id' => $user2->id,
            'gatedate' => \Carbon\Carbon::now()->modify('-1 day  +1 hour + 35 minutes'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $direct->id, //input
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

        \App\Gatetraffic::create([
            'user_id' => $user2->id,
            'gatedate' => \Carbon\Carbon::now()->modify('-1 day  +1 hour + 40 minutes'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $directOut->id, //output
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
         ]);
        /*
        Fourty Pass
         */
        \App\Gatetraffic::create([
            'user_id' => $user2->id,
            'gatedate' => \Carbon\Carbon::now()->modify('-1 day  +1 hour + 45 minutes'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $direct->id, //input
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

        \App\Gatetraffic::create([
            'user_id' => $user2->id,
            'gatedate' => \Carbon\Carbon::now()->modify('-1 day  +1 hour + 50 minutes'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $directOut->id, //output
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
         ]);

        /*
        Fourty Pass
         */
        \App\Gatetraffic::create([
            'user_id' => $user2->id,
            'gatedate' => \Carbon\Carbon::now()->modify('-1 day  +2 hour'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $direct->id, //input
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

        \App\Gatetraffic::create([
            'user_id' => $user2->id,
            'gatedate' => \Carbon\Carbon::now()->modify('-1 day  +2 hour +1 minutes'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $directOut->id, //output
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
         ]);

         /*
        Fourty Pass
         */
        // \App\Gatetraffic::create([
        //     'user_id' => $user3->id,
        //     'gatedate' =>  \Carbon\Carbon::now()->modify('-1 day  +2 hour +15 minutes'),
        //     'gatedevice_id' => $gate2->id,
        //     'gatepass_id' => $pass1->id, //Pass by Card
        //     'gatedirect_id' => $direct->id, //input
        //     'gatemessage_id' => $message->id,
        //     'gateoperator_id' => $gateoperator->id
        // ]);

        // \App\Gatetraffic::create([
        //     'user_id' => $user3->id,
        //     'gatedate' =>  \Carbon\Carbon::now()->modify('-1 day  +2 hour +20 minutes'),
        //     'gatedevice_id' => $gate2->id,
        //     'gatepass_id' => $pass1->id, //Pass by Card
        //     'gatedirect_id' => $directOut->id, //output
        //     'gatemessage_id' => $message->id,
        //     'gateoperator_id' => $gateoperator->id
        //  ]);

         /*
        Fifty Pass
         */
        // \App\Gatetraffic::create([
        //     'user_id' => $user3->id,
        //     'gatedate' =>  \Carbon\Carbon::now()->modify('-1 day  +2 hour +25 minutes'),
        //     'gatedevice_id' => $gate2->id,
        //     'gatepass_id' => $pass1->id, //Pass by Card
        //     'gatedirect_id' => $direct->id, //input
        //     'gatemessage_id' => $message->id,
        //     'gateoperator_id' => $gateoperator->id
        // ]);

        // \App\Gatetraffic::create([
        //     'user_id' => $user3->id,
        //     'gatedate' =>  \Carbon\Carbon::now()->modify('-1 day  +2 hour +30 minutes'),
        //     'gatedevice_id' => $gate2->id,
        //     'gatepass_id' => $pass1->id, //Pass by Card
        //     'gatedirect_id' => $directOut->id, //output
        //     'gatemessage_id' => $message->id,
        //     'gateoperator_id' => $gateoperator->id
        //  ]);

        // Date from 2018-06-03 to 2018-06-09 => current week
        //Day : 2018-06-03
         \App\Gatetraffic::create([
            'user_id' => $user1->id,
            'gatedate' =>  \Carbon\Carbon::now()->modify('-1 day  +2 hour +35 minutes'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $direct->id, //input
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

         \App\Gatetraffic::create([
            'user_id' => $user2->id,
            'gatedate' =>  \Carbon\Carbon::now()->modify('-1 day  +2 hour +38 minutes'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $direct->id, //input
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

        //  \App\Gatetraffic::create([
        //     'user_id' => $user3->id,
        //     'gatedate' =>  \Carbon\Carbon::now()->modify('-1 day  +2 hour +40 minutes'),
        //     'gatedevice_id' => $gate2->id,
        //     'gatepass_id' => $pass1->id, //Pass by Card
        //     'gatedirect_id' => $direct->id, //input
        //     'gatemessage_id' => $message->id,
        //     'gateoperator_id' => $gateoperator->id
        // ]);


         \App\Gatetraffic::create([
            'user_id' => $user1->id,
            'gatedate' =>  \Carbon\Carbon::now()->modify('-1 day  +3 hour +0 minutes'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $directOut->id, //output
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

         \App\Gatetraffic::create([
            'user_id' => $user2->id,
            'gatedate' =>  \Carbon\Carbon::now()->modify('-1 day  +3 hour +1 minutes'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $directOut->id, //output
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

        //  \App\Gatetraffic::create([
        //     'user_id' => $user3->id,
        //     'gatedate' => \Carbon\Carbon::now()->modify('-1 day  +3 hour +5 minutes'),
        //     'gatedevice_id' => $gate2->id,
        //     'gatepass_id' => $pass1->id, //Pass by Card
        //     'gatedirect_id' => $directOut->id, //output
        //     'gatemessage_id' => $message->id,
        //     'gateoperator_id' => $gateoperator->id
        // ]);
         /*Day 2
            Day : 2018-06-04
         */
         \App\Gatetraffic::create([
            'user_id' => $user1->id,
            'gatedate' => \Carbon\Carbon::now()->modify('-2 day'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $direct->id, //input
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

         \App\Gatetraffic::create([
            'user_id' => $user2->id,
            'gatedate' => \Carbon\Carbon::now()->modify('-2 day +20 minutes'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $direct->id, //input
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

        //  \App\Gatetraffic::create([
        //     'user_id' => $user3->id,
        //     'gatedate' => \Carbon\Carbon::now()->modify('-2 day +30 minutes'),
        //     'gatedevice_id' => $gate2->id,
        //     'gatepass_id' => $pass1->id, //Pass by Card
        //     'gatedirect_id' => $direct->id, //input
        //     'gatemessage_id' => $message->id,
        //     'gateoperator_id' => $gateoperator->id
        // ]);


         \App\Gatetraffic::create([
            'user_id' => $user1->id,
            'gatedate' => \Carbon\Carbon::now()->modify('-2 day  +6 hour +20 minutes'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $directOut->id, //output
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

         \App\Gatetraffic::create([
            'user_id' => $user2->id,
            'gatedate' => \Carbon\Carbon::now()->modify('-2 day  +6 hour +30 minutes'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $directOut->id, //output
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

        //  \App\Gatetraffic::create([
        //     'user_id' => $user3->id,
        //     'gatedate' => \Carbon\Carbon::now()->modify('-2 day  +6 hour +40 minutes'),
        //     'gatedevice_id' => $gate2->id,
        //     'gatepass_id' => $pass1->id, //Pass by Card
        //     'gatedirect_id' => $directOut->id, //output
        //     'gatemessage_id' => $message->id,
        //     'gateoperator_id' => $gateoperator->id
        // ]);

         /*Day 3
            Day : 2018-06-05
         */
         \App\Gatetraffic::create([
            'user_id' => $user1->id,
            'gatedate' => \Carbon\Carbon::now()->modify('-3 day'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $direct->id, //input
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

         \App\Gatetraffic::create([
            'user_id' => $user2->id,
            'gatedate' => \Carbon\Carbon::now()->modify('-3 day +30 minutes'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $direct->id, //input
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

        //  \App\Gatetraffic::create([
        //     'user_id' => $user3->id,
        //     'gatedate' => \Carbon\Carbon::now()->modify('-3 day +40 minutes'),
        //     'gatedevice_id' => $gate2->id,
        //     'gatepass_id' => $pass1->id, //Pass by Card
        //     'gatedirect_id' => $direct->id, //input
        //     'gatemessage_id' => $message->id,
        //     'gateoperator_id' => $gateoperator->id
        // ]);


         \App\Gatetraffic::create([
            'user_id' => $user1->id,
            'gatedate' => \Carbon\Carbon::now()->modify('-3 day +4 hour +50 minutes'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $directOut->id, //output
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

         \App\Gatetraffic::create([
            'user_id' => $user2->id,
            'gatedate' => \Carbon\Carbon::now()->modify('-3 day +4 hour +58 minutes'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $directOut->id, //output
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

        //  \App\Gatetraffic::create([
        //     'user_id' => $user3->id,
        //     'gatedate' => \Carbon\Carbon::now()->modify('-3 day +5 hour +5 minutes'),
        //     'gatedevice_id' => $gate2->id,
        //     'gatepass_id' => $pass1->id, //Pass by Card
        //     'gatedirect_id' => $directOut->id, //output
        //     'gatemessage_id' => $message->id,
        //     'gateoperator_id' => $gateoperator->id
        // ]);

        //  \App\Gatetraffic::create([
        //     'user_id' => $user3->id,
        //     'gatedate' => \Carbon\Carbon::now()->modify('-3 day +5 hour +5 minutes'),
        //     'gatedevice_id' => $gate2->id,
        //     'gatepass_id' => $pass1->id, //Pass by Card
        //     'gatedirect_id' => $direct->id, //input
        //     'gatemessage_id' => $message->id,
        //     'gateoperator_id' => $gateoperator->id
        // ]);

        //  \App\Gatetraffic::create([
        //     'user_id' => $user3->id,
        //     'gatedate' => \Carbon\Carbon::now()->modify('-3 day +5 hour +50 minutes'),
        //     'gatedevice_id' => $gate2->id,
        //     'gatepass_id' => $pass1->id, //Pass by Card
        //     'gatedirect_id' => $directOut->id, //output
        //     'gatemessage_id' => $message->id,
        //     'gateoperator_id' => $gateoperator->id
        // ]);

         /*Day 4
            Day : 2018-06-06
         */
         \App\Gatetraffic::create([
            'user_id' => $user1->id,
            'gatedate' => \Carbon\Carbon::now()->modify('-4 day'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $direct->id, //input
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

         \App\Gatetraffic::create([
            'user_id' => $user2->id,
            'gatedate' => \Carbon\Carbon::now()->modify('-4 day +5 minutes'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $direct->id, //input
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

        //  \App\Gatetraffic::create([
        //     'user_id' => $user3->id,
        //     'gatedate' => \Carbon\Carbon::now()->modify('-4 day +20 minutes'),
        //     'gatedevice_id' => $gate2->id,
        //     'gatepass_id' => $pass1->id, //Pass by Card
        //     'gatedirect_id' => $direct->id, //input
        //     'gatemessage_id' => $message->id,
        //     'gateoperator_id' => $gateoperator->id
        // ]);


         \App\Gatetraffic::create([
            'user_id' => $user1->id,
            'gatedate' => \Carbon\Carbon::now()->modify('-4 day +7 hour +5 minutes'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $directOut->id, //output
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

         \App\Gatetraffic::create([
            'user_id' => $user2->id,
            'gatedate' => \Carbon\Carbon::now()->modify('-4 day +7 hour +15 minutes'),
            'gatedevice_id' => $gate2->id,
            'gatepass_id' => $pass1->id, //Pass by Card
            'gatedirect_id' => $directOut->id, //output
            'gatemessage_id' => $message->id,
            'gateoperator_id' => $gateoperator->id
        ]);

    }
}
