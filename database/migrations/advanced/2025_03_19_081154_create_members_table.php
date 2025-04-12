<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 100)->nullable();
            $table->string('last_name', 100);
            $table->string('email', 100)->unique();
            $table->string('title', 50);
            $table->string('profile_image', 255)->nullable();
            $table->string('phone', 30)->nullable();
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('organisation_id')->nullable()->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
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
        Schema::dropIfExists('members');
    }
}
