<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Maisonlocation;
use App\Models\PaymentLocationMensuel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PaymentLocationMensuelController
 */
class PaymentLocationMensuelControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $paymentLocationMensuels = PaymentLocationMensuel::factory()->count(3)->create();

        $response = $this->get(route('payment-location-mensuel.index'));

        $response->assertOk();
        $response->assertViewIs('paymentLocationMensuel.index');
        $response->assertViewHas('paymentLocationMensuels');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('payment-location-mensuel.create'));

        $response->assertOk();
        $response->assertViewIs('paymentLocationMensuel.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PaymentLocationMensuelController::class,
            'store',
            \App\Http\Requests\PaymentLocationMensuelStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();
        $maisonlocation = Maisonlocation::factory()->create();
        $montant = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->post(route('payment-location-mensuel.store'), [
            'user_id' => $user->id,
            'maisonlocation_id' => $maisonlocation->id,
            'montant' => $montant,
        ]);

        $paymentLocationMensuels = PaymentLocationMensuel::query()
            ->where('user_id', $user->id)
            ->where('maisonlocation_id', $maisonlocation->id)
            ->where('montant', $montant)
            ->get();
        $this->assertCount(1, $paymentLocationMensuels);
        $paymentLocationMensuel = $paymentLocationMensuels->first();

        $response->assertRedirect(route('paymentLocationMensuel.index'));
        $response->assertSessionHas('paymentLocationMensuel.id', $paymentLocationMensuel->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $paymentLocationMensuel = PaymentLocationMensuel::factory()->create();

        $response = $this->get(route('payment-location-mensuel.show', $paymentLocationMensuel));

        $response->assertOk();
        $response->assertViewIs('paymentLocationMensuel.show');
        $response->assertViewHas('paymentLocationMensuel');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $paymentLocationMensuel = PaymentLocationMensuel::factory()->create();

        $response = $this->get(route('payment-location-mensuel.edit', $paymentLocationMensuel));

        $response->assertOk();
        $response->assertViewIs('paymentLocationMensuel.edit');
        $response->assertViewHas('paymentLocationMensuel');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PaymentLocationMensuelController::class,
            'update',
            \App\Http\Requests\PaymentLocationMensuelUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $paymentLocationMensuel = PaymentLocationMensuel::factory()->create();
        $user = User::factory()->create();
        $maisonlocation = Maisonlocation::factory()->create();
        $montant = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->put(route('payment-location-mensuel.update', $paymentLocationMensuel), [
            'user_id' => $user->id,
            'maisonlocation_id' => $maisonlocation->id,
            'montant' => $montant,
        ]);

        $paymentLocationMensuel->refresh();

        $response->assertRedirect(route('paymentLocationMensuel.index'));
        $response->assertSessionHas('paymentLocationMensuel.id', $paymentLocationMensuel->id);

        $this->assertEquals($user->id, $paymentLocationMensuel->user_id);
        $this->assertEquals($maisonlocation->id, $paymentLocationMensuel->maisonlocation_id);
        $this->assertEquals($montant, $paymentLocationMensuel->montant);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $paymentLocationMensuel = PaymentLocationMensuel::factory()->create();

        $response = $this->delete(route('payment-location-mensuel.destroy', $paymentLocationMensuel));

        $response->assertRedirect(route('paymentLocationMensuel.index'));

        $this->assertSoftDeleted($paymentLocationMensuel);
    }
}
