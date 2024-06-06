<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomFile extends Model
{
    use HasFactory;

    protected $table = 'room_file';


    public function clients()
    {
        return $this->belongsTo(Client::class, "client_id", 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, "room_file_creator", 'id');
    }

    public function rooms()
    {
        return $this->belongsTo(Room::class, "room_id_ref", 'id');
    }
}
