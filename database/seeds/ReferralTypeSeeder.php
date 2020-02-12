<?php

use Illuminate\Database\Seeder;

class ReferralTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\ReferralType::create([
        	'name' => 'ارباب رجوع'
        ]);

        \App\ReferralType::create([
        	'name' => 'میهمان'
        ]);

        \App\ReferralType::create([
        	'name' => 'مدعوین'
        ]);

        \App\ReferralType::create([
        	'name' => 'پیک'
        ]);

        \App\ReferralType::create([
        	'name' => 'اتباع خارجی'
        ]);
    }
}
