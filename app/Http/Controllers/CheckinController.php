<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\DetailOrder;
use App\Models\Room;
use App\Models\RoomDetail;
use App\Models\RoomFile;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = 0)
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $rooms = Room::where('room_state', 0)->where('room_delete_status', 0)->get();
        $customers = Client::all();
        return view("checkin.index", ['rooms' => $rooms, 'clients' => $customers, 'id' => $id]);
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
    public function store(Request $request)
    {
        $checkin = $_POST['checkin'];
        $client = Client::where('id', $checkin[0]['value'])->first();
        $room = Room::where('id', $checkin[1]['value'])->first();
        $entry_date = $checkin[2]['value'];
        $out_date = $checkin[3]['value'];
        $person_ = $checkin[4]['value'];
        $entry = new DateTime($entry_date);
        $out = new DateTime($out_date);
        $interval = $entry->diff($out)->days;
        $file_number = $this->checkinCode();
        $rooms = RoomFile::insert([
            'file_number' => $file_number,
            'room_tva' => $room->room_tva,
            'client_id' => $client->id,
            'room_id_ref' => $room->id,
            'room_date_checkin' => $entry,
            'room_date_checkout' => $out_date,
            'room_file_creator' => Auth::user()->id
        ]);
        Room::find($room->id)->update(['room_state' => 1]);
        RoomDetail::insert([
            "room_file_ref" => $file_number,
            "amount" => $room->room_price * $interval,
            "tax" => $room->room_tc,
            "total_quantity" => $interval,
            "amount_tax" => ((($room->room_price * $interval) * $room->room_tva) / 100),
        ]);
        return response()->json(['success'=>true]);
    }

    public function checkinCode($length = 5)
    {
        $filesCount = RoomFile::where('room_file_delete_status', 0)->count() ?? 0;
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return "CHK-" . ($filesCount + 1) . "-" . $randomString;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
