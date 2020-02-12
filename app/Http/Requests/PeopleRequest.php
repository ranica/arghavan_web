<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeopleRequest extends FormRequest
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
        if ( ! is_null($this->user))
        {
            $modifyCriteria = ',code,' . $this->user->id;
            $groupCriteria  = ',group_id,' . $this->user->id;
        }
        else
        {
            $modifyCriteria    = '';
            $groupCriteria = '';
        }

        if ( ! is_null($this->people))
        {
            $nameCriteria       = ',name,' . $this->people->id;
            $lastnameCriteria   = ',lastname,' . $this->people->id;
            $nationalIdCriteria = ',nationalId,' . $this->people->id;
        }
        else
        {
            $nameCriteria    = '';
            $lastnameCriteria  = '';
            $nationalIdCriteria ='';
        }

        return [
            'code'       => 'required|min:2|max:50|unique:user'.$modifyCriteria,
            'name'       => 'required|min:2|max:50|unique:people'.$nameCriteria,
            'lastname'   => 'required|min:2|max:50|unique:people'.$lastnameCriteria,
            'nationalId' => 'required|min:2|max:10|unique:people'.$nationalIdCriteria,

            'group_id'     => 'required|numeric|exists:groups,id',
            'gender_id'    => 'required|numeric|exists:genders,id',
        ];
    }
}
