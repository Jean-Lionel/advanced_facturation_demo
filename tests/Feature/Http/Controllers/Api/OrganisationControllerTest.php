<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Organisation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\OrganisationController
 */
class OrganisationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $organisations = Organisation::factory()->count(3)->create();

        $response = $this->get(route('organisation.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OrganisationController::class,
            'store',
            \App\Http\Requests\Api\OrganisationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $user = User::factory()->create();
        $name = $this->faker->name;

        $response = $this->post(route('organisation.store'), [
            'user_id' => $user->id,
            'name' => $name,
        ]);

        $organisations = Organisation::query()
            ->where('user_id', $user->id)
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $organisations);
        $organisation = $organisations->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $organisation = Organisation::factory()->create();

        $response = $this->get(route('organisation.show', $organisation));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OrganisationController::class,
            'update',
            \App\Http\Requests\Api\OrganisationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $organisation = Organisation::factory()->create();
        $user = User::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('organisation.update', $organisation), [
            'user_id' => $user->id,
            'name' => $name,
        ]);

        $organisation->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($user->id, $organisation->user_id);
        $this->assertEquals($name, $organisation->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $organisation = Organisation::factory()->create();

        $response = $this->delete(route('organisation.destroy', $organisation));

        $response->assertNoContent();

        $this->assertDeleted($organisation);
    }
}
