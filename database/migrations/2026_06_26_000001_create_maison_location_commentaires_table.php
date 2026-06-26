<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaisonLocationCommentairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('maison_location_commentaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('maisonlocation_id')->constrained('maison_locations');
            $table->text('commentaire');
            $table->softDeletes();
            $table->timestamps();
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
        Schema::dropIfExists('maison_location_commentaires');
    }
}