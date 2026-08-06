<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveLabelFromBankAccountsTable extends Migration
{
    public function up()
    {
        if (Schema::hasColumn('bank_accounts', 'label')) {
            Schema::table('bank_accounts', function (Blueprint $table) {
                $table->dropColumn('label');
            });
        }
    }

    public function down()
    {
        if (!Schema::hasColumn('bank_accounts', 'label')) {
            Schema::table('bank_accounts', function (Blueprint $table) {
                $table->string('label')->nullable();
            });
        }
    }
}
