<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrmEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_employee', function (Blueprint $table) {
            $table->id('employee_id');
            $table->string('employment_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('cni_number')->nullable();
            $table->string('full_address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('maratial_status')->nullable();
            $table->string('code_inss')->nullable();
            $table->enum('gender', ['homme', 'femme'])->nullable();
            $table->date('date_of_birth')->default(date('Y-m-d'));
            $table->date('joining_date')->default(date('Y-m-d'));
            $table->date('leaving_date')->default(date('Y-m-d'));
            $table->integer('status')->default(1);
            $table->integer('fonction_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('modified_by')->nullable();
            $table->integer('deleted_by')->nullable();
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
        Schema::dropIfExists('hrm_employee');
    }
}
