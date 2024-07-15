<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\MaisonLocation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MaisonLocationController
 */
class MaisonLocationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $maisonLocations = MaisonLocation::factory()->count(3)->create();

        $response = $this->get(route('maison-location.index'));

        $response->assertOk();
        $response->assertViewIs('maisonLocation.index');
        $response->assertViewHas('maisonLocations');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('maison-location.create'));

        $response->assertOk();
        $response->assertViewIs('maisonLocation.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MaisonLocationController::class,
            'store',
            \App\Http\Requests\MaisonLocationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();
        $name = $this->faker->name;
        $montant = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->post(route('maison-location.store'), [
            'user_id' => $user->id,
            'name' => $name,
            'montant' => $montant,
        ]);

        $maisonLocations = MaisonLocation::query()
            ->where('user_id', $user->id)
            ->where('name', $name)
            ->where('montant', $montant)
            ->get();
        $this->assertCount(1, $maisonLocations);
        $maisonLocation = $maisonLocations->first();

        $response->assertRedirect(route('maisonLocation.index'));
        $response->assertSessionHas('maisonLocation.id', $maisonLocation->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $maisonLocation = MaisonLocation::factory()->create();

        $response = $this->get(route('maison-location.show', $maisonLocation));

        $response->assertOk();
        $response->assertViewIs('maisonLocation.show');
        $response->assertViewHas('maisonLocation');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $maisonLocation = MaisonLocation::factory()->create();

        $response = $this->get(route('maison-location.edit', $maisonLocation));

        $response->assertOk();
        $response->assertViewIs('maisonLocation.edit');
        $response->assertViewHas('maisonLocation');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MaisonLocationController::class,
            'update',
            \App\Http\Requests\MaisonLocationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $maisonLocation = MaisonLocation::factory()->create();
        $user = User::factory()->create();
        $name = $this->faker->name;
        $montant = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->put(route('maison-location.update', $maisonLocation), [
            'user_id' => $user->id,
            'name' => $name,
            'montant' => $montant,
        ]);

        $maisonLocation->refresh();

        $response->assertRedirect(route('maisonLocation.index'));
        $response->assertSessionHas('maisonLocation.id', $maisonLocation->id);

        $this->assertEquals($user->id, $maisonLocation->user_id);
        $this->assertEquals($name, $maisonLocation->name);
        $this->assertEquals($montant, $maisonLocation->montant);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $maisonLocation = MaisonLocation::factory()->create();

        $response = $this->delete(route('maison-location.destroy', $maisonLocation));

        $response->assertRedirect(route('maisonLocation.index'));

        $this->assertSoftDeleted($maisonLocation);
    }
}
