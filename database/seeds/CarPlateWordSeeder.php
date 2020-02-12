<?php

use Illuminate\Database\Seeder;

class CarPlateWordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fileName_PlateWord = base_path() . DIRECTORY_SEPARATOR . 'JsonData' .
                                            DIRECTORY_SEPARATOR . 'plateWord.json';

        if( file_exists($fileName_PlateWord))
        {
            $content = \File::get($fileName_PlateWord);

            $jsonData = json_decode($content);

            $value = $jsonData->PlateWord->data;

            for ($i= 0; $i < count($value); $i++)
            {
                \App\CarPlateWord::create([
                    'name' => $value[$i]->state
                ]);
            }

        }
    }
}
