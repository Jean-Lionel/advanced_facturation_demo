<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ActivityController
 */
class ActivityControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $activities = Activity::factory()->count(3)->create();

        $response = $this->get(route('activity.index'));

        $response->assertOk();
        $response->assertViewIs('activity.index');
        $response->assertViewHas('activities');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('activity.create'));

        $response->assertOk();
        $response->assertViewIs('activity.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ActivityController::class,
            'store',
            \App\Http\Requests\ActivityStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $user = User::factory()->create();

        $response = $this->post(route('activity.store'), [
            'name' => $name,
            'user_id' => $user->id,
        ]);

        $activities = Activity::query()
            ->where('name', $name)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $activities);
        $activity = $activities->first();

        $response->assertRedirect(route('activity.index'));
        $response->assertSessionHas('activity.id', $activity->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $activity = Activity::factory()->create();

        $response = $this->get(route('activity.show', $activity));

        $response->assertOk();
        $response->assertViewIs('activity.show');
        $response->assertViewHas('activity');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $activity = Activity::factory()->create();

        $response = $this->get(route('activity.edit', $activity));

        $response->assertOk();
        $response->assertViewIs('activity.edit');
        $response->assertViewHas('activity');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ActivityController::class,
            'update',
            \App\Http\Requests\ActivityUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $activity = Activity::factory()->create();
        $name = $this->faker->name;
        $user = User::factory()->create();

        $response = $this->put(route('activity.update', $activity), [
            'name' => $name,
            'user_id' => $user->id,
        ]);

        $activity->refresh();

        $response->assertRedirect(route('activity.index'));
        $response->assertSessionHas('activity.id', $activity->id);

        $this->assertEquals($name, $activity->name);
        $this->assertEquals($user->id, $activity->user_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $activity = Activity::factory()->create();

        $response = $this->delete(route('activity.destroy', $activity));

        $response->assertRedirect(route('activity.index'));

        $this->assertDeleted($activity);
    }
}
