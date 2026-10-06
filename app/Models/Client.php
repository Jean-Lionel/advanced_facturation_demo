<?php

namespace App\Models;

use App\Models\Traits\SearchOnModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class Client extends MyModel
{
	use HasFactory, SearchOnModel ,SoftDeletes;

	protected $guarded = [];

    public static $FOURNISSEUR = 'on';

    public function compte(){
        return $this->hasOne(Compte::class);
    }
    public function commissionaire(){
        return $this->belongsTo(Client::class, 'commissionnaire_id');
    }
    public function assurances()
    {
        $this->addTableIfNotExists();
        return $this->belongsToMany(Assurance::class, 'assurance_clients', 'client_id', 'assurance_id');
    }
    public function assuranceClients(){
         $this->addTableIfNotExists();
        return $this->hasMany(AssuranceClient::class);
    }

    // create table assurance_clients et Assurance if it doesn't exist
   public function addTableIfNotExists(){

    if (!Schema::hasTable('assurances')) {
        Schema::create('assurances', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('addresse')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | 2. Table : assurance_clients
    |--------------------------------------------------------------------------
    */
    if (!Schema::hasTable('assurance_clients')) {
        Schema::create('assurance_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('assurance_id')->constrained('assurances')->cascadeOnDelete();
            $table->date('expire_date');
            $table->double('par_client', 64, 4);
            $table->double('par_assurance', 64, 4);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

   }

}
