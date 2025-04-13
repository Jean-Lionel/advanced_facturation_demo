<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class AdvancedUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'advanced:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->clean();
        return 0;
    }

    /**
     * Clean the database.
     *
     * @return void
     */
    public function clean()
    {
        $tables = [
            'member_organisation',
            'notifications',
            'transaction_files',
            'transactions',
            'transaction_types',
            'organisation_members',
            'members',
            'organisations',
        ];
        // desactiver les cles entrangeres
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::drop($table);
                echo "✅ Table '$table' supprimée.\n";
            } else {
                echo "⚠️ Table '$table' non trouvée.\n";
            }
        }

        DB::table('migrations')->whereIn('migration', [
            '2025_03_19_081200_create_member_organisation_table',
            '2025_03_19_081159_create_notifications_table',
            '2025_03_19_081158_create_transaction_files_table',
            '2025_03_19_081157_create_transactions_table',
            '2025_03_19_081156_create_transaction_types_table',
            '2025_03_19_081155_create_organisation_members_table',
            '2025_03_19_081154_create_members_table',
            '2025_03_19_081153_create_organisations_table',
        ])->delete();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
