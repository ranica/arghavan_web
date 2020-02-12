<?php

namespace App\Http\Controllers;

use App\Field;
use App\University;
use App\Http\Requests\FieldRequest;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $fieldDatas = Field::with('university')
                             ->paginate(Controller::C_PAGINATE_SIZE);

            return $fieldDatas;
        }

        return view('fields.index');
    }

    /**
     * Load fields by university
     *
     * @return \Illuminate\Http\Response
     */
    public function getFields(Request $request, $universityId)
    {
        if ($request->ajax())
        {
            // Filter by universityId
            $fields = Field::with('university')
                             ->paginate(Controller::C_PAGINATE_SIZE);

            return $fields;
        }

        return null;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FieldRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newField = Field::createIfNotExists($request);

            $newField->load('university')->get();

            return [
                'status' => is_null($newField) ? 1 : 0,
                'field'  => $newField
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, University $field)
    {
        if ($request->ajax())
        {
            $allFields = Field::where("university_id", '=', $field->id)
                ->get();

                $data = [
                    'status' => 0,
                    'data' => $allFields
                ];

            return $data;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function edit(Field $field)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function update(FieldRequest $request, Field $field)
    {
        if ($request->ajax())
        {
            $field->update([
                'name'          => $request->name,
                'university_id' => $request->university_id
            ]);

            $field->load('university')->get();

            return [
                'status' => 0,
                'field'  => $field
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function destroy(Field $field, Request $request)
    {
        if ($request->ajax())
        {
            $field->delete();

            return [
                'status' => 0
            ];
        }
    }
}
