<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactureBrouillonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture_brouillons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_number')->nullable();
            $table->string('type_paiement')->nullable();
            $table->unsignedBigInteger('banque_id')->nullable();
            $table->string('invoice_currency')->default('BIF');
            $table->string('type_facture')->default('FACTURE');
            $table->longText('lignes')->nullable();
            $table->double('amount', 62, 2)->default(0);
            $table->double('supplement', 62, 2)->default(0);
            $table->text('assurance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facture_brouillons');
    }
}
