<?php

namespace App\Http\Controllers;

use App\Block;
use Illuminate\Http\Request;
use App\Http\Requests\BlockRequest;

class BlockController extends Controller
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
            $blocks = \App\Block::paginate(Controller::C_PAGINATE_SIZE);
            return $blocks;
        }

        return view ('blocks.index');
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
    public function store(BlockRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newBlock = \App\Block::createIfNotExist($request);

            return [
                'status' => is_null($newBlock) ? 1 : 0,
                'block' => $newBlock
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function show(Block $block)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Block $block)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function update(BlockRequest $request, Block $block)
    {
        if ($request->ajax())
        {
            $block->update([
                                'name' => $request->name,
                                'code' => $request->code,
                            ]);

            return [
                'status' => 0,
                'block' => $block
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Block $block)
    {
        if ($request->ajax())
        {
            $block->delete();

            return [
                'status' => 0
            ];
        }
    }
}
