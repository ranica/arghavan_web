<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class GatedeviceRequest extends FormRequest
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
                'name' => 'required|min:2|max:50|unique:gatedevices,deleted_at,null',
                'gategender_id' => 'required|numeric|exists:gategenders,id',
                'gatedirect_id' => 'required|numeric|exists:gatedirects,id',
                'zone_id'       => 'required|numeric|exists:zones,id'
            ];
        }

        if (($method == "put") || ($method == "push"))
        {
            $id = $this->gatedevice->id;

            return [
                'name' => 'required|min:2|max:50|unique:gatedevices,deleted_at,null,name,' . $id,
                'gategender_id' => 'required|numeric|exists:gategenders,id',
                'gatedirect_id' => 'required|numeric|exists:gatedirects,id',
                'zone_id'       => 'required|numeric|exists:zones,id'
            ];
        }

        return [];


       /* if ( ! is_null($this->gatedevice))
        {
            $modifyCriteria = ',name,' . $this->gatedevice->id;
            // $stateCriteria  = ',state,' . $this->gatedevice->id;
        }
        else
        {
            $modifyCriteria = '';
            // $stateCriteria  = '';
        }

        return [
            'name'  => 'required|min:2|max:50|unique:gatedevices' . $modifyCriteria,
            // 'state' => 'required:gatedevices' . $stateCriteria,
            'gategender_id' => 'required|numeric|exists:gategenders,id',
            'gatedirect_id' => 'required|numeric|exists:gatedirects,id',
            'zone_id'       => 'required|numeric|exists:zones,id'
            
        ];*/
    }
}
