<?php

namespace App\Http\Controllers;

use App\ContactType;
use Illuminate\Http\Request;
use App\Http\Requests\ContactTypeRequest;


class ContactTypeController extends Controller
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
            $contactType = ContactType::paginate($this->C_PAGE_SIZE);

            return $contactType;
        }

        return view('contact_types.index');
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
    public function store(ContactTypeRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $contactType = ContactType::createIfNotExists($request);

            return [
                'status' => is_null($contactType) ? 1 : 0,
                'contactType' => $contactType
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactType  $contactType
     * @return \Illuminate\Http\Response
     */
    public function show(ContactType $contactType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactType  $contactType
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactType $contactType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactType  $contactType
     * @return \Illuminate\Http\Response
     */
    public function update(ContactTypeRequest $request, ContactType $contactType)
    {
        if ($request->ajax())
        {
            $contactType->update([ 'type' => $request->type ]);

            return [
                'status' => 0,
                'contactType' => $contactType
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactType  $contactType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ContactType $contactType)
    {
        if ($request->ajax())
        {
            $contactType->delete();

            return [
                'status' => 0
            ];
        }
    }

    /**
     * Load all Data ContactType
     */

    public function allContactType(Request $request)
    {
        if ($request->ajax())
        {
            $contact_types = ContactType::all();

            return $contact_types;
        }
    }
}
