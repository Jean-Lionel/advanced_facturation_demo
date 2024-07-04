<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrmSalaryPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_salary_payment', function (Blueprint $table) {
            $table->id('salary_payment_id');
            $table->integer('employee_id');
            $table->integer('statut')->default(0);
            $table->string('month_year');
            $table->float('works_hours')->default(0);
            $table->decimal('basic_salary', 10, 3)->default(0);
            $table->decimal('gross_salary', 10, 3)->default(0);
            $table->decimal('net_salary', 10, 3)->default(0);
            $table->decimal('inss', 10, 3)->default(0);
            $table->decimal('ire', 10, 3)->default(0);
            $table->decimal('pension_complementaire', 10, 3)->default(0);
            $table->decimal('pension_salariale', 10, 3)->default(0);
            $table->decimal('pension_patronale', 10, 3)->default(0);
            $table->decimal('risque_prof', 10, 3)->default(0);
            $table->decimal('tax_base', 10, 3)->default(0);
            $table->decimal('allowance', 10, 3)->default(0);
            $table->decimal('family_allowances', 10, 3)->default(0);
            $table->decimal('deduction', 10, 3)->default(0);
            $table->decimal('advance', 10, 3)->default(0);
            $table->date('payment_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('payed_by')->nullable();
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
        Schema::dropIfExists('hrm_salary_payment');
    }
}
