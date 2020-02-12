<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $method = $request->method();

        if ($method == "post")
        {
            return [
                'number' => 'required|min:1|max:50|unique:rooms,deleted_at,null',
                'building_id'   => 'required|numeric|exists:buildings,id'
            ];
        }

        if (($method == "put") || ($method == "push"))
        {
            $id = $this->room->id;

            return [
                'number' => 'required|min:2|max:50|unique:rooms,deleted_at,null,number,' . $id,
                'building_id'   => 'required|numeric|exists:buildings,id'
            ];
        }

        return [];
    }
}
