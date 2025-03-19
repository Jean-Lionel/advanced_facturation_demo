<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Member;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\TransactionController
 */
class TransactionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $transactions = Transaction::factory()->count(3)->create();

        $response = $this->get(route('transaction.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\TransactionController::class,
            'store',
            \App\Http\Requests\Api\TransactionStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $user = User::factory()->create();
        $member = Member::factory()->create();
        $transaction_type = TransactionType::factory()->create();
        $montant = $this->faker->randomFloat(/** float_attributes **/);
        $date_transaction = $this->faker->date();

        $response = $this->post(route('transaction.store'), [
            'user_id' => $user->id,
            'member_id' => $member->id,
            'transaction_type_id' => $transaction_type->id,
            'montant' => $montant,
            'date_transaction' => $date_transaction,
        ]);

        $transactions = Transaction::query()
            ->where('user_id', $user->id)
            ->where('member_id', $member->id)
            ->where('transaction_type_id', $transaction_type->id)
            ->where('montant', $montant)
            ->where('date_transaction', $date_transaction)
            ->get();
        $this->assertCount(1, $transactions);
        $transaction = $transactions->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $transaction = Transaction::factory()->create();

        $response = $this->get(route('transaction.show', $transaction));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\TransactionController::class,
            'update',
            \App\Http\Requests\Api\TransactionUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $transaction = Transaction::factory()->create();
        $user = User::factory()->create();
        $member = Member::factory()->create();
        $transaction_type = TransactionType::factory()->create();
        $montant = $this->faker->randomFloat(/** float_attributes **/);
        $date_transaction = $this->faker->date();

        $response = $this->put(route('transaction.update', $transaction), [
            'user_id' => $user->id,
            'member_id' => $member->id,
            'transaction_type_id' => $transaction_type->id,
            'montant' => $montant,
            'date_transaction' => $date_transaction,
        ]);

        $transaction->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($user->id, $transaction->user_id);
        $this->assertEquals($member->id, $transaction->member_id);
        $this->assertEquals($transaction_type->id, $transaction->transaction_type_id);
        $this->assertEquals($montant, $transaction->montant);
        $this->assertEquals(Carbon::parse($date_transaction), $transaction->date_transaction);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $transaction = Transaction::factory()->create();

        $response = $this->delete(route('transaction.destroy', $transaction));

        $response->assertNoContent();

        $this->assertDeleted($transaction);
    }
}
