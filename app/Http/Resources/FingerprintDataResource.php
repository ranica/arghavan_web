<?php

namespace App\Http\Resources;
use Image;
use Response;

use Illuminate\Http\Resources\Json\JsonResource;

class FingerprintDataResource extends JsonResource
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
            'user_id'   => $this->user_id,
            'user_code' =>$this->user_code,

            'group_name' => $this->group_name,
            'group_id' =>$this->group_id,

            'people_name' => $this->people->name,
            'people_lastname' => $this->people->lastname,
            'people_nationalId' => $this->people->nationalId,

            'fingerprint_id' => $this->fingerprint_id,
            'fingerprint_user_id' => $this->fingerprint_user_id,
            'fingerprint_image_quality' => $this->fingerprint_image_quality,
            'fingerprint_template' => $this->fingerprint_template,

            'fingerprint_image' => base64_encode($this->fingerprint_image),
        ];


    }
}
