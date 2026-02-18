<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentaireToOrdersAndProformatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->text('commentaire')->nullable()->after('addresse_client');
        });

        Schema::table('proformats', function (Blueprint $table) {
            $table->text('commentaire')->nullable()->after('addresse_client');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('commentaire');
        });

        Schema::table('proformats', function (Blueprint $table) {
            $table->dropColumn('commentaire');
        });
    }
}
