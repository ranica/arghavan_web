<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use App\Http\Requests\RoomRequest;

class RoomController extends Controller
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
            $rooms = Room::with(['building', 'gender', 'materials'])
                         ->paginate(Controller::C_PAGINATE_SIZE);

            return $rooms;
        }

         return view('rooms.index');
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
    public function store(RoomRequest $request)
    {
        if ($request->ajax())
        {
            // Check for duplicate
            $newRoom = Room::createIfNotExists($request);
            $newRoom->load('building')->get();
            $newRoom->load('gender')->get();

            return [
                'status'   => is_null($newRoom) ? 1 : 0,
                'room'     => $newRoom
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
    //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(RoomRequest $request, Room $room)
    {
        if ($request->ajax())
        {
            $room->update([
                'capacity'  => $request->capacity,
                'number' => $request->number,
                'floor'  => $request->floor,
                'building_id'  => $request->building_id,
                'gender_id'  => $request->gender_id,
            ]);

            $room->load('building')->get();
            $room->load('gender')->get();

            return [
                'status'    => 0,
                'room' => $room
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Room $room)
    {
        if ($request->ajax())
        {
            $room->delete();

            return [
                'status' => 0
            ];
        }
    }

    /**
     * Set Room Material to User
     */
    public function setMaterial(Request $request, Room $room)
    {
        if ($request->ajax())       ///TODO: Remove true criteria ! just for test
        {
            $materials = $request->materials;
            $room->giveMaterialsTo($materials);

            // $user = static::loadPersonsData($user->id);

            return [
                'status'   => is_null($room) ? 1 : 0,
                'room'     => $room
            ];
        }
    }
}
