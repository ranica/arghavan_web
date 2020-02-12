<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FieldRequest extends FormRequest
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
                'name' => 'required|min:2|max:50|unique:fields,deleted_at,null'
            ];
        }

        if (($method == "put") || ($method == "push"))
        {
            $id = $this->field->id;

            return [
                'name' => 'required|min:2|max:50|unique:fields,deleted_at,null,name,' . $id
            ];
        }

        return [];
        /*if ( ! is_null($this->field))
        {
            $modifyCriteria = ',name,' . $this->field->id;
        }
        else
        {
            $modifyCriteria = '';
        }

        return [
            'name'          => 'required|min:2|max:50|unique:fields' . $modifyCriteria,
            'university_id'   => 'required|numeric|exists:universities,id'
        ];*/
    }
}
