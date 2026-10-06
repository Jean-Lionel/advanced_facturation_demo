<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Client;
use App\Models\Embalage;
use App\Models\EmbalageMouvement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\EmbalageMouvementController
 */
class EmbalageMouvementControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $embalageMouvements = EmbalageMouvement::factory()->count(3)->create();

        $response = $this->get(route('embalage-mouvement.index'));

        $response->assertOk();
        $response->assertViewIs('embalageMouvement.index');
        $response->assertViewHas('embalageMouvements');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('embalage-mouvement.create'));

        $response->assertOk();
        $response->assertViewIs('embalageMouvement.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EmbalageMouvementController::class,
            'store',
            \App\Http\Requests\EmbalageMouvementStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $type = $this->faker->word;
        $quantity = $this->faker->randomFloat(/** double_attributes **/);
        $embalage = Embalage::factory()->create();
        $client = Client::factory()->create();

        $response = $this->post(route('embalage-mouvement.store'), [
            'type' => $type,
            'quantity' => $quantity,
            'embalage_id' => $embalage->id,
            'client_id' => $client->id,
        ]);

        $embalageMouvements = EmbalageMouvement::query()
            ->where('type', $type)
            ->where('quantity', $quantity)
            ->where('embalage_id', $embalage->id)
            ->where('client_id', $client->id)
            ->get();
        $this->assertCount(1, $embalageMouvements);
        $embalageMouvement = $embalageMouvements->first();

        $response->assertRedirect(route('embalageMouvement.index'));
        $response->assertSessionHas('embalageMouvement.id', $embalageMouvement->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $embalageMouvement = EmbalageMouvement::factory()->create();

        $response = $this->get(route('embalage-mouvement.show', $embalageMouvement));

        $response->assertOk();
        $response->assertViewIs('embalageMouvement.show');
        $response->assertViewHas('embalageMouvement');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $embalageMouvement = EmbalageMouvement::factory()->create();

        $response = $this->get(route('embalage-mouvement.edit', $embalageMouvement));

        $response->assertOk();
        $response->assertViewIs('embalageMouvement.edit');
        $response->assertViewHas('embalageMouvement');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EmbalageMouvementController::class,
            'update',
            \App\Http\Requests\EmbalageMouvementUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $embalageMouvement = EmbalageMouvement::factory()->create();
        $type = $this->faker->word;
        $quantity = $this->faker->randomFloat(/** double_attributes **/);
        $embalage = Embalage::factory()->create();
        $client = Client::factory()->create();

        $response = $this->put(route('embalage-mouvement.update', $embalageMouvement), [
            'type' => $type,
            'quantity' => $quantity,
            'embalage_id' => $embalage->id,
            'client_id' => $client->id,
        ]);

        $embalageMouvement->refresh();

        $response->assertRedirect(route('embalageMouvement.index'));
        $response->assertSessionHas('embalageMouvement.id', $embalageMouvement->id);

        $this->assertEquals($type, $embalageMouvement->type);
        $this->assertEquals($quantity, $embalageMouvement->quantity);
        $this->assertEquals($embalage->id, $embalageMouvement->embalage_id);
        $this->assertEquals($client->id, $embalageMouvement->client_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $embalageMouvement = EmbalageMouvement::factory()->create();

        $response = $this->delete(route('embalage-mouvement.destroy', $embalageMouvement));

        $response->assertRedirect(route('embalageMouvement.index'));

        $this->assertDeleted($embalageMouvement);
    }
}
