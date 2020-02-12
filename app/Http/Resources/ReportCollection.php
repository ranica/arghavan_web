<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ReportCollection extends ResourceCollection
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
                    'id' => $record->user_id,
                    'code' => $record->user_code,
                ],
                'group' => [
                    'name' => $record->group_name
                ],
                'people' => [
                    'name' => $record->people_name,
                    'lastname' => $record->people_lastname,
                    'nationalId' =>  $record->people_nationalId,
                ],
                'gatemessage' => [
                    'name' => $record->gatemessage_name,
                ],
                'gatedirect' => [
                    'name' => $record->gatedirect_name,
                ],

                // 'card' => [
                //     'id' => $record->card_id,
                //     'cdn' => $record->card_cdn,
                //     'startDate' => $record->card_startDate,
                //     'endDate' => $record->card_endDate,
                //     'stateStr' => $record->stateStr,
                // ],
                //  'cardtype' => [
                //     'id' => $record->cardtype_id,
                //     'name' => $record->cardtype_name,
                // ],
                'gatetraffic' => [
                    'gatedate' => $record->gatetraffic_gatedate,
                    // 'count' => $record->gatetraffic_count,

                ],
            ];
        }

        return [
            'data' => $data
        ];
    }
}
