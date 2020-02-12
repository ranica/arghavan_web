<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AmoebaCollection extends ResourceCollection
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
        // dd($this->collection[0]);
        foreach ($this->collection as $record)
        {
            foreach ($record->gatedevices as $value) 
            {
                foreach ($value->cards as $card) 
                {
                   $data [] = [
                                'ip' => $value->ip,
                                'cdn' =>$card->cdn
                   ];
                }
            }
        }

        // return response()->json($data, 200);
        return [
            'data' => $data
        ];
    }
}
