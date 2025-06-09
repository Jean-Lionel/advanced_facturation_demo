<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use App\Models\Versement;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\VersementController
 */
class VersementControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $versements = Versement::factory()->count(3)->create();

        $response = $this->get(route('versement.index'));

        $response->assertOk();
        $response->assertViewIs('versement.index');
        $response->assertViewHas('versements');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('versement.create'));

        $response->assertOk();
        $response->assertViewIs('versement.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VersementController::class,
            'store',
            \App\Http\Requests\VersementStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();
        $montant = $this->faker->randomFloat(/** double_attributes **/);
        $date_transaction = $this->faker->date();

        $response = $this->post(route('versement.store'), [
            'user_id' => $user->id,
            'montant' => $montant,
            'date_transaction' => $date_transaction,
        ]);

        $versements = Versement::query()
            ->where('user_id', $user->id)
            ->where('montant', $montant)
            ->where('date_transaction', $date_transaction)
            ->get();
        $this->assertCount(1, $versements);
        $versement = $versements->first();

        $response->assertRedirect(route('versement.index'));
        $response->assertSessionHas('versement.id', $versement->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $versement = Versement::factory()->create();

        $response = $this->get(route('versement.show', $versement));

        $response->assertOk();
        $response->assertViewIs('versement.show');
        $response->assertViewHas('versement');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $versement = Versement::factory()->create();

        $response = $this->get(route('versement.edit', $versement));

        $response->assertOk();
        $response->assertViewIs('versement.edit');
        $response->assertViewHas('versement');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VersementController::class,
            'update',
            \App\Http\Requests\VersementUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $versement = Versement::factory()->create();
        $user = User::factory()->create();
        $montant = $this->faker->randomFloat(/** double_attributes **/);
        $date_transaction = $this->faker->date();

        $response = $this->put(route('versement.update', $versement), [
            'user_id' => $user->id,
            'montant' => $montant,
            'date_transaction' => $date_transaction,
        ]);

        $versement->refresh();

        $response->assertRedirect(route('versement.index'));
        $response->assertSessionHas('versement.id', $versement->id);

        $this->assertEquals($user->id, $versement->user_id);
        $this->assertEquals($montant, $versement->montant);
        $this->assertEquals(Carbon::parse($date_transaction), $versement->date_transaction);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $versement = Versement::factory()->create();

        $response = $this->delete(route('versement.destroy', $versement));

        $response->assertRedirect(route('versement.index'));

        $this->assertDeleted($versement);
    }
}
