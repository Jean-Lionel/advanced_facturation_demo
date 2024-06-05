<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($search) {
            $rooms = Room::where('room_delete_status', 0)->where('room_name', 'like', '%' . $search . '%')->orderBy("id", "desc")->get();
        } else {
            $rooms = Room::where('room_delete_status', 0)->orderBy("id", "desc")->get();
        }
        return view("rooms.index", ['rooms' => $rooms,'search'=>$search]);
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

    public function getOneChamber()
    {
        $id = $_POST['id'];
        return response()->json(['room' => Room::find($id)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $room_name = $_POST['data'][0]['value'];
        $room_price = $_POST['data'][1]['value'];
        $room_tva = $_POST['data'][2]['value'];
        $room_tc = $_POST['data'][3]['value'];
        $room_capacity = $_POST['data'][4]['value'];
        DB::table("rooms")->insert([
            'room_name' => $room_name,
            'room_tva' => $room_tva,
            'room_tc' => $room_tc,
            'room_price' => $room_price,
            'room_capacity' => $room_capacity,
        ]);
        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $room = $request->get('room');
        Room::find($room['roomid'])->update([
            'room_name' => $room['roomName'],
            'room_tva' => $room['roomTva'],
            'room_tc' => $room['roomTc'],
            'room_price' => $room['roomPrice'],
            'room_capacity' => $room['roomCapacity'],
        ]);
        return response()->json(['update' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Room::find($id)->update(['room_delete_status' => 1]);
        return response()->json(['deleted' => true]);
    }
}
