<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class GateoptionRequest extends FormRequest
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
        return [
            'startDate' => 'required',
            'endDate'   => 'required',
            'port'      => 'required|numeric|min:2|max:100000',
            // 'genzonew_id'   => 'required|numeric|exists:gatezones,id',
            // 'genzonem_id'   => 'required|numeric|exists:gatezones,id'

            /// TODO: Check other columns
        ];
    }
}
