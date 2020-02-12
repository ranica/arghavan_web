<?php

use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fileName_province = base_path() . DIRECTORY_SEPARATOR . 'JsonData' .
                                DIRECTORY_SEPARATOR . 'province.json';

        if( file_exists($fileName_province))
        {
            $content = \File::get($fileName_province);

            $jsonData = json_decode($content);

            $value = $jsonData->province->data;

            for ($i= 0; $i < count($value); $i++) 
            {
               \App\Province::create([

                        'name' => $value[$i]->state
                ]);
            }
           
        }
    }
}
