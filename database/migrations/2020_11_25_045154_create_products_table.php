<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code_product')->nullable();
            $table->string('name');
            $table->string('marque')->nullable();
            $table->string('unite_mesure')->nullable();
            $table->double('quantite',62,2)->default(0);
            $table->double('quantite_alert',62,2)->default(0);
            $table->double('price',62,2)->default(0);
            $table->double('price_ttc',62,2)->default(0);
            $table->double('price_max',62,2)->default(0);
            $table->double('price_tvac',62,2)->default(0);
            $table->double('taux_tva',62,2)->default(0);
            $table->double('item_ott_tax',62,2)->default(0);
            $table->double('item_tsce_tax',62,2)->default(0);
            $table->double('price_min',62,2)->default(0);
            $table->date('date_expiration')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
