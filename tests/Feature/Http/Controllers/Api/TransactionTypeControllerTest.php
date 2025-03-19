<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\TransactionTypeController
 */
class TransactionTypeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $transactionTypes = TransactionType::factory()->count(3)->create();

        $response = $this->get(route('transaction-type.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\TransactionTypeController::class,
            'store',
            \App\Http\Requests\Api\TransactionTypeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $name = $this->faker->name;
        $user = User::factory()->create();

        $response = $this->post(route('transaction-type.store'), [
            'name' => $name,
            'user_id' => $user->id,
        ]);

        $transactionTypes = TransactionType::query()
            ->where('name', $name)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $transactionTypes);
        $transactionType = $transactionTypes->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $transactionType = TransactionType::factory()->create();

        $response = $this->get(route('transaction-type.show', $transactionType));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\TransactionTypeController::class,
            'update',
            \App\Http\Requests\Api\TransactionTypeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $transactionType = TransactionType::factory()->create();
        $name = $this->faker->name;
        $user = User::factory()->create();

        $response = $this->put(route('transaction-type.update', $transactionType), [
            'name' => $name,
            'user_id' => $user->id,
        ]);

        $transactionType->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $transactionType->name);
        $this->assertEquals($user->id, $transactionType->user_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $transactionType = TransactionType::factory()->create();

        $response = $this->delete(route('transaction-type.destroy', $transactionType));

        $response->assertNoContent();

        $this->assertDeleted($transactionType);
    }
}
