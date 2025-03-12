<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ObrCofiguration extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function saveConfiguration(){
        if (!Schema::hasTable('obr_cofigurations')) {
            Schema::create('obr_cofigurations', function (Blueprint $table) {
                $table->id();
                $table->string('config_type')->nullable();
                $table->json('description')->nullable();
                $table->timestamps();
            });
        }
        self::create([
            'config_type' => 'OBR_CONFIG',
            'description' => json_encode([
                'obr_username' => env('OBR_USERNAME'),
                'obr_password' => env('OBR_PASSWORD'),
                'obr_production' => env('OBR_PRODUCTION'),
                'obr_model_facture' => env('OBR_MODEL_FACTURE'),
                'entreprise' => (Entreprise::currentEntreprise())->toArray(),
            ]),

        ]);
    }
}
