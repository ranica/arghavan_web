<?php

use Illuminate\Database\Seeder;

class CarPlateCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fileName_city = base_path() . DIRECTORY_SEPARATOR . 'JsonData' .
                                       DIRECTORY_SEPARATOR . 'plate.json';

        if( file_exists($fileName_city))
        {

            $content = \File::get($fileName_city);
            $jsonData = json_decode($content);

            $city = $jsonData->city->data;


            for ($i= 0; $i < count($city) ; $i++)
            {
                $search = $city[$i]->name;

                $value = \App\Province::where('name' , 'like', '%'. $search .'%')
                                                ->get()[0];

                \App\CarPlateCity::create([
                                    'key' =>  $city[$i]->number,
                                    'province_id' => $value->id
                                ]);

            }

        }
    }
}
