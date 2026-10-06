<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('stock_controls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->double('old_quantity',64,2)->default('0');
            $table->double('new_quantity',64,2)->default('0');
            $table->double('sold_quantity',64,2)->default('0');
            $table->double('price',64,2)->default('0');
            $table->double('total',64,2)->default('0');
            $table->foreignId('user_id')->constrained();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('stock_controls');
    }
}
