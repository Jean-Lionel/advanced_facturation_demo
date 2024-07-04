<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrmEmployeePayrollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_employee_payroll', function (Blueprint $table) {
            $table->id("payroll_id");
            $table->integer('employee_id')->nullable();
            $table->decimal('basic_salary', 10, 3)->default(0);
            $table->decimal('brut_salary', 10, 3)->default(0);
            $table->decimal('net_salary', 10, 3)->default(0);
            $table->integer('work_days_per_month')->nullable();
            $table->integer('work_hours_per_day')->nullable();
            $table->string('transport_allowance')->nullable();
            $table->enum('payment_type', ['cash', 'bank'])->nullable();
            $table->decimal('additional_pension', 10, 3)->nullable();
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
        Schema::dropIfExists('hrm_employee_payroll');
    }
}
