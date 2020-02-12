<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BuildingRequest extends FormRequest
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
                'name' => 'required|min:2|max:50|unique:buildings,deleted_at,null',
                'block_id'   => 'required|numeric|exists:blocks,id'
            ];
        }

        if (($method == "put") || ($method == "push"))
        {
            $id = $this->building->id;

            return [
                'name' => 'required|min:2|max:50|unique:buildings,deleted_at,null,name,' . $id,
                'block_id'   => 'required|numeric|exists:blocks,id'
            ];
        }

        return [];
    }
}
