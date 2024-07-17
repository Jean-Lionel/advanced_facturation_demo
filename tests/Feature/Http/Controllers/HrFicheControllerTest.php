<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\HrFiche;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\HrFicheController
 */
class HrFicheControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $hrFiches = HrFiche::factory()->count(3)->create();

        $response = $this->get(route('hr-fiche.index'));

        $response->assertOk();
        $response->assertViewIs('hrFiche.index');
        $response->assertViewHas('hrFiches');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('hr-fiche.create'));

        $response->assertOk();
        $response->assertViewIs('hrFiche.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\HrFicheController::class,
            'store',
            \App\Http\Requests\HrFicheStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();
        $date_debut = $this->faker->date();

        $response = $this->post(route('hr-fiche.store'), [
            'user_id' => $user->id,
            'date_debut' => $date_debut,
        ]);

        $hrFiches = HrFiche::query()
            ->where('user_id', $user->id)
            ->where('date_debut', $date_debut)
            ->get();
        $this->assertCount(1, $hrFiches);
        $hrFiche = $hrFiches->first();

        $response->assertRedirect(route('hrFiche.index'));
        $response->assertSessionHas('hrFiche.id', $hrFiche->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $hrFiche = HrFiche::factory()->create();

        $response = $this->get(route('hr-fiche.show', $hrFiche));

        $response->assertOk();
        $response->assertViewIs('hrFiche.show');
        $response->assertViewHas('hrFiche');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $hrFiche = HrFiche::factory()->create();

        $response = $this->get(route('hr-fiche.edit', $hrFiche));

        $response->assertOk();
        $response->assertViewIs('hrFiche.edit');
        $response->assertViewHas('hrFiche');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\HrFicheController::class,
            'update',
            \App\Http\Requests\HrFicheUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $hrFiche = HrFiche::factory()->create();
        $user = User::factory()->create();
        $date_debut = $this->faker->date();

        $response = $this->put(route('hr-fiche.update', $hrFiche), [
            'user_id' => $user->id,
            'date_debut' => $date_debut,
        ]);

        $hrFiche->refresh();

        $response->assertRedirect(route('hrFiche.index'));
        $response->assertSessionHas('hrFiche.id', $hrFiche->id);

        $this->assertEquals($user->id, $hrFiche->user_id);
        $this->assertEquals(Carbon::parse($date_debut), $hrFiche->date_debut);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $hrFiche = HrFiche::factory()->create();

        $response = $this->delete(route('hr-fiche.destroy', $hrFiche));

        $response->assertRedirect(route('hrFiche.index'));

        $this->assertSoftDeleted($hrFiche);
    }
}
