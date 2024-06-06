<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\HrChambre;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\HrChambreController
 */
class HrChambreControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $hrChambres = HrChambre::factory()->count(3)->create();

        $response = $this->get(route('hr-chambre.index'));

        $response->assertOk();
        $response->assertViewIs('hrChambre.index');
        $response->assertViewHas('hrChambres');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('hr-chambre.create'));

        $response->assertOk();
        $response->assertViewIs('hrChambre.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\HrChambreController::class,
            'store',
            \App\Http\Requests\HrChambreStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();
        $name = $this->faker->name;

        $response = $this->post(route('hr-chambre.store'), [
            'user_id' => $user->id,
            'name' => $name,
        ]);

        $hrChambres = HrChambre::query()
            ->where('user_id', $user->id)
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $hrChambres);
        $hrChambre = $hrChambres->first();

        $response->assertRedirect(route('hrChambre.index'));
        $response->assertSessionHas('hrChambre.id', $hrChambre->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $hrChambre = HrChambre::factory()->create();

        $response = $this->get(route('hr-chambre.show', $hrChambre));

        $response->assertOk();
        $response->assertViewIs('hrChambre.show');
        $response->assertViewHas('hrChambre');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $hrChambre = HrChambre::factory()->create();

        $response = $this->get(route('hr-chambre.edit', $hrChambre));

        $response->assertOk();
        $response->assertViewIs('hrChambre.edit');
        $response->assertViewHas('hrChambre');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\HrChambreController::class,
            'update',
            \App\Http\Requests\HrChambreUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $hrChambre = HrChambre::factory()->create();
        $user = User::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('hr-chambre.update', $hrChambre), [
            'user_id' => $user->id,
            'name' => $name,
        ]);

        $hrChambre->refresh();

        $response->assertRedirect(route('hrChambre.index'));
        $response->assertSessionHas('hrChambre.id', $hrChambre->id);

        $this->assertEquals($user->id, $hrChambre->user_id);
        $this->assertEquals($name, $hrChambre->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $hrChambre = HrChambre::factory()->create();

        $response = $this->delete(route('hr-chambre.destroy', $hrChambre));

        $response->assertRedirect(route('hrChambre.index'));

        $this->assertSoftDeleted($hrChambre);
    }
}
