<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\OrderInteret;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\OrderInteretController
 */
class OrderInteretControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $orderInterets = OrderInteret::factory()->count(3)->create();

        $response = $this->get(route('order-interet.index'));

        $response->assertOk();
        $response->assertViewIs('orderInteret.index');
        $response->assertViewHas('orderInterets');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('order-interet.create'));

        $response->assertOk();
        $response->assertViewIs('orderInteret.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrderInteretController::class,
            'store',
            \App\Http\Requests\OrderInteretStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();
        $montant = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->post(route('order-interet.store'), [
            'user_id' => $user->id,
            'montant' => $montant,
        ]);

        $orderInterets = OrderInteret::query()
            ->where('user_id', $user->id)
            ->where('montant', $montant)
            ->get();
        $this->assertCount(1, $orderInterets);
        $orderInteret = $orderInterets->first();

        $response->assertRedirect(route('orderInteret.index'));
        $response->assertSessionHas('orderInteret.id', $orderInteret->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $orderInteret = OrderInteret::factory()->create();

        $response = $this->get(route('order-interet.show', $orderInteret));

        $response->assertOk();
        $response->assertViewIs('orderInteret.show');
        $response->assertViewHas('orderInteret');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $orderInteret = OrderInteret::factory()->create();

        $response = $this->get(route('order-interet.edit', $orderInteret));

        $response->assertOk();
        $response->assertViewIs('orderInteret.edit');
        $response->assertViewHas('orderInteret');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrderInteretController::class,
            'update',
            \App\Http\Requests\OrderInteretUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $orderInteret = OrderInteret::factory()->create();
        $user = User::factory()->create();
        $montant = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->put(route('order-interet.update', $orderInteret), [
            'user_id' => $user->id,
            'montant' => $montant,
        ]);

        $orderInteret->refresh();

        $response->assertRedirect(route('orderInteret.index'));
        $response->assertSessionHas('orderInteret.id', $orderInteret->id);

        $this->assertEquals($user->id, $orderInteret->user_id);
        $this->assertEquals($montant, $orderInteret->montant);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $orderInteret = OrderInteret::factory()->create();

        $response = $this->delete(route('order-interet.destroy', $orderInteret));

        $response->assertRedirect(route('orderInteret.index'));

        $this->assertSoftDeleted($orderInteret);
    }
}
