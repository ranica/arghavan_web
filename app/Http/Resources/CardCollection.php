<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CardCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [];
        // dd($this->collection);
        foreach ($this->collection as $record)
        {
            $data[] = [
                'group' => [
                    'name' => $record->group_name,
                    ],
                'user' => [
                    'code' => $record->user_code,
                    'people' => [
                        'name' => $record->user_people_name,
                        'lastname' => $record->user_people_lastname,
                    ],
                ],
                'cdn' => $record->card_cdn,
                'startDate' => $record->card_start_date,
                'endDate' => $record->card_end_date,
                'cardtype' => [
                    'name' => $record->cardtype_name
                ],
                'stateStr' =>$record->stateStr,
            ];
        }

        return [
            'data' => $data
        ];
    }
}
