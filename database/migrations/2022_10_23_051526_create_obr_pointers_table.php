<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrPointersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obr_pointers', function (Blueprint $table) {
            $table->id();
            $table->foreignId("order_id");
            $table->string("invoice_signature");
            $table->string("status");
            $table->boolean("success")->nullable();
            $table->text("electronic_signature")->nullable();
            $table->text("msg")->nullable();
            $table->text("result")->nullable();
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
        Schema::dropIfExists('obr_pointers');
    }
}
