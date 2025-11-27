<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInsuranceFieldsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->double('par_client')->nullable()->default(0);
            $table->double('par_assurance')->nullable()->default(0);
            $table->double('par_client_pourcentage')->nullable()->default(0);
            $table->double('par_assurance_pourcentage')->nullable()->default(0);
            $table->integer('assurance_id')->nullable()->default(0);
            $table->string('assurance_name')->nullable();
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
            $table->dropColumn(['par_client', 'par_assurance', 'par_client_pourcentage', 'par_assurance_pourcentage', 'assurance_id', 'assurance_name']);
        });
    }
}
