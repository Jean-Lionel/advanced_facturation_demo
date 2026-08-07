<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBankDetailsToBanquesAndOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('banques', function (Blueprint $table) {
            if (!Schema::hasColumn('banques', 'account_name')) {
                $table->string('account_name')->nullable()->after('name');
            }

            if (!Schema::hasColumn('banques', 'account_number')) {
                $table->string('account_number')->nullable()->after('account_name');
            }

            if (!Schema::hasColumn('banques', 'account_type')) {
                $table->string('account_type')->nullable()->after('account_number');
            }

            if (!Schema::hasColumn('banques', 'currency')) {
                $table->string('currency', 10)->default('BIF')->after('account_type');
            }

            if (!Schema::hasColumn('banques', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('description');
            }
        });

        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'banque_id')) {
                $table->unsignedBigInteger('banque_id')->nullable()->after('commissionaire_id');
            }

            if (!Schema::hasColumn('orders', 'banque')) {
                $table->text('banque')->nullable()->after('banque_id');
            }
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'banque')) {
                $table->dropColumn('banque');
            }

            if (Schema::hasColumn('orders', 'banque_id')) {
                $table->dropColumn('banque_id');
            }
        });

        Schema::table('banques', function (Blueprint $table) {
            foreach (['is_active', 'currency', 'account_type', 'account_number', 'account_name'] as $column) {
                if (Schema::hasColumn('banques', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
}
