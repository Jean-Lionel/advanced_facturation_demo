<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('product_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250)->nullable();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('stock_id')->constrained('stockes');
            $table->double('quantity');
            $table->double('prix_revient')->default('0');
            $table->double('prix_vente')->default('0');
            $table->foreignId('user_id')->constrained();
            $table->unique(['product_id', 'stock_id']);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_stocks');
    }
}
