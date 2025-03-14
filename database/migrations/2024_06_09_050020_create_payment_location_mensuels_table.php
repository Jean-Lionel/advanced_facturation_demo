<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentLocationMensuelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('payment_location_mensuels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('maisonlocation_id')->constrained('maison_locations');
            $table->foreignId('client_maison_id')->nullable();
            $table->text('description')->nullable();
            $table->text('total_payment_mensuel')->nullable();
            $table->foreignId('order_id')->nullable();
            $table->foreignId('periode_paiement_id')->nullable();
            $table->text('type_paiement')->nullable();
            $table->double('montant')->default('0');
            $table->date('date_paiement')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**order_id
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_location_mensuels');
    }
}
