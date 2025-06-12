<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\TypeEmbalage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TypeEmbalageController
 */
class TypeEmbalageControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $typeEmbalages = TypeEmbalage::factory()->count(3)->create();

        $response = $this->get(route('type-embalage.index'));

        $response->assertOk();
        $response->assertViewIs('typeEmbalage.index');
        $response->assertViewHas('typeEmbalages');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('type-embalage.create'));

        $response->assertOk();
        $response->assertViewIs('typeEmbalage.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TypeEmbalageController::class,
            'store',
            \App\Http\Requests\TypeEmbalageStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;

        $response = $this->post(route('type-embalage.store'), [
            'name' => $name,
        ]);

        $typeEmbalages = TypeEmbalage::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $typeEmbalages);
        $typeEmbalage = $typeEmbalages->first();

        $response->assertRedirect(route('typeEmbalage.index'));
        $response->assertSessionHas('typeEmbalage.id', $typeEmbalage->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $typeEmbalage = TypeEmbalage::factory()->create();

        $response = $this->get(route('type-embalage.show', $typeEmbalage));

        $response->assertOk();
        $response->assertViewIs('typeEmbalage.show');
        $response->assertViewHas('typeEmbalage');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $typeEmbalage = TypeEmbalage::factory()->create();

        $response = $this->get(route('type-embalage.edit', $typeEmbalage));

        $response->assertOk();
        $response->assertViewIs('typeEmbalage.edit');
        $response->assertViewHas('typeEmbalage');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TypeEmbalageController::class,
            'update',
            \App\Http\Requests\TypeEmbalageUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $typeEmbalage = TypeEmbalage::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('type-embalage.update', $typeEmbalage), [
            'name' => $name,
        ]);

        $typeEmbalage->refresh();

        $response->assertRedirect(route('typeEmbalage.index'));
        $response->assertSessionHas('typeEmbalage.id', $typeEmbalage->id);

        $this->assertEquals($name, $typeEmbalage->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $typeEmbalage = TypeEmbalage::factory()->create();

        $response = $this->delete(route('type-embalage.destroy', $typeEmbalage));

        $response->assertRedirect(route('typeEmbalage.index'));

        $this->assertDeleted($typeEmbalage);
    }
}
