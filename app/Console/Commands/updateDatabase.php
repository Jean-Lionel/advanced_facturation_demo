<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:update';

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
        if (!Schema::hasColumn('obr_mouvement_stocks', 'reference_dmc')) {
            DB::statement("ALTER TABLE obr_mouvement_stocks ADD COLUMN reference_dmc VARCHAR(255) NULL;");
        }

        if (!Schema::hasColumn('obr_mouvement_stocks', 'rubrique_tarifaire')) {
            DB::statement("ALTER TABLE obr_mouvement_stocks ADD COLUMN rubrique_tarifaire VARCHAR(255) NULL;");
        }

        if (!Schema::hasColumn('obr_mouvement_stocks', 'numero_paquet')) {
            DB::statement("ALTER TABLE obr_mouvement_stocks ADD COLUMN numero_paquet VARCHAR(255) NULL;");
        }

        if (!Schema::hasColumn('obr_mouvement_stocks', 'description_paquet')) {
            DB::statement("ALTER TABLE obr_mouvement_stocks ADD COLUMN description_paquet VARCHAR(255) NULL;");
        }
        if (!Schema::hasColumn('obr_mouvement_stocks', 'nombre_par_paquet')) {
            DB::statement("ALTER TABLE obr_mouvement_stocks ADD COLUMN nombre_par_paquet VARCHAR(255) NULL;");
        }

        if (!Schema::hasColumn('obr_mouvement_stocks', 'is_importation')) {
            DB::statement("ALTER TABLE obr_mouvement_stocks ADD COLUMN is_importation VARCHAR(255) NULL;");
        }

        return 0;
    }
}
