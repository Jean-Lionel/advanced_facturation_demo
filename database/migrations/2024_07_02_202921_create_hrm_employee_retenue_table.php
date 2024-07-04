<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrmEmployeeRetenueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_employee_retenue', function (Blueprint $table) {
            $table->id('employee_retenue_id');
            $table->integer("employee_id_in_retenue");
            $table->integer("retenue_id");
            $table->decimal('retenue_amount', 10, 3)->nullable();
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
        Schema::dropIfExists('hrm_employee_retenue');
    }
}
