<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFielsToEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entreprises', function (Blueprint $table) {
            //
            $table->string('tp_email')->nullable();
            $table->string('tp_website')->nullable();
            $table->string('tp_logo')->nullable();
            $table->string('tp_bank')->nullable();
            $table->string('tp_account_number')->nullable();
            $table->string('tp_facebook')->nullable();
            $table->string('tp_twitter')->nullable();
            $table->string('tp_instagram')->nullable();
            $table->string('tp_youtube')->nullable();
            $table->string('tp_whatsapp')->nullable();
            $table->string('tp_address')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entreprises', function (Blueprint $table) {
            //
           /*  $table->dropColumn('tp_email');
            $table->dropColumn('tp_website');
            $table->dropColumn('tp_logo');
            $table->dropColumn('tp_bank');
            $table->dropColumn('tp_account_number');
            $table->dropColumn('tp_facebook');
            $table->dropColumn('tp_twitter');
            $table->dropColumn('tp_instagram');
            $table->dropColumn('tp_youtube');
            $table->dropColumn('tp_whatsapp');
            $table->dropColumn('tp_address'); */
        });
    }
}
