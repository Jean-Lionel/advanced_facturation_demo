<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Client;
use App\Models\ClientHistory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ClientHistoryController
 */
class ClientHistoryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $clientHistories = ClientHistory::factory()->count(3)->create();

        $response = $this->get(route('client-history.index'));

        $response->assertOk();
        $response->assertViewIs('clientHistory.index');
        $response->assertViewHas('clientHistories');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('client-history.create'));

        $response->assertOk();
        $response->assertViewIs('clientHistory.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ClientHistoryController::class,
            'store',
            \App\Http\Requests\ClientHistoryStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();
        $client = Client::factory()->create();
        $content = $this->faker->paragraphs(3, true);

        $response = $this->post(route('client-history.store'), [
            'user_id' => $user->id,
            'client_id' => $client->id,
            'content' => $content,
        ]);

        $clientHistories = ClientHistory::query()
            ->where('user_id', $user->id)
            ->where('client_id', $client->id)
            ->where('content', $content)
            ->get();
        $this->assertCount(1, $clientHistories);
        $clientHistory = $clientHistories->first();

        $response->assertRedirect(route('clientHistory.index'));
        $response->assertSessionHas('clientHistory.id', $clientHistory->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $clientHistory = ClientHistory::factory()->create();

        $response = $this->get(route('client-history.show', $clientHistory));

        $response->assertOk();
        $response->assertViewIs('clientHistory.show');
        $response->assertViewHas('clientHistory');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $clientHistory = ClientHistory::factory()->create();

        $response = $this->get(route('client-history.edit', $clientHistory));

        $response->assertOk();
        $response->assertViewIs('clientHistory.edit');
        $response->assertViewHas('clientHistory');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ClientHistoryController::class,
            'update',
            \App\Http\Requests\ClientHistoryUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $clientHistory = ClientHistory::factory()->create();
        $user = User::factory()->create();
        $client = Client::factory()->create();
        $content = $this->faker->paragraphs(3, true);

        $response = $this->put(route('client-history.update', $clientHistory), [
            'user_id' => $user->id,
            'client_id' => $client->id,
            'content' => $content,
        ]);

        $clientHistory->refresh();

        $response->assertRedirect(route('clientHistory.index'));
        $response->assertSessionHas('clientHistory.id', $clientHistory->id);

        $this->assertEquals($user->id, $clientHistory->user_id);
        $this->assertEquals($client->id, $clientHistory->client_id);
        $this->assertEquals($content, $clientHistory->content);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $clientHistory = ClientHistory::factory()->create();

        $response = $this->delete(route('client-history.destroy', $clientHistory));

        $response->assertRedirect(route('clientHistory.index'));

        $this->assertSoftDeleted($clientHistory);
    }
}
