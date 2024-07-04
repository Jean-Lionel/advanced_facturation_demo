<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrmPaidLeaveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_paid_leave', function (Blueprint $table) {
            $table->id("paid_leave_id");
            $table->integer("employee_id");
            $table->integer("leave_category_id");
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->dateTime('request_date')->nullable();
            $table->float('period')->nullable();
            $table->integer('leave_status')->nullable();
            $table->integer('confirmation_or_reject_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('confirmed_by')->nullable();
            $table->integer('rejected_by')->nullable();
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
        Schema::dropIfExists('hrm_paid_leave');
    }
}
