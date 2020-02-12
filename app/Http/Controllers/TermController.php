<?php

namespace App\Http\Controllers;

use App\Term;
use Illuminate\Http\Request;
use App\Http\Requests\TermRequest;

class TermController extends Controller
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
            $terms = Term::with('semester')
                             ->paginate(Controller::C_PAGINATE_SIZE);

            return $terms;
        }

        return view('terms.index');
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
    public function store(TermRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newTerm = Term::createIfNotExists($request);

            $newTerm->load('semester')->get();

            return [
                'status' => is_null($newTerm) ? 1 : 0,
                'term'  => $newTerm
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function show(Term $term)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function edit(Term $term)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function update(TermRequest $request, Term $term)
    {
        if ($request->ajax())
        {
            $term->update([
                'year'          => $request->year,
                'startDate'     => $request->startDate,
                'endDate'       => $request->endDate,
                'semester_id' => $request->semester_id
            ]);

            $term->load('semester')->get();

            return [
                'status' => 0,
                'term'  => $term
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Term $term)
    {
        if ($request->ajax())
        {
            $term->delete();

            return [
                'status' => 0
            ];
        }
    }

     /**
     * Get all Term
     */
    public function allTerm()
    {
        $list  = Term::with('semester')
                        ->get();
        return $list;
    }
}
