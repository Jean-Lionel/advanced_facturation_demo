<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Commande;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CommandeController
 */
class CommandeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $commandes = Commande::factory()->count(3)->create();

        $response = $this->get(route('commande.index'));

        $response->assertOk();
        $response->assertViewIs('commande.index');
        $response->assertViewHas('commandes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('commande.create'));

        $response->assertOk();
        $response->assertViewIs('commande.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CommandeController::class,
            'store',
            \App\Http\Requests\CommandeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();

        $response = $this->post(route('commande.store'), [
            'user_id' => $user->id,
        ]);

        $commandes = Commande::query()
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $commandes);
        $commande = $commandes->first();

        $response->assertRedirect(route('commande.index'));
        $response->assertSessionHas('commande.id', $commande->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $commande = Commande::factory()->create();

        $response = $this->get(route('commande.show', $commande));

        $response->assertOk();
        $response->assertViewIs('commande.show');
        $response->assertViewHas('commande');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $commande = Commande::factory()->create();

        $response = $this->get(route('commande.edit', $commande));

        $response->assertOk();
        $response->assertViewIs('commande.edit');
        $response->assertViewHas('commande');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CommandeController::class,
            'update',
            \App\Http\Requests\CommandeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $commande = Commande::factory()->create();
        $user = User::factory()->create();

        $response = $this->put(route('commande.update', $commande), [
            'user_id' => $user->id,
        ]);

        $commande->refresh();

        $response->assertRedirect(route('commande.index'));
        $response->assertSessionHas('commande.id', $commande->id);

        $this->assertEquals($user->id, $commande->user_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $commande = Commande::factory()->create();

        $response = $this->delete(route('commande.destroy', $commande));

        $response->assertRedirect(route('commande.index'));

        $this->assertDeleted($commande);
    }
}
