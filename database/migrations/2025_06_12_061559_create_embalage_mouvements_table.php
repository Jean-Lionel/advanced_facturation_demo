<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmbalageMouvementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('embalage_mouvements', function (Blueprint $table) {
            $table->id();
            $table->string('type', 255);
            $table->double('quantity')->default('0');
            $table->foreignId('embalage_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->date('date_retour')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('embalage_mouvements');
    }
}
