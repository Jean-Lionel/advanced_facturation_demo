<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Client;
use App\Models\Compte;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CompteController
 */
class CompteControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $comptes = Compte::factory()->count(3)->create();

        $response = $this->get(route('compte.index'));

        $response->assertOk();
        $response->assertViewIs('compte.index');
        $response->assertViewHas('comptes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('compte.create'));

        $response->assertOk();
        $response->assertViewIs('compte.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CompteController::class,
            'store',
            \App\Http\Requests\CompteStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $montant = $this->faker->randomFloat(/** double_attributes **/);
        $is_active = $this->faker->boolean;
        $client = Client::factory()->create();

        $response = $this->post(route('compte.store'), [
            'name' => $name,
            'montant' => $montant,
            'is_active' => $is_active,
            'client_id' => $client->id,
        ]);

        $comptes = Compte::query()
            ->where('name', $name)
            ->where('montant', $montant)
            ->where('is_active', $is_active)
            ->where('client_id', $client->id)
            ->get();
        $this->assertCount(1, $comptes);
        $compte = $comptes->first();

        $response->assertRedirect(route('compte.index'));
        $response->assertSessionHas('compte.id', $compte->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $compte = Compte::factory()->create();

        $response = $this->get(route('compte.show', $compte));

        $response->assertOk();
        $response->assertViewIs('compte.show');
        $response->assertViewHas('compte');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $compte = Compte::factory()->create();

        $response = $this->get(route('compte.edit', $compte));

        $response->assertOk();
        $response->assertViewIs('compte.edit');
        $response->assertViewHas('compte');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CompteController::class,
            'update',
            \App\Http\Requests\CompteUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $compte = Compte::factory()->create();
        $name = $this->faker->name;
        $montant = $this->faker->randomFloat(/** double_attributes **/);
        $is_active = $this->faker->boolean;
        $client = Client::factory()->create();

        $response = $this->put(route('compte.update', $compte), [
            'name' => $name,
            'montant' => $montant,
            'is_active' => $is_active,
            'client_id' => $client->id,
        ]);

        $compte->refresh();

        $response->assertRedirect(route('compte.index'));
        $response->assertSessionHas('compte.id', $compte->id);

        $this->assertEquals($name, $compte->name);
        $this->assertEquals($montant, $compte->montant);
        $this->assertEquals($is_active, $compte->is_active);
        $this->assertEquals($client->id, $compte->client_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $compte = Compte::factory()->create();

        $response = $this->delete(route('compte.destroy', $compte));

        $response->assertRedirect(route('compte.index'));

        $this->assertDeleted($compte);
    }
}
