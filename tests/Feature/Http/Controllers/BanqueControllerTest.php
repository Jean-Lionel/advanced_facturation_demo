<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Banque;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BanqueController
 */
class BanqueControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $banques = Banque::factory()->count(3)->create();

        $response = $this->get(route('banque.index'));

        $response->assertOk();
        $response->assertViewIs('banque.index');
        $response->assertViewHas('banques');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('banque.create'));

        $response->assertOk();
        $response->assertViewIs('banque.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BanqueController::class,
            'store',
            \App\Http\Requests\BanqueStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();
        $name = $this->faker->name;

        $response = $this->post(route('banque.store'), [
            'user_id' => $user->id,
            'name' => $name,
        ]);

        $banques = Banque::query()
            ->where('user_id', $user->id)
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $banques);
        $banque = $banques->first();

        $response->assertRedirect(route('banque.index'));
        $response->assertSessionHas('banque.id', $banque->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $banque = Banque::factory()->create();

        $response = $this->get(route('banque.show', $banque));

        $response->assertOk();
        $response->assertViewIs('banque.show');
        $response->assertViewHas('banque');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $banque = Banque::factory()->create();

        $response = $this->get(route('banque.edit', $banque));

        $response->assertOk();
        $response->assertViewIs('banque.edit');
        $response->assertViewHas('banque');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BanqueController::class,
            'update',
            \App\Http\Requests\BanqueUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $banque = Banque::factory()->create();
        $user = User::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('banque.update', $banque), [
            'user_id' => $user->id,
            'name' => $name,
        ]);

        $banque->refresh();

        $response->assertRedirect(route('banque.index'));
        $response->assertSessionHas('banque.id', $banque->id);

        $this->assertEquals($user->id, $banque->user_id);
        $this->assertEquals($name, $banque->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $banque = Banque::factory()->create();

        $response = $this->delete(route('banque.destroy', $banque));

        $response->assertRedirect(route('banque.index'));

        $this->assertSoftDeleted($banque);
    }
}
