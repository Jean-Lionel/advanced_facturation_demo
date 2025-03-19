<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\MemberController
 */
class MemberControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $members = Member::factory()->count(3)->create();

        $response = $this->get(route('member.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\MemberController::class,
            'store',
            \App\Http\Requests\Api\MemberStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $last_name = $this->faker->lastName;
        $email = $this->faker->safeEmail;
        $title = $this->faker->sentence(4);
        $is_active = $this->faker->boolean;

        $response = $this->post(route('member.store'), [
            'last_name' => $last_name,
            'email' => $email,
            'title' => $title,
            'is_active' => $is_active,
        ]);

        $members = Member::query()
            ->where('last_name', $last_name)
            ->where('email', $email)
            ->where('title', $title)
            ->where('is_active', $is_active)
            ->get();
        $this->assertCount(1, $members);
        $member = $members->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $member = Member::factory()->create();

        $response = $this->get(route('member.show', $member));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\MemberController::class,
            'update',
            \App\Http\Requests\Api\MemberUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $member = Member::factory()->create();
        $last_name = $this->faker->lastName;
        $email = $this->faker->safeEmail;
        $title = $this->faker->sentence(4);
        $is_active = $this->faker->boolean;

        $response = $this->put(route('member.update', $member), [
            'last_name' => $last_name,
            'email' => $email,
            'title' => $title,
            'is_active' => $is_active,
        ]);

        $member->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($last_name, $member->last_name);
        $this->assertEquals($email, $member->email);
        $this->assertEquals($title, $member->title);
        $this->assertEquals($is_active, $member->is_active);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $member = Member::factory()->create();

        $response = $this->delete(route('member.destroy', $member));

        $response->assertNoContent();

        $this->assertDeleted($member);
    }
}
