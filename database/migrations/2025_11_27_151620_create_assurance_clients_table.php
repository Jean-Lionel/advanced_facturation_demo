<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssuranceClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assurance_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id');
            $table->foreignId('assurance_id');
            $table->date('expire_date');
            $table->double('par_client', 64,4);
            $table->double('par_assurance', 64,4);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('assurance_clients');
    }
}
