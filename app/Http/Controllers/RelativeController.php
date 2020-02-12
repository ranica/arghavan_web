<?php

namespace App\Http\Controllers;

use App\Relative;
use Illuminate\Http\Request;
use App\Http\Requests\RelativeRequest;


class RelativeController extends Controller
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

            $relatives = Relative::with('kintype')
                             ->paginate(Controller::C_PAGINATE_SIZE);

            return $relatives;
        }

        return view('people.parent-index');
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
    public function store(RelativeRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newRelative = Relative::createIfNotExists($request);

            $newRelative->load('kintype')->get();

            return [
                'status' => is_null($newRelative) ? 1 : 0,
                'relative'  => $newRelative
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\relative  $relative
     * @return \Illuminate\Http\Response
     */
    public function show(relative $relative)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\relative  $relative
     * @return \Illuminate\Http\Response
     */
    public function edit(relative $relative)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\relative  $relative
     * @return \Illuminate\Http\Response
     */
    public function update(RelativeRequest $request, relative $relative)
    {
        if ($request->ajax())
        {
            $relative->update([
                'name'   => $request->name,
                'lastname' => $request->lastname,
                'phone' => $request->phone,
                'mobile' => $request->mobile,
                'kintype_id' => $request->kintype_id,
            ]);

            $relative->load('kintype')->get();

            return [
                'status' => 0,
                'relative'  => $relative
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\relative  $relative
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, relative $relative)
    {
        if ($request->ajax())
        {
            $relative->delete();

            return [
                'status' => 0
            ];
        }
    }

    /**
     * Set Group_Permit to User
     */
    public function loadParent(Request $request,People $people)
    {
        if ($request->ajax())       ///TODO: Remove true criteria ! just for test
        {
            $relatives =\App\People::with('parents', 'parents.kintype')->find($people);
            dd($relatives);
            return [
                'status'   => is_null($relatives) ? 1 : 0,
                'relatives'     => $relatives
            ];
        }
    }
}
