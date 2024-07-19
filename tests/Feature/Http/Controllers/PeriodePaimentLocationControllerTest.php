<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\PeriodePaimentLocation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PeriodePaimentLocationController
 */
class PeriodePaimentLocationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $periodePaimentLocations = PeriodePaimentLocation::factory()->count(3)->create();

        $response = $this->get(route('periode-paiment-location.index'));

        $response->assertOk();
        $response->assertViewIs('periodePaimentLocation.index');
        $response->assertViewHas('periodePaimentLocations');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('periode-paiment-location.create'));

        $response->assertOk();
        $response->assertViewIs('periodePaimentLocation.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PeriodePaimentLocationController::class,
            'store',
            \App\Http\Requests\PeriodePaimentLocationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();

        $response = $this->post(route('periode-paiment-location.store'), [
            'user_id' => $user->id,
        ]);

        $periodePaimentLocations = PeriodePaimentLocation::query()
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $periodePaimentLocations);
        $periodePaimentLocation = $periodePaimentLocations->first();

        $response->assertRedirect(route('periodePaimentLocation.index'));
        $response->assertSessionHas('periodePaimentLocation.id', $periodePaimentLocation->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $periodePaimentLocation = PeriodePaimentLocation::factory()->create();

        $response = $this->get(route('periode-paiment-location.show', $periodePaimentLocation));

        $response->assertOk();
        $response->assertViewIs('periodePaimentLocation.show');
        $response->assertViewHas('periodePaimentLocation');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $periodePaimentLocation = PeriodePaimentLocation::factory()->create();

        $response = $this->get(route('periode-paiment-location.edit', $periodePaimentLocation));

        $response->assertOk();
        $response->assertViewIs('periodePaimentLocation.edit');
        $response->assertViewHas('periodePaimentLocation');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PeriodePaimentLocationController::class,
            'update',
            \App\Http\Requests\PeriodePaimentLocationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $periodePaimentLocation = PeriodePaimentLocation::factory()->create();
        $user = User::factory()->create();

        $response = $this->put(route('periode-paiment-location.update', $periodePaimentLocation), [
            'user_id' => $user->id,
        ]);

        $periodePaimentLocation->refresh();

        $response->assertRedirect(route('periodePaimentLocation.index'));
        $response->assertSessionHas('periodePaimentLocation.id', $periodePaimentLocation->id);

        $this->assertEquals($user->id, $periodePaimentLocation->user_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $periodePaimentLocation = PeriodePaimentLocation::factory()->create();

        $response = $this->delete(route('periode-paiment-location.destroy', $periodePaimentLocation));

        $response->assertRedirect(route('periodePaimentLocation.index'));

        $this->assertSoftDeleted($periodePaimentLocation);
    }
}
