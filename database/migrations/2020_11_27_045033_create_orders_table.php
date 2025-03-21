<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->double('amount',60,2);
            $table->double('tax',60,2);
            $table->double('total_quantity',60,2);
            $table->double('total_sacs',60,2);
            $table->double('amount_tax',60,2);
            $table->string('type_paiement');
            $table->string('type_facture')->nullable();
            //invoice_currency            $table->string('invoice_currency')->nullable();
            $table->string('invoice_currency')->nullable();
            $table->string('invoice_type')->nullable();
            $table->string('invoice_number')->nullable();
            $table->text('products');
            $table->text('company')->nullable();
            $table->text('client')->nullable();
            $table->text('canceled_or_connection')->nullable();
            $table->text('addresse_client')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('commissionaire_id')->nullable();
            $table->unsignedBigInteger('maison_id')->nullable();
            //Creditial for OBR
            $table->boolean('is_cancelled')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
