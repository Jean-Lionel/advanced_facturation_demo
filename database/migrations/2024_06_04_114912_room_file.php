<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RoomFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_file', function (Blueprint $table) {
            $table->id();
            $table->string('file_number', 400);
            $table->string('room_tva', 30);
            $table->integer('client_id');
            $table->integer('room_id_ref');
            $table->string('room_date_checkin');
            $table->string('room_date_checkout');
            $table->inetger('room_file_creator');
            $table->integer('room_file_status')->default(0);
            $table->integer('room_file_delete_status')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
