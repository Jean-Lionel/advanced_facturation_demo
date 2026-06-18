<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryAndDateToDepensesTable extends Migration
{
    public function up()
    {
        Schema::table('depenses', function (Blueprint $table) {
            $table->foreignId('depense_category_id')
                ->nullable()
                ->after('description')
                ->constrained('depense_categories')
                ->nullOnDelete();
            $table->date('date_depense')->nullable()->after('depense_category_id');
        });
    }

    public function down()
    {
        Schema::table('depenses', function (Blueprint $table) {
            $table->dropForeign(['depense_category_id']);
            $table->dropColumn(['depense_category_id', 'date_depense']);
        });
    }
}