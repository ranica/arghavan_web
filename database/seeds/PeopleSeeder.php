<?php

use Illuminate\Database\Seeder;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		\App\People::create([
        	'name' => 'کاربر ',
        	'lastname' => 'نامعتبر',
        	'nationalId' => '0000000000',
        	'birthdate' => '2000-01-01',
        	'phone' => '09120000000',
        	'mobile' => '09120000000',
        	'address' => 'تهران',
        	'gender_id' => '1',
        	'melliat_id' => '1',
        	'city_id' => '1',
		]);

        \App\People::create([
        	'name' => 'طراح ',
        	'lastname' => 'سیستم',
        	'nationalId' => '4333333333',
        	'birthdate' => '1988-01-01',
        	'phone' => '02833346688',
        	'mobile' => '09123862018',
        	'address' => 'تهران',
        	'gender_id' => '1',
        	'melliat_id' => '1',
        	'city_id' => '1',
        ]);

        \App\People::create([
        	'name' => 'کارمند' ,
        	'lastname' => 'آزمایشی',
        	'nationalId' => '4233333322',
        	'birthdate' => '1989-01-01',
        	'phone' => '02838956633',
        	'mobile' => '09191502363',
        	'address' => 'قزوین',
        	'gender_id' => '1',
        	'melliat_id' => '1',
        	'city_id' => '4',
        ]);

        \App\People::create([
        	'name' => 'دانشجو',
        	'lastname' => 'آزمایشی',
        	'nationalId' => '6933333322',
        	'birthdate' => '1995-10-04',
        	'phone' => '02837569633',
        	'mobile' => '09199502863',
        	'address' => 'قزوین',
        	'gender_id' => '1',
        	'melliat_id' => '1',
        	'city_id' => '4',
        ]);
    }
}
