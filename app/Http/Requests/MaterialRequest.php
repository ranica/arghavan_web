<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class MaterialRequest extends FormRequest
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
                'code' => 'required|min:1|max:10|unique:materials,deleted_at,null',
                'material_type_id'   => 'required|numeric|exists:materialTypes,id'

            ];
        }

        if (($method == "put") || ($method == "push"))
        {
            $id = $this->material->id;

            return [
                'code' => 'required|min:1|max:10|unique:materials,deleted_at,null,nationalId,' . $id,
                'material_type_id'   => 'required|numeric|exists:materialTypes,id'

            ];
        }

        return [];
    }
}
