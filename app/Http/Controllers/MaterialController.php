<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;
use App\Http\Requests\MaterialRequest;


class MaterialController extends Controller
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
            $materials = Material::with('materialType')
                             ->paginate(Controller::C_PAGINATE_SIZE);

            return $materials;
        }

        return view('materials.index');
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
    public function store(MaterialRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $new_material = Material::createIfNotExists($request);

            $new_material->load('materialType')->get();

            return [
                'status' => is_null($new_material) ? 1 : 0,
                'material'  => $new_material
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(MaterialRequest $request, Material $material)
    {
        if ($request->ajax())
        {
            $material->update([
                'name' => $request->name,
                'code' => $request->code,
                'material_type_id' => $request->material_type_id
            ]);

            $material->load('materialType')->get();

            return [
                'status' => 0,
                'material'  => $material
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Material $material)
    {
        if ($request->ajax())
        {
            $material->delete();

            return [
                'status' => 0
            ];
        }
    }
}
