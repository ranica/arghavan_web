<?php

use Illuminate\Database\Seeder;

class CarPlateTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\CarPlateType::create([
            'name' => 'شخصی'
        ]);

        \App\CarPlateType::create([
            'name' => 'عمومی'
        ]);

        \App\CarPlateType::create([
            'name' => 'دولتی'
        ]);

        \App\CarPlateType::create([
            'name' => 'تاکسی'
        ]);

        \App\CarPlateType::create([
            'name' => 'نیروی انتظامی'
        ]);

        \App\CarPlateType::create([
            'name' => 'کشاورزی'
        ]);
    }
}
