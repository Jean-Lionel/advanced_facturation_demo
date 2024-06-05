<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RoomDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_details', function (Blueprint $table) {
            $table->id();
            $table->string('room_file_ref')->nullable();
            $table->double('amount', 60, 2);
            $table->double('tax', 60, 2);
            $table->double('total_quantity', 60, 2);
            $table->double('amount_tax', 60, 2);
            $table->string('type_facture')->nullable();
            $table->text('company')->nullable();
            $table->text('client')->nullable();
            $table->text('canceled_or_connection')->nullable();
            $table->text('addresse_client')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('commissionaire_id')->nullable();
            $table->boolean('is_cancelled')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("room_details");
    }
}
