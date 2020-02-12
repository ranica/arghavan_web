<?php

use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Term::create([
            'semester_id' => '1',
            'year' => '97',
            'startDate' => \Carbon\Carbon::now()->modify('-6 month'),
            'endDate' => \Carbon\Carbon::now()->modify('-3. month')
        ]);

        \App\Term::create([
            'semester_id' => '2',
            'year' => '97',
            'startDate' => \Carbon\Carbon::now(),
            'endDate' => \Carbon\Carbon::now()->modify('+4 month')
        ]);
    }
}
