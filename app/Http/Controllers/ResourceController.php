<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;
use App\Http\Requests\ResourceRequest;

class ResourceController extends Controller
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
            $resources = Resource::paginate(Controller::C_PAGINATE_SIZE);

            return $resources;
        }

        return view('resources.index');
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
    public function store(ResourceRequest $request)
    {
         if ($request->ajax())
        { 
            // Check for duplicate
            $newResource = Resource::createIfNotExists($request);          
            
            return [
                'status'        => is_null($newResource) ? 1 : 0,
                'resource'     => $newResource
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(Resource $resource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Resource $resource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(ResourceRequest $request, Resource $resource)
    {
        if ($request->ajax())
        {
            $resource->update([
                'name'  => $request->name,
                'state' => $request->state
            ]);           

            return [
                'status'    => 0,
                'resource' => $resource
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $requets, Resource $resource)
    {
        if ($request->ajax())
        {
            $resource->delete();

            return [
                'status' => 0
            ];
        }
    }
}
