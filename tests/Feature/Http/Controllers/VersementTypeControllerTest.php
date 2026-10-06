<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\VersementType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\VersementTypeController
 */
class VersementTypeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $versementTypes = VersementType::factory()->count(3)->create();

        $response = $this->get(route('versement-type.index'));

        $response->assertOk();
        $response->assertViewIs('versementType.index');
        $response->assertViewHas('versementTypes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('versement-type.create'));

        $response->assertOk();
        $response->assertViewIs('versementType.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VersementTypeController::class,
            'store',
            \App\Http\Requests\VersementTypeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;

        $response = $this->post(route('versement-type.store'), [
            'name' => $name,
        ]);

        $versementTypes = VersementType::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $versementTypes);
        $versementType = $versementTypes->first();

        $response->assertRedirect(route('versementType.index'));
        $response->assertSessionHas('versementType.id', $versementType->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $versementType = VersementType::factory()->create();

        $response = $this->get(route('versement-type.show', $versementType));

        $response->assertOk();
        $response->assertViewIs('versementType.show');
        $response->assertViewHas('versementType');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $versementType = VersementType::factory()->create();

        $response = $this->get(route('versement-type.edit', $versementType));

        $response->assertOk();
        $response->assertViewIs('versementType.edit');
        $response->assertViewHas('versementType');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VersementTypeController::class,
            'update',
            \App\Http\Requests\VersementTypeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $versementType = VersementType::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('versement-type.update', $versementType), [
            'name' => $name,
        ]);

        $versementType->refresh();

        $response->assertRedirect(route('versementType.index'));
        $response->assertSessionHas('versementType.id', $versementType->id);

        $this->assertEquals($name, $versementType->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $versementType = VersementType::factory()->create();

        $response = $this->delete(route('versement-type.destroy', $versementType));

        $response->assertRedirect(route('versementType.index'));

        $this->assertDeleted($versementType);
    }
}
