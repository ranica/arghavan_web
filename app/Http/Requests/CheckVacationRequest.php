<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class CheckVacationRequest extends FormRequest
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
                'subject' => 'required|min:2|max:50|unique:vacation_requests,deleted_at,null',
                'begin_date' => 'required|unique:vacation_requests,deleted_at,null',
                'user_id' => 'required|numeric|exists:users,id',
                'vacation_type_id' => 'required|numeric|exists:vacation_types,id',
            ];
        }

        if (($method == "put") || ($method == "push"))
        {
            $id = $this->vacationRequest->id;

            return [
                'subject' => 'required|min:2|max:50|unique:vacation_requests,deleted_at,null'. $id,
                'begin_date' => 'required|unique:vacation_requests,deleted_at,null'. $id,
                'user_id' => 'required|numeric|exists:users,id',
                'vacation_type_id' => 'required|numeric|exists:vacation_types,id',
            ];
        }

        return [];
    }
}
