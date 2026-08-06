<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entreprise_id');
            $table->string('bank_name');
            $table->string('account_number');
            $table->timestamps();

            $table->foreign('entreprise_id')->references('id')->on('entreprises')->onDelete('cascade');
        });

        foreach (DB::table('entreprises')->get() as $entreprise) {
            if ($entreprise->tp_bank || $entreprise->tp_account_number) {
                DB::table('bank_accounts')->insert([
                    'entreprise_id' => $entreprise->id,
                    'bank_name' => $entreprise->tp_bank ?: 'Banque',
                    'account_number' => $entreprise->tp_account_number ?: '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down()
    {
        Schema::dropIfExists('bank_accounts');
    }
}
