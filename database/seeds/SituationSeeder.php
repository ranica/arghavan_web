<?php

use Illuminate\Database\Seeder;

class SituationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \App\Situation::create([
            'name' => 'مشغول به تحصیل',
            'state' => true
        ]);

        \App\Situation::create([
            'name' => 'میهمان از دانشگاه دیگر',
            'state' => true
        ]);

        \App\Situation::create([
            'name' => 'در حال تسویه',
            'state' => false
        ]);

        \App\Situation::create([
            'name' => 'انصرافی',
            'state' => false
        ]);

        \App\Situation::create([
            'name' => 'اخراجی',
            'state' => false
        ]);
    }
}
