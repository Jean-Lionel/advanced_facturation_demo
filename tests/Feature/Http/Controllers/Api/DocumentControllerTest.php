<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Document;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\DocumentController
 */
class DocumentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $documents = Document::factory()->count(3)->create();

        $response = $this->get(route('document.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\DocumentController::class,
            'store',
            \App\Http\Requests\Api\DocumentStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $user = User::factory()->create();
        $name = $this->faker->name;

        $response = $this->post(route('document.store'), [
            'user_id' => $user->id,
            'name' => $name,
        ]);

        $documents = Document::query()
            ->where('user_id', $user->id)
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $documents);
        $document = $documents->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $document = Document::factory()->create();

        $response = $this->get(route('document.show', $document));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\DocumentController::class,
            'update',
            \App\Http\Requests\Api\DocumentUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $document = Document::factory()->create();
        $user = User::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('document.update', $document), [
            'user_id' => $user->id,
            'name' => $name,
        ]);

        $document->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($user->id, $document->user_id);
        $this->assertEquals($name, $document->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $document = Document::factory()->create();

        $response = $this->delete(route('document.destroy', $document));

        $response->assertNoContent();

        $this->assertDeleted($document);
    }
}
