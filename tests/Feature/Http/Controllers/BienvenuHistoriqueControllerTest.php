<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\BienvenuHistorique;
use App\Models\Compte;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BienvenuHistoriqueController
 */
class BienvenuHistoriqueControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $bienvenuHistoriques = BienvenuHistorique::factory()->count(3)->create();

        $response = $this->get(route('bienvenu-historique.index'));

        $response->assertOk();
        $response->assertViewIs('bienvenuHistorique.index');
        $response->assertViewHas('bienvenuHistoriques');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('bienvenu-historique.create'));

        $response->assertOk();
        $response->assertViewIs('bienvenuHistorique.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BienvenuHistoriqueController::class,
            'store',
            \App\Http\Requests\BienvenuHistoriqueStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $compte = Compte::factory()->create();
        $mode_payement = $this->faker->word;
        $title = $this->faker->sentence(4);
        $montant = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->post(route('bienvenu-historique.store'), [
            'compte_id' => $compte->id,
            'mode_payement' => $mode_payement,
            'title' => $title,
            'montant' => $montant,
        ]);

        $bienvenuHistoriques = BienvenuHistorique::query()
            ->where('compte_id', $compte->id)
            ->where('mode_payement', $mode_payement)
            ->where('title', $title)
            ->where('montant', $montant)
            ->get();
        $this->assertCount(1, $bienvenuHistoriques);
        $bienvenuHistorique = $bienvenuHistoriques->first();

        $response->assertRedirect(route('bienvenuHistorique.index'));
        $response->assertSessionHas('bienvenuHistorique.id', $bienvenuHistorique->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $bienvenuHistorique = BienvenuHistorique::factory()->create();

        $response = $this->get(route('bienvenu-historique.show', $bienvenuHistorique));

        $response->assertOk();
        $response->assertViewIs('bienvenuHistorique.show');
        $response->assertViewHas('bienvenuHistorique');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $bienvenuHistorique = BienvenuHistorique::factory()->create();

        $response = $this->get(route('bienvenu-historique.edit', $bienvenuHistorique));

        $response->assertOk();
        $response->assertViewIs('bienvenuHistorique.edit');
        $response->assertViewHas('bienvenuHistorique');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BienvenuHistoriqueController::class,
            'update',
            \App\Http\Requests\BienvenuHistoriqueUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $bienvenuHistorique = BienvenuHistorique::factory()->create();
        $compte = Compte::factory()->create();
        $mode_payement = $this->faker->word;
        $title = $this->faker->sentence(4);
        $montant = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->put(route('bienvenu-historique.update', $bienvenuHistorique), [
            'compte_id' => $compte->id,
            'mode_payement' => $mode_payement,
            'title' => $title,
            'montant' => $montant,
        ]);

        $bienvenuHistorique->refresh();

        $response->assertRedirect(route('bienvenuHistorique.index'));
        $response->assertSessionHas('bienvenuHistorique.id', $bienvenuHistorique->id);

        $this->assertEquals($compte->id, $bienvenuHistorique->compte_id);
        $this->assertEquals($mode_payement, $bienvenuHistorique->mode_payement);
        $this->assertEquals($title, $bienvenuHistorique->title);
        $this->assertEquals($montant, $bienvenuHistorique->montant);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $bienvenuHistorique = BienvenuHistorique::factory()->create();

        $response = $this->delete(route('bienvenu-historique.destroy', $bienvenuHistorique));

        $response->assertRedirect(route('bienvenuHistorique.index'));

        $this->assertDeleted($bienvenuHistorique);
    }
}
