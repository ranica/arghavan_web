<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
    public function rules()
    {
        if (! is_null($this->province))
        {
            $modifyCriteria = ',id,' . $this->province->id;
        }
        else
        {
            $modifyCriteria = '';
        }

        return [
            'name' => 'required|min:2|max:50|unique:provinces' . $modifyCriteria
        ];
    }
}