<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BuildingInformationRequest extends FormRequest
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
                'building_id'   => 'required|numeric|exists:buildings,id',
                'term_id'   => 'required|numeric|exists:terms,id',
                'degree_id'   => 'required|numeric|exists:degrees,id'
            ];
        }

        if (($method == "put") || ($method == "push"))
        {
            $id = $this->buildingInformation->id;

            return [
                'building_id'   => 'required|numeric|exists:buildings,id',
                'term_id'   => 'required|numeric|exists:terms,id',
                'degree_id'   => 'required|numeric|exists:degrees,id'
            ];
        }

        return [];
    }
}
