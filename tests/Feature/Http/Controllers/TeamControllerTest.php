<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TeamController
 */
class TeamControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $teams = Team::factory()->count(3)->create();

        $response = $this->get(route('team.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TeamController::class,
            'store',
            \App\Http\Requests\TeamStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $user_id = $this->faker->numberBetween(-100000, 100000);
        $name = $this->faker->name;
        $personal_team = $this->faker->boolean;

        $response = $this->post(route('team.store'), [
            'user_id' => $user_id,
            'name' => $name,
            'personal_team' => $personal_team,
        ]);

        $teams = Team::query()
            ->where('user_id', $user_id)
            ->where('name', $name)
            ->where('personal_team', $personal_team)
            ->get();
        $this->assertCount(1, $teams);
        $team = $teams->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $team = Team::factory()->create();

        $response = $this->get(route('team.show', $team));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TeamController::class,
            'update',
            \App\Http\Requests\TeamUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $team = Team::factory()->create();
        $user_id = $this->faker->numberBetween(-100000, 100000);
        $name = $this->faker->name;
        $personal_team = $this->faker->boolean;

        $response = $this->put(route('team.update', $team), [
            'user_id' => $user_id,
            'name' => $name,
            'personal_team' => $personal_team,
        ]);

        $team->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($user_id, $team->user_id);
        $this->assertEquals($name, $team->name);
        $this->assertEquals($personal_team, $team->personal_team);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $team = Team::factory()->create();

        $response = $this->delete(route('team.destroy', $team));

        $response->assertNoContent();

        $this->assertDeleted($team);
    }
}
