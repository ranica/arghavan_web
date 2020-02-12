<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CardFilterCollection extends ResourceCollection
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

        foreach ($this->collection as $record)
        {
            $data[] = [
                'user' => [
                    'id' => $record->id,
                    'code' => $record->code,
                    'people' => [
                        'id' => $record->people->id,
                        'name' => $record->people->name,
                        'lastname' => $record->people->lastname,
                        'nationalId' =>  $record->people->nationalId,
                        'pictureThumbUrl' => $record->people->pictureThumbUrl,
                    ],
                ],
                'group' => [
                    'id' => $record->group->id,
                    'name' => $record->group->name
                ],
                'card' =>[
                    'id' => isset($record->cards[0]) ? $record->cards[0]->id : null,
                    'cdn' => isset($record->cards[0]) ? $record->cards[0]->cdn : null,
                    'startDate' => isset($record->cards[0]) ? $record->cards[0]->startDate : null,
                    'endDate' => isset($record->cards[0]) ? $record->cards[0]->endDate : null,
                    'stateStr' => isset($record->cards[0]) ? $record->cards[0]->stateStr : null,
                ],
                 'cardtype' => [
                    'id' => isset($record->cards[0]) ? $record->cards[0]->cardtype->id : null,
                    'name' => isset($record->cards[0]) ? $record->cards[0]->cardtype->name : null,
                ]
            ];
        }

      /*  foreach ($this->collection as $record)
        {
            $data[] = [
                'user' => [
                    'id' => $record->user_id,
                    'code' => $record->user_code,
                    'people' => [
                        'id' => $record->people_id,
                        'name' => $record->people_name,
                        'lastname' => $record->people_lastname,
                        'nationalId' =>  $record->people_nationalId,
                    ],
                ],
                'group' => [
                    'id' => $record->group_id,
                    'name' => $record->group_name
                ],

                'id' => $record->card_id,
                'cdn' => $record->card_cdn,
                'startDate' => $record->card_startDate,
                'endDate' => $record->card_endDate,
                'stateStr' => $record->stateStr,

                 'cardtype' => [
                    'id' => $record->cardtype_id,
                    'name' => $record->cardtype_name,
                ],
            ];
        }*/
        return [
            'data' => $data
        ];
    }
}
