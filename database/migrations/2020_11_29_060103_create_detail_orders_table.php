<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->double('quantite' ,62,2);
            $table->double('quantite_stock', 62,2);
            $table->double('price_unitaire',62,2);
            $table->double('embalage',62,2)->nullable();
            $table->string('code_product')->nullable();
            $table->string('name')->nullable();
            $table->string('unite_mesure')->nullable();
            $table->date('date_expiration');

            $table->integer('order_id');
            $table->integer('user_id');
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
        Schema::dropIfExists('detail_orders');
    }
}
