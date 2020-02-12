<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ListDataCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data [] = null;
        foreach ($this->collection as $record)
        {
            foreach ($record->gatedevices as $value)
            {
                foreach ($value->cards as $card)
                {
                    foreach ($card->users as $user)
                    {
                        $data [] = [
                            'ip' => $value->ip,
                            'cdn' =>$card->cdn,
                            'code' => $user->code,
                            'name'=> $user->people->name,
                            'lastname' => $user->people->lastname
                        ];
                    }
                }
            }
        }

        return [
            'data' => $data
        ];
    }
}
