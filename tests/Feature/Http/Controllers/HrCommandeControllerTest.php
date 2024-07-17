<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\HrCommande;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\HrCommandeController
 */
class HrCommandeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $hrCommandes = HrCommande::factory()->count(3)->create();

        $response = $this->get(route('hr-commande.index'));

        $response->assertOk();
        $response->assertViewIs('hrCommande.index');
        $response->assertViewHas('hrCommandes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('hr-commande.create'));

        $response->assertOk();
        $response->assertViewIs('hrCommande.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\HrCommandeController::class,
            'store',
            \App\Http\Requests\HrCommandeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create();
        $total_command = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->post(route('hr-commande.store'), [
            'user_id' => $user->id,
            'order_id' => $order->id,
            'total_command' => $total_command,
        ]);

        $hrCommandes = HrCommande::query()
            ->where('user_id', $user->id)
            ->where('order_id', $order->id)
            ->where('total_command', $total_command)
            ->get();
        $this->assertCount(1, $hrCommandes);
        $hrCommande = $hrCommandes->first();

        $response->assertRedirect(route('hrCommande.index'));
        $response->assertSessionHas('hrCommande.id', $hrCommande->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $hrCommande = HrCommande::factory()->create();

        $response = $this->get(route('hr-commande.show', $hrCommande));

        $response->assertOk();
        $response->assertViewIs('hrCommande.show');
        $response->assertViewHas('hrCommande');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $hrCommande = HrCommande::factory()->create();

        $response = $this->get(route('hr-commande.edit', $hrCommande));

        $response->assertOk();
        $response->assertViewIs('hrCommande.edit');
        $response->assertViewHas('hrCommande');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\HrCommandeController::class,
            'update',
            \App\Http\Requests\HrCommandeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $hrCommande = HrCommande::factory()->create();
        $user = User::factory()->create();
        $order = Order::factory()->create();
        $total_command = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->put(route('hr-commande.update', $hrCommande), [
            'user_id' => $user->id,
            'order_id' => $order->id,
            'total_command' => $total_command,
        ]);

        $hrCommande->refresh();

        $response->assertRedirect(route('hrCommande.index'));
        $response->assertSessionHas('hrCommande.id', $hrCommande->id);

        $this->assertEquals($user->id, $hrCommande->user_id);
        $this->assertEquals($order->id, $hrCommande->order_id);
        $this->assertEquals($total_command, $hrCommande->total_command);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $hrCommande = HrCommande::factory()->create();

        $response = $this->delete(route('hr-commande.destroy', $hrCommande));

        $response->assertRedirect(route('hrCommande.index'));

        $this->assertSoftDeleted($hrCommande);
    }
}
