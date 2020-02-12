<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
        $request = request();
        $car  = (object)$request->car;
        $user = (object)$request->user;
        $card = (object)$request->card;

        // $type    = $this->method();

        if ($method == "post")
        {
            return [
                'car.plate_first' => 'required|min:2|max:2|unique:cars,deleted_at,null',
                'car.plate_second' => 'required|min:3|max:3|unique:cars,deleted_at,null',
                'car.plate_word' => 'required|min:1|max:3|unique:cars,deleted_at,null',

                'user.id' => 'required',

                'card.cdn' => 'required|min:4|max:50|unique:cards,deleted_at,null',

            ];
        }

        if (($method == "put") || ($method == "push"))
        {
            // $id = $this->car->id;

            return [
                'car.plate_first' => 'required|min:2|max:2|unique:cars,deleted_at,null'.$car->id,
                'car.plate_second' => 'required|min:3|max:3|unique:cars,deleted_at,null'.$car->id,
                'car.plate_word' => 'required|min:1|max:3|unique:cars,deleted_at,null'.$car->id,

                'user.id' => 'required',

                'card.cdn' => 'required|min:4|max:50|unique:cards,deleted_at,null',$card->id,
            ];
        }

        return [];
    }
}
