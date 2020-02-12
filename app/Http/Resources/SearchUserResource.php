<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id,
            'user_code' => $this->user_code,
            'group_name' => $this->group_name,
            'group_id' =>$this->group_id,
            'user_name' => $this->user_name,
            'user_state' => $this->user_state,
            'people_id' => $this->people_id,
            'people_name' => $this->people_name,
            'people_lastname' => $this->people_lastname,
            'people_nationalId' => $this->people_nationalId,
            'card_cdn' => $this->card_cdn,
            'card_type_id' => $this->card_type_id,
            'card_state' => $this->card_state,
            'card_endDate' => $this->card_endDate
        ];
    }
}
