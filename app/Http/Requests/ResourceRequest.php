<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResourceRequest extends FormRequest
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
        if ( ! is_null($this->resource))
        {
            $modifyCriteria = ',name,' . $this->resource->id;
            $stateCriteria  = ',state,' . $this->resource->id;
        }
        else
        {
            $modifyCriteria = '';
            $stateCriteria = '';
        }

        return [
            'name'  => 'required|min:2|max:50|unique:resources'.$modifyCriteria,           
            'state' => 'required:resources'.$stateCriteria          
        ];
    }
}
