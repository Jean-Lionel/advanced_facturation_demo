<?php

namespace App\Http\Controllers;

use App\Models\RoomFile;
use Illuminate\Http\Request;

class CheckinList extends Controller
{
    //

    public function index()
    {
        $ckeckins = RoomFile::orderBy('id', 'desc')->with('clients')->with('rooms')->with('user')->paginate(5);
        return view("checkin-list.index",['checkins'=>$ckeckins]);
    }
}
