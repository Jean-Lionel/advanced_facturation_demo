<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Embalage;
use App\Models\TypeEmbalage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\EmbalageController
 */
class EmbalageControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $embalages = Embalage::factory()->count(3)->create();

        $response = $this->get(route('embalage.index'));

        $response->assertOk();
        $response->assertViewIs('embalage.index');
        $response->assertViewHas('embalages');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('embalage.create'));

        $response->assertOk();
        $response->assertViewIs('embalage.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EmbalageController::class,
            'store',
            \App\Http\Requests\EmbalageStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $price = $this->faker->randomFloat(/** double_attributes **/);
        $quantity = $this->faker->randomFloat(/** double_attributes **/);
        $type_embalage = TypeEmbalage::factory()->create();

        $response = $this->post(route('embalage.store'), [
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'type_embalage_id' => $type_embalage->id,
        ]);

        $embalages = Embalage::query()
            ->where('name', $name)
            ->where('price', $price)
            ->where('quantity', $quantity)
            ->where('type_embalage_id', $type_embalage->id)
            ->get();
        $this->assertCount(1, $embalages);
        $embalage = $embalages->first();

        $response->assertRedirect(route('embalage.index'));
        $response->assertSessionHas('embalage.id', $embalage->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $embalage = Embalage::factory()->create();

        $response = $this->get(route('embalage.show', $embalage));

        $response->assertOk();
        $response->assertViewIs('embalage.show');
        $response->assertViewHas('embalage');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $embalage = Embalage::factory()->create();

        $response = $this->get(route('embalage.edit', $embalage));

        $response->assertOk();
        $response->assertViewIs('embalage.edit');
        $response->assertViewHas('embalage');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EmbalageController::class,
            'update',
            \App\Http\Requests\EmbalageUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $embalage = Embalage::factory()->create();
        $name = $this->faker->name;
        $price = $this->faker->randomFloat(/** double_attributes **/);
        $quantity = $this->faker->randomFloat(/** double_attributes **/);
        $type_embalage = TypeEmbalage::factory()->create();

        $response = $this->put(route('embalage.update', $embalage), [
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'type_embalage_id' => $type_embalage->id,
        ]);

        $embalage->refresh();

        $response->assertRedirect(route('embalage.index'));
        $response->assertSessionHas('embalage.id', $embalage->id);

        $this->assertEquals($name, $embalage->name);
        $this->assertEquals($price, $embalage->price);
        $this->assertEquals($quantity, $embalage->quantity);
        $this->assertEquals($type_embalage->id, $embalage->type_embalage_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $embalage = Embalage::factory()->create();

        $response = $this->delete(route('embalage.destroy', $embalage));

        $response->assertRedirect(route('embalage.index'));

        $this->assertDeleted($embalage);
    }
}
