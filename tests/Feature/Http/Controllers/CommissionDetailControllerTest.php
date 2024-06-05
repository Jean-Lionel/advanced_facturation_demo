<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CommissionDetail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CommissionDetailController
 */
class CommissionDetailControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $commissionDetails = CommissionDetail::factory()->count(3)->create();

        $response = $this->get(route('commission-detail.index'));

        $response->assertOk();
        $response->assertViewIs('commissionDetail.index');
        $response->assertViewHas('commissionDetails');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('commission-detail.create'));

        $response->assertOk();
        $response->assertViewIs('commissionDetail.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CommissionDetailController::class,
            'store',
            \App\Http\Requests\CommissionDetailStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();
        $montant = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->post(route('commission-detail.store'), [
            'user_id' => $user->id,
            'montant' => $montant,
        ]);

        $commissionDetails = CommissionDetail::query()
            ->where('user_id', $user->id)
            ->where('montant', $montant)
            ->get();
        $this->assertCount(1, $commissionDetails);
        $commissionDetail = $commissionDetails->first();

        $response->assertRedirect(route('commissionDetail.index'));
        $response->assertSessionHas('commissionDetail.id', $commissionDetail->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $commissionDetail = CommissionDetail::factory()->create();

        $response = $this->get(route('commission-detail.show', $commissionDetail));

        $response->assertOk();
        $response->assertViewIs('commissionDetail.show');
        $response->assertViewHas('commissionDetail');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $commissionDetail = CommissionDetail::factory()->create();

        $response = $this->get(route('commission-detail.edit', $commissionDetail));

        $response->assertOk();
        $response->assertViewIs('commissionDetail.edit');
        $response->assertViewHas('commissionDetail');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CommissionDetailController::class,
            'update',
            \App\Http\Requests\CommissionDetailUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $commissionDetail = CommissionDetail::factory()->create();
        $user = User::factory()->create();
        $montant = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->put(route('commission-detail.update', $commissionDetail), [
            'user_id' => $user->id,
            'montant' => $montant,
        ]);

        $commissionDetail->refresh();

        $response->assertRedirect(route('commissionDetail.index'));
        $response->assertSessionHas('commissionDetail.id', $commissionDetail->id);

        $this->assertEquals($user->id, $commissionDetail->user_id);
        $this->assertEquals($montant, $commissionDetail->montant);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $commissionDetail = CommissionDetail::factory()->create();

        $response = $this->delete(route('commission-detail.destroy', $commissionDetail));

        $response->assertRedirect(route('commissionDetail.index'));

        $this->assertSoftDeleted($commissionDetail);
    }
}
