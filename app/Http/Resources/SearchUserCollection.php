<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SearchUserCollection extends ResourceCollection
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
                    'name' => $record->user_name,
                ],
                'group' => [
                    'id' => $record->group_id,
                    'name' => $record->group_name
                ],
                'people' => [
                    'id' => $record->people_id,
                    'name' => $record->people_name,
                    'lastname' => $record->people_lastname,
                    'nationalId' =>  $record->people_nationalId,
                ],

                'card' => [
                    'cdn' => $record->card_cdn,
                ],

                // 'grouppermits' =>[
                //     'id' =>$record->group_permit_id
                // ],

                // 'gategroups' =>[
                //     'id' =>$record->gategroup_id
                // ],
            ];
        }

        return [
            'data' => $data
        ];
    }
}
