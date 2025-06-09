<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('versements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->text('description')->nullable();
            $table->double('montant');
            $table->foreignId('versement_type_id')->nullable();
            $table->date('date_transaction');
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
        Schema::dropIfExists('versements');
    }
}
