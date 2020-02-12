<?php

namespace App\Http\Controllers;

use App\Province;
use Illuminate\Http\Request;
use App\Http\Requests\ProvinceRequest;


class ProvinceController extends Controller
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
			$provinces = Province::paginate(Controller::C_PAGINATE_SIZE);

			return $provinces;
		}

		return view ('provinces.index');
	}

	/**
	 * Load all Data Province
	 */

	public function allProvince(Request $request)
	{
		if ($request->ajax())
		{
			$provinces = Province::all();

			return $provinces;
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ProvinceRequest $request)
	{
		if ($request->ajax())
		{
			// Check for duplicate
			$newProvince = Province::createIfNotExists($request);

			return [
				'status'   => is_null($newProvince) ? 1 : 0,
				'province' => $newProvince
			];
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Province  $province
	 * @return \Illuminate\Http\Response
	 */
	public function show(Province $province)
	{
        // if ($request->ajax())
        // {
        //     $allProvinces = Province::where ("province_id", '=', $province->id)
        //                     ->get();

        //     $data = [
        //         'status' => 0,
        //         'data' => $allProvinces
        //     ];

        //     return $data;
        // }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Province  $province
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Province $province)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Province  $province
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProvinceRequest $request, Province $province)
	{
		if ($request->ajax())
		{
			$province->update([
					'name' => $request->name
				]);

			return [
				'status'   => 0,
				'province' => $province
			];
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Province  $province
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Province $province, Request $request)
	{
		if ($request->ajax())
		{
			$province->delete();

			return [
				'status' => 0
			];
		}
	}
}
