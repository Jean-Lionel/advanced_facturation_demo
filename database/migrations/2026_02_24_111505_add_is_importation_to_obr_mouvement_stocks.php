<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsImportationToObrMouvementStocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('obr_mouvement_stocks', function (Blueprint $table) {
            $table->boolean('is_importation')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('obr_mouvement_stocks', function (Blueprint $table) {
            $table->dropColumn('is_importation');
        });
    }
}
