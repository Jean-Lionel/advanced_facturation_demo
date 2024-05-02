<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ProductDetail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProductDetailController
 */
class ProductDetailControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $productDetails = ProductDetail::factory()->count(3)->create();

        $response = $this->get(route('product-detail.index'));

        $response->assertOk();
        $response->assertViewIs('productDetail.index');
        $response->assertViewHas('productDetails');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('product-detail.create'));

        $response->assertOk();
        $response->assertViewIs('productDetail.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductDetailController::class,
            'store',
            \App\Http\Requests\ProductDetailStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();

        $response = $this->post(route('product-detail.store'), [
            'user_id' => $user->id,
        ]);

        $productDetails = ProductDetail::query()
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $productDetails);
        $productDetail = $productDetails->first();

        $response->assertRedirect(route('productDetail.index'));
        $response->assertSessionHas('productDetail.id', $productDetail->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $productDetail = ProductDetail::factory()->create();

        $response = $this->get(route('product-detail.show', $productDetail));

        $response->assertOk();
        $response->assertViewIs('productDetail.show');
        $response->assertViewHas('productDetail');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $productDetail = ProductDetail::factory()->create();

        $response = $this->get(route('product-detail.edit', $productDetail));

        $response->assertOk();
        $response->assertViewIs('productDetail.edit');
        $response->assertViewHas('productDetail');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductDetailController::class,
            'update',
            \App\Http\Requests\ProductDetailUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $productDetail = ProductDetail::factory()->create();
        $user = User::factory()->create();

        $response = $this->put(route('product-detail.update', $productDetail), [
            'user_id' => $user->id,
        ]);

        $productDetail->refresh();

        $response->assertRedirect(route('productDetail.index'));
        $response->assertSessionHas('productDetail.id', $productDetail->id);

        $this->assertEquals($user->id, $productDetail->user_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $productDetail = ProductDetail::factory()->create();

        $response = $this->delete(route('product-detail.destroy', $productDetail));

        $response->assertRedirect(route('productDetail.index'));

        $this->assertDeleted($productDetail);
    }
}
