<?php

namespace App\Http\Controllers;

use App\MaterialType;
use Illuminate\Http\Request;
use App\Http\Requests\MaterialTypeRequest;


class MaterialTypeController extends Controller
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
            $material_types = MaterialType::paginate(Controller::C_PAGINATE_SIZE);

            return $material_types;
        }

        return view('material_types.index');
    }
    /**
     * Load all Data MaterialType
     */

    public function allMaterialType(Request $request)
    {
        if ($request->ajax())
        {
            $material_types = MaterialType::all();

            return $material_types;
        }
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
    public function store(MaterialTypeRequest $request)
    {
        if ($request->ajax())
        {
            $new_material_type = MaterialType::createIfNotExists($request);

            return [
                'status' => is_null($new_material_type) ? 1 : 0,
                'material_type' => $new_material_type
            ];

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MaterialType  $materialType
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialType $materialType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MaterialType  $materialType
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialType $materialType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MaterialType  $materialType
     * @return \Illuminate\Http\Response
     */
    public function update(MaterialTypeRequest $request, MaterialType $materialType)
    {
        if ($request->ajax())
        {
            $materialType->update([
                    'name' => $request->name
                ]);

            return [
                'status'   => 0,
                'material_type'     => $materialType
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaterialType  $materialType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, MaterialType $materialType)
    {
        if ($request->ajax())
        {
            $materialType->delete();

            return [
                'status' => 0
            ];
        }
    }
}
