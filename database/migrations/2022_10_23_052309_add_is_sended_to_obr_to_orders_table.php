<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsSendedToObrToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->string('envoye_obr')->nullable();
            $table->string('envoye_par')->nullable();
            $table->string('envoye_time')->nullable();
            $table->string('invoice_signature')->nullable();
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
            //
            $table->dropColumn('envoye_obr');
            $table->dropColumn('envoye_par');
            $table->dropColumn('envoye_time');
            $table->dropColumn('invoice_signature');
        });
    }
}
