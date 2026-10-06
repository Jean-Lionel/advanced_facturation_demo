<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToBanquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banques', function (Blueprint $table) {
            $table->foreignId('entreprise_id')->nullable()->after('user_id')->constrained()->onDelete('cascade');
            $table->string('account_number')->nullable()->after('name');
            $table->string('swift_code')->nullable()->after('account_number');
            $table->string('iban')->nullable()->after('swift_code');
            $table->boolean('is_default')->default(false)->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banques', function (Blueprint $table) {
            $table->dropForeign(['entreprise_id']);
            $table->dropColumn(['entreprise_id', 'account_number', 'swift_code', 'iban', 'is_default']);
        });
    }
}
