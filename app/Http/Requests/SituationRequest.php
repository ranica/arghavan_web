<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SituationRequest extends FormRequest
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
       if ( ! is_null($this->situation))
        {
            $modifyCriteria = ',name,' . $this->situation->id;
            $stateCriteria  = ',state,' . $this->situation->id;
        }
        else
        {
            $modifyCriteria = '';
            $stateCriteria = '';
        }

        return [
            'name'  => 'required|min:2|max:50|unique:situations'.$modifyCriteria,           
            'state' => 'required:situations'.$stateCriteria          
        ];
    }
}
