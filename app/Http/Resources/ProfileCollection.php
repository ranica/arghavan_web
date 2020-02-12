<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProfileCollection extends ResourceCollection
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
                    'email' => $record->user_email,
                    'state' => $record->user_state,
                ],
                'group' => [
                    'name' => $record->group_name
                ],
                'people' => [
                    'name' => $record->people_name,
                    'lastname' => $record->people_lastname,
                    'nationalId' =>  $record->people_nationalId,
                    'mobile' => $record->people_mobile,
                    'address'  => $record->people_address,
                    'picture' => $record->people_picture,
                    'pictureUrl' =>  \App\People::getPictureUrl($record->people_picture),
                    'pictureThumbUrl' =>  \App\People::getPictureThumbUrl($record->people_picture),
                ],
                 'melliat'=> [
                    'name'=> $record->melliat
                ],
                'gender'=>[
                    'gender' => $record->gender
                ],
                'province' =>[
                    'name'=> $record->province
                ],
                'city' =>[
                    'name' => $record->city
                ],
            ];
        }

        return [
            'data' => $data
        ];
    }
}
