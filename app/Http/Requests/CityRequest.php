<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
                'name' => 'required|min:2|max:50|unique:cities,deleted_at,null',
                'province_id'   => 'required|numeric|exists:provinces,id'
            ];
        }

        if (($method == "put") || ($method == "push"))
        {
            $id = $this->city->id;

            return [
                'name' => 'required|min:2|max:50|unique:cities,deleted_at,null,name,' . $id,
                'province_id'   => 'required|numeric|exists:provinces,id'
            ];
        }

        return [];

        // if ( ! is_null($this->city))
        // {
        //     $modifyCriteria = ',name,' . $this->city->id;
        // }
        // else
        // {
        //     $modifyCriteria = '';
        // }

        // return [
        //     'name'          => 'required|min:2|max:50|unique:cities'.$modifyCriteria,
        //     'province_id'   => 'required|numeric|exists:provinces,id'
        // ];
    }
}
