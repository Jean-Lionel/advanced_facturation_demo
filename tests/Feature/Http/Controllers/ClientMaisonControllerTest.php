<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Client;
use App\Models\ClientMaison;
use App\Models\Maisonlocation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ClientMaisonController
 */
class ClientMaisonControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $clientMaisons = ClientMaison::factory()->count(3)->create();

        $response = $this->get(route('client-maison.index'));

        $response->assertOk();
        $response->assertViewIs('clientMaison.index');
        $response->assertViewHas('clientMaisons');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('client-maison.create'));

        $response->assertOk();
        $response->assertViewIs('clientMaison.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ClientMaisonController::class,
            'store',
            \App\Http\Requests\ClientMaisonStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();
        $client = Client::factory()->create();
        $maisonlocation = Maisonlocation::factory()->create();
        $montant = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->post(route('client-maison.store'), [
            'user_id' => $user->id,
            'client_id' => $client->id,
            'maisonlocation_id' => $maisonlocation->id,
            'montant' => $montant,
        ]);

        $clientMaisons = ClientMaison::query()
            ->where('user_id', $user->id)
            ->where('client_id', $client->id)
            ->where('maisonlocation_id', $maisonlocation->id)
            ->where('montant', $montant)
            ->get();
        $this->assertCount(1, $clientMaisons);
        $clientMaison = $clientMaisons->first();

        $response->assertRedirect(route('clientMaison.index'));
        $response->assertSessionHas('clientMaison.id', $clientMaison->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $clientMaison = ClientMaison::factory()->create();

        $response = $this->get(route('client-maison.show', $clientMaison));

        $response->assertOk();
        $response->assertViewIs('clientMaison.show');
        $response->assertViewHas('clientMaison');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $clientMaison = ClientMaison::factory()->create();

        $response = $this->get(route('client-maison.edit', $clientMaison));

        $response->assertOk();
        $response->assertViewIs('clientMaison.edit');
        $response->assertViewHas('clientMaison');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ClientMaisonController::class,
            'update',
            \App\Http\Requests\ClientMaisonUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $clientMaison = ClientMaison::factory()->create();
        $user = User::factory()->create();
        $client = Client::factory()->create();
        $maisonlocation = Maisonlocation::factory()->create();
        $montant = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->put(route('client-maison.update', $clientMaison), [
            'user_id' => $user->id,
            'client_id' => $client->id,
            'maisonlocation_id' => $maisonlocation->id,
            'montant' => $montant,
        ]);

        $clientMaison->refresh();

        $response->assertRedirect(route('clientMaison.index'));
        $response->assertSessionHas('clientMaison.id', $clientMaison->id);

        $this->assertEquals($user->id, $clientMaison->user_id);
        $this->assertEquals($client->id, $clientMaison->client_id);
        $this->assertEquals($maisonlocation->id, $clientMaison->maisonlocation_id);
        $this->assertEquals($montant, $clientMaison->montant);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $clientMaison = ClientMaison::factory()->create();

        $response = $this->delete(route('client-maison.destroy', $clientMaison));

        $response->assertRedirect(route('clientMaison.index'));

        $this->assertSoftDeleted($clientMaison);
    }
}
