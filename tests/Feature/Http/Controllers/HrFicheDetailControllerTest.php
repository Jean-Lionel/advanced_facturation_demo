<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Commande;
use App\Models\Fiche;
use App\Models\HrFicheDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\HrFicheDetailController
 */
class HrFicheDetailControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $hrFicheDetails = HrFicheDetail::factory()->count(3)->create();

        $response = $this->get(route('hr-fiche-detail.index'));

        $response->assertOk();
        $response->assertViewIs('hrFicheDetail.index');
        $response->assertViewHas('hrFicheDetails');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('hr-fiche-detail.create'));

        $response->assertOk();
        $response->assertViewIs('hrFicheDetail.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\HrFicheDetailController::class,
            'store',
            \App\Http\Requests\HrFicheDetailStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();
        $fiche = Fiche::factory()->create();
        $commande = Commande::factory()->create();
        $date_debut = $this->faker->date();

        $response = $this->post(route('hr-fiche-detail.store'), [
            'user_id' => $user->id,
            'fiche_id' => $fiche->id,
            'commande_id' => $commande->id,
            'date_debut' => $date_debut,
        ]);

        $hrFicheDetails = HrFicheDetail::query()
            ->where('user_id', $user->id)
            ->where('fiche_id', $fiche->id)
            ->where('commande_id', $commande->id)
            ->where('date_debut', $date_debut)
            ->get();
        $this->assertCount(1, $hrFicheDetails);
        $hrFicheDetail = $hrFicheDetails->first();

        $response->assertRedirect(route('hrFicheDetail.index'));
        $response->assertSessionHas('hrFicheDetail.id', $hrFicheDetail->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $hrFicheDetail = HrFicheDetail::factory()->create();

        $response = $this->get(route('hr-fiche-detail.show', $hrFicheDetail));

        $response->assertOk();
        $response->assertViewIs('hrFicheDetail.show');
        $response->assertViewHas('hrFicheDetail');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $hrFicheDetail = HrFicheDetail::factory()->create();

        $response = $this->get(route('hr-fiche-detail.edit', $hrFicheDetail));

        $response->assertOk();
        $response->assertViewIs('hrFicheDetail.edit');
        $response->assertViewHas('hrFicheDetail');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\HrFicheDetailController::class,
            'update',
            \App\Http\Requests\HrFicheDetailUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $hrFicheDetail = HrFicheDetail::factory()->create();
        $user = User::factory()->create();
        $fiche = Fiche::factory()->create();
        $commande = Commande::factory()->create();
        $date_debut = $this->faker->date();

        $response = $this->put(route('hr-fiche-detail.update', $hrFicheDetail), [
            'user_id' => $user->id,
            'fiche_id' => $fiche->id,
            'commande_id' => $commande->id,
            'date_debut' => $date_debut,
        ]);

        $hrFicheDetail->refresh();

        $response->assertRedirect(route('hrFicheDetail.index'));
        $response->assertSessionHas('hrFicheDetail.id', $hrFicheDetail->id);

        $this->assertEquals($user->id, $hrFicheDetail->user_id);
        $this->assertEquals($fiche->id, $hrFicheDetail->fiche_id);
        $this->assertEquals($commande->id, $hrFicheDetail->commande_id);
        $this->assertEquals(Carbon::parse($date_debut), $hrFicheDetail->date_debut);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $hrFicheDetail = HrFicheDetail::factory()->create();

        $response = $this->delete(route('hr-fiche-detail.destroy', $hrFicheDetail));

        $response->assertRedirect(route('hrFicheDetail.index'));

        $this->assertSoftDeleted($hrFicheDetail);
    }
}
