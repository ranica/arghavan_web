<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterationRequest extends FormRequest
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
        $request = request();
        $people  = (object)$request->people;
        $user    = (object)$request->user;
        $student = (object)$request->student;
        $teacher = (object)$request->teacher;
        $staff   = (object)$request->staff;
        $type    = $this->method();


        // print_r($person);
        // die;

        // $peopleId = $people->id;
        // if (isset($request->people->id))
        // {
        //     $peopleId = $request->people->id;
        // }
        // else
        // {
        //     $peopleId = 0;
        // }

        switch ($type) {
            case 'POST':
                return [
                    'user.id'           => 'required',
                    'user.code'         => 'required|max:50|min:3|unique:users,code,'. $user->id,
                    'user.password'     => 'required|max:50|min:3|unique:users,password,'. $user->id,
                    'user.group_id'     => 'required|numeric|exists:groups,id',

                    'student.id'        => 'required',
                    'staff.id'          => 'required',
                    'teacher.id'        => 'required',
                    // 'student.term'      => 'required|max:2|min:1|unique:students,term,'. $student->id,
                    // 'student.year'      => 'required|max:2|min:2|unique:students,year,'. $student->id,

                    'people.id'         => 'required',
                    // 'people.name'       => 'required|max:50|min:2|unique:people,name,'. $people->id,
                    'people.nationalId' => 'required|max:10|min:5|unique:people,nationalId,'. $people->id,
                    // 'people.lastname'   => 'required|max:100|min:2|unique:people,lastname,'. $people->id,
                ];
                break;

            case 'PUT':
            case 'PATCH':
                return [
                    'user.id'           => 'required',
                    'user.code'         => 'required|max:50|min:3|unique:users,code,'. $user->id,
                    // 'user.password'     => 'required|max:50|min:3|unique:users,password,'. $user->id,
                    'user.group_id'     => 'required|numeric|exists:groups,id',

                    'student.id'        => 'required',
                    'staff.id'          => 'required',
                    'teacher.id'        => 'required',
                    // 'student.term'      => 'required|max:2|min:1|unique:students,term,'. $student->id,
                    // 'student.year'      => 'required|max:2|min:2|unique:students,year,'. $student->id,

                    'people.id'         => 'required',
                    // 'people.name'       => 'required|max:50|min:2|unique:people,name,'. $people->id,
                    'people.nationalId' => 'required|max:10|min:5|unique:people,nationalId,'. $people->id,
                    // 'people.lastname'   => 'required|max:100|min:2|unique:people,lastname,'. $people->id,
                ];
                break;
        }
    }
}
