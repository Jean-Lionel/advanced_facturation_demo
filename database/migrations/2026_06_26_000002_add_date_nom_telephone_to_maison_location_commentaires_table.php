<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateNomTelephoneToMaisonLocationCommentairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maison_location_commentaires', function (Blueprint $table) {
            $table->date('date')->nullable()->after('maisonlocation_id');
            $table->string('nom')->nullable()->after('date');
            $table->string('telephone')->nullable()->after('nom');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maison_location_commentaires', function (Blueprint $table) {
            $table->dropColumn(['date', 'nom', 'telephone']);
        });
    }
}