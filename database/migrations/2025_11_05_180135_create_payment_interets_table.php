<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_interets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->string('title');
            $table->decimal('montant', 15, 2);
            $table->text('remarque')->nullable();
            $table->enum('type_beneficiaire', ['client', 'commissionnaire']);
            $table->dateTime('date_paiement');
            $table->enum('statut', ['payé', 'annulé', 'en_attente'])->default('payé');
            $table->timestamps();

            // Index pour améliorer les performances
            $table->index('client_id');
            $table->index('type_beneficiaire');
            $table->index('statut');
            $table->index('date_paiement');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_interets');
    }
};
