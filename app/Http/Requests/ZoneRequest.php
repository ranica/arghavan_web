<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZoneRequest extends FormRequest
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
        if ( ! is_null($this->zone))
        {
            $modifyCriteria = ',name,' . $this->zone->id;
        }
        else
        {
            $modifyCriteria = '';
        }

        return [
            'name'          => 'required|min:2|max:50|unique:zones' . $modifyCriteria           
        ];
    }
}
