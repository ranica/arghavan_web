<?php

namespace App\Http\Controllers;

use App\City;
use App\Province;
use Illuminate\Http\Request;
use App\Http\Requests\CityRequest;

class CityController extends Controller
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
            $cities = City::with('province')
                          ->paginate(Controller::C_PAGINATE_SIZE);

            return $cities;
        }

        return view('cities.index');
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
    public function store(CityRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newCity = City::createIfNotExists($request);

            $newCity->load('province')->get();

            return [
                'status' => is_null($newCity) ? 1 : 0,
                'city'   => $newCity
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,Province $city)
    {
        if ($request->ajax())
        {
            $allCities = City::where ("province_id", '=', $city->id)
                            ->get();

            $data = [
                'status' => 0,
                'data' => $allCities
            ];

            return $data;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, City $city)
    {
        if ($request->ajax())
        {
            $city->update([
                'name'        => $request->name,
                'province_id' => $request->province_id
            ]);

            $city->load('province')->get();

            return [
                'status' => 0,
                'city'   => $city
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, City $city)
    {
        if ($request->ajax())
        {
            $city->delete();

            return [
                'status' => 0
            ];
        }
    }
}
