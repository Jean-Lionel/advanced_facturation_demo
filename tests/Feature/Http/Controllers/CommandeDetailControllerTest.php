<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CommandeDetail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CommandeDetailController
 */
class CommandeDetailControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $commandeDetails = CommandeDetail::factory()->count(3)->create();

        $response = $this->get(route('commande-detail.index'));

        $response->assertOk();
        $response->assertViewIs('commandeDetail.index');
        $response->assertViewHas('commandeDetails');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('commande-detail.create'));

        $response->assertOk();
        $response->assertViewIs('commandeDetail.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CommandeDetailController::class,
            'store',
            \App\Http\Requests\CommandeDetailStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();
        $quantite = $this->faker->randomFloat(/** double_attributes **/);
        $quantite_livre = $this->faker->randomFloat(/** double_attributes **/);
        $price_commande = $this->faker->randomFloat(/** double_attributes **/);
        $price_livraison = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->post(route('commande-detail.store'), [
            'user_id' => $user->id,
            'quantite' => $quantite,
            'quantite_livre' => $quantite_livre,
            'price_commande' => $price_commande,
            'price_livraison' => $price_livraison,
        ]);

        $commandeDetails = CommandeDetail::query()
            ->where('user_id', $user->id)
            ->where('quantite', $quantite)
            ->where('quantite_livre', $quantite_livre)
            ->where('price_commande', $price_commande)
            ->where('price_livraison', $price_livraison)
            ->get();
        $this->assertCount(1, $commandeDetails);
        $commandeDetail = $commandeDetails->first();

        $response->assertRedirect(route('commandeDetail.index'));
        $response->assertSessionHas('commandeDetail.id', $commandeDetail->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $commandeDetail = CommandeDetail::factory()->create();

        $response = $this->get(route('commande-detail.show', $commandeDetail));

        $response->assertOk();
        $response->assertViewIs('commandeDetail.show');
        $response->assertViewHas('commandeDetail');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $commandeDetail = CommandeDetail::factory()->create();

        $response = $this->get(route('commande-detail.edit', $commandeDetail));

        $response->assertOk();
        $response->assertViewIs('commandeDetail.edit');
        $response->assertViewHas('commandeDetail');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CommandeDetailController::class,
            'update',
            \App\Http\Requests\CommandeDetailUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $commandeDetail = CommandeDetail::factory()->create();
        $user = User::factory()->create();
        $quantite = $this->faker->randomFloat(/** double_attributes **/);
        $quantite_livre = $this->faker->randomFloat(/** double_attributes **/);
        $price_commande = $this->faker->randomFloat(/** double_attributes **/);
        $price_livraison = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->put(route('commande-detail.update', $commandeDetail), [
            'user_id' => $user->id,
            'quantite' => $quantite,
            'quantite_livre' => $quantite_livre,
            'price_commande' => $price_commande,
            'price_livraison' => $price_livraison,
        ]);

        $commandeDetail->refresh();

        $response->assertRedirect(route('commandeDetail.index'));
        $response->assertSessionHas('commandeDetail.id', $commandeDetail->id);

        $this->assertEquals($user->id, $commandeDetail->user_id);
        $this->assertEquals($quantite, $commandeDetail->quantite);
        $this->assertEquals($quantite_livre, $commandeDetail->quantite_livre);
        $this->assertEquals($price_commande, $commandeDetail->price_commande);
        $this->assertEquals($price_livraison, $commandeDetail->price_livraison);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $commandeDetail = CommandeDetail::factory()->create();

        $response = $this->delete(route('commande-detail.destroy', $commandeDetail));

        $response->assertRedirect(route('commandeDetail.index'));

        $this->assertDeleted($commandeDetail);
    }
}
