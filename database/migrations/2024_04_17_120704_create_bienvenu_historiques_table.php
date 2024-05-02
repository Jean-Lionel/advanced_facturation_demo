<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBienvenuHistoriquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('bienvenu_historiques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compte_id')->constrained();
            $table->foreignId('client_id')->nullable()->constrained();
            $table->string('mode_payement', 400);
            $table->string('title', 400);
            $table->double('montant');
            $table->text('description')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('bienvenu_historiques');
    }
}
