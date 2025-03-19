<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Transaction;
use App\Models\TransactionFile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\TransactionFileController
 */
class TransactionFileControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $transactionFiles = TransactionFile::factory()->count(3)->create();

        $response = $this->get(route('transaction-file.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\TransactionFileController::class,
            'store',
            \App\Http\Requests\Api\TransactionFileStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $name = $this->faker->name;
        $file_url = $this->faker->word;
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create();

        $response = $this->post(route('transaction-file.store'), [
            'name' => $name,
            'file_url' => $file_url,
            'user_id' => $user->id,
            'transaction_id' => $transaction->id,
        ]);

        $transactionFiles = TransactionFile::query()
            ->where('name', $name)
            ->where('file_url', $file_url)
            ->where('user_id', $user->id)
            ->where('transaction_id', $transaction->id)
            ->get();
        $this->assertCount(1, $transactionFiles);
        $transactionFile = $transactionFiles->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $transactionFile = TransactionFile::factory()->create();

        $response = $this->get(route('transaction-file.show', $transactionFile));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\TransactionFileController::class,
            'update',
            \App\Http\Requests\Api\TransactionFileUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $transactionFile = TransactionFile::factory()->create();
        $name = $this->faker->name;
        $file_url = $this->faker->word;
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create();

        $response = $this->put(route('transaction-file.update', $transactionFile), [
            'name' => $name,
            'file_url' => $file_url,
            'user_id' => $user->id,
            'transaction_id' => $transaction->id,
        ]);

        $transactionFile->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $transactionFile->name);
        $this->assertEquals($file_url, $transactionFile->file_url);
        $this->assertEquals($user->id, $transactionFile->user_id);
        $this->assertEquals($transaction->id, $transactionFile->transaction_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $transactionFile = TransactionFile::factory()->create();

        $response = $this->delete(route('transaction-file.destroy', $transactionFile));

        $response->assertNoContent();

        $this->assertDeleted($transactionFile);
    }
}
