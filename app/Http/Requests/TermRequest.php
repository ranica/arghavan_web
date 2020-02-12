<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class TermRequest extends FormRequest
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
                'year' => 'required|min:2|max:50|unique:terms,deleted_at,null'
            ];
        }

        if (($method == "put") || ($method == "push"))
        {
            $id = $this->term->id;

            return [
                'year' => 'required|min:2|max:50|unique:terms,deleted_at,null,year,' . $id,
                'semester_id' => 'required|numeric|exists:semesters,id',
            ];
        }

        return [];
    }
}
