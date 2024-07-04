<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrmSalaryRetenueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_salary_retenue', function (Blueprint $table) {
            $table->id();
            $table->integer("employee_id");
            $table->integer("retenue_type");
            $table->decimal('amount', 10, 3)->nullable();
            $table->string('retenue_month')->nullable();
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('hrm_salary_retenue');
    }
}
