<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SearchEditUserCollection extends ResourceCollection
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
                    'email' => $record->user_email,
                    'state' => $record->user_state,
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
                    'birthdate' => $record->people_birthdate,
                    // father    : record.people.father,
                    'phone' => $record->people_phone,
                    'mobile' => $record->people_mobile,
                    'address'  => $record->people_address,
                    'picture' => $record->people_picture,
                    'pictureUrl' =>  \App\People::getPictureUrl($record->people_picture),
                ],
                 'melliat'=> [
                    'id' => $record->melliat_id,
                    'name'=> $record->melliat_name
                ],
                'gender'=>[
                    'id' => $record->gender_id,
                    'gender' => $record->gender_gender
                ],
                'province' =>[
                    'id' => $record->province_id,
                    'name'=> $record->province_name
                ],
                'city' =>[
                    'id' => $record->city_id,
                    'name' => $record->city_name
                ],
                'card' => [
                    'id' => $record->card_id,
                    'cdn' => $record->card_cdn,
                    'state' => $record->card_state,
                    'startDate' => $record->card_startDate,
                    'endDate'=>  $record->card_endDate,

                ],
                'cardtype' =>[
                    'id' => $record->cardtype_id,
                    'name' => $record->cardtype_name
                ],

                'staff' =>[
                    'id' => $record->staff_id,
                ],
                'contract' => [
                    'id' => $record->contract_id,
                    'name' => $record->contract_name
                ],
                'department'=> [
                    'id' => $record->department_id,
                    'name' => $record->department_name
                ],

                'teacher' => [
                    'id' => $record->teache_id,
                    'semat' => $record->teacher_semat
                ],
                'student' => [
                    'id' => $record->student_id,
                    'year' => $record->student_year,
                    'term'=> $record->student_term,
                    'native' => $record->student_native,
                    'suit' => $record->student_suit,
                ],
                'situation' => [
                    'id' => $record->situation_id,
                    'name' => $record->situation_name
                ],
                'degree' => [
                    'id' => $record->degree_id,
                    'name' => $record->degree_name
                ],
                'field' =>[
                    'id' => $record->field_id,
                    'name' => $record->field_name
                ],
                'university' => [
                    'id' => $record->university_id,
                    'name' => $record->university_name,
                ],
                'part' => [
                    'id' => $record->part_id,
                    'name' => $record->part_name
                ],
            ];
        }

        return [
            'data' => $data
        ];
    }
}
