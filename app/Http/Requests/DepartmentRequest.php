<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
                'name' => 'required|min:2|max:50|unique:departments,deleted_at,null'
            ];
        }

        if (($method == "put") || ($method == "push"))
        {
            $id = $this->department->id;

            return [
                'name' => 'required|min:2|max:50|unique:departments,deleted_at,null,name,' . $id
            ];
        }

        return [];
    }
}
