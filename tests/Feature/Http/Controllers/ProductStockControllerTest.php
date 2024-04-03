<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProductStockController
 */
class ProductStockControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $productStocks = ProductStock::factory()->count(3)->create();

        $response = $this->get(route('product-stock.index'));

        $response->assertOk();
        $response->assertViewIs('productStock.index');
        $response->assertViewHas('productStocks');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('product-stock.create'));

        $response->assertOk();
        $response->assertViewIs('productStock.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductStockController::class,
            'store',
            \App\Http\Requests\ProductStockStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $product = Product::factory()->create();
        $stock = Stock::factory()->create();
        $quantity = $this->faker->randomFloat(/** double_attributes **/);
        $prix_revient = $this->faker->randomFloat(/** double_attributes **/);
        $prix_vente = $this->faker->randomFloat(/** double_attributes **/);
        $user = User::factory()->create();
        $created_at = $this->faker->dateTime();
        $updated_at = $this->faker->dateTime();

        $response = $this->post(route('product-stock.store'), [
            'product_id' => $product->id,
            'stock_id' => $stock->id,
            'quantity' => $quantity,
            'prix_revient' => $prix_revient,
            'prix_vente' => $prix_vente,
            'user_id' => $user->id,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ]);

        $productStocks = ProductStock::query()
            ->where('product_id', $product->id)
            ->where('stock_id', $stock->id)
            ->where('quantity', $quantity)
            ->where('prix_revient', $prix_revient)
            ->where('prix_vente', $prix_vente)
            ->where('user_id', $user->id)
            ->where('created_at', $created_at)
            ->where('updated_at', $updated_at)
            ->get();
        $this->assertCount(1, $productStocks);
        $productStock = $productStocks->first();

        $response->assertRedirect(route('productStock.index'));
        $response->assertSessionHas('productStock.id', $productStock->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $productStock = ProductStock::factory()->create();

        $response = $this->get(route('product-stock.show', $productStock));

        $response->assertOk();
        $response->assertViewIs('productStock.show');
        $response->assertViewHas('productStock');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $productStock = ProductStock::factory()->create();

        $response = $this->get(route('product-stock.edit', $productStock));

        $response->assertOk();
        $response->assertViewIs('productStock.edit');
        $response->assertViewHas('productStock');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductStockController::class,
            'update',
            \App\Http\Requests\ProductStockUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $productStock = ProductStock::factory()->create();
        $product = Product::factory()->create();
        $stock = Stock::factory()->create();
        $quantity = $this->faker->randomFloat(/** double_attributes **/);
        $prix_revient = $this->faker->randomFloat(/** double_attributes **/);
        $prix_vente = $this->faker->randomFloat(/** double_attributes **/);
        $user = User::factory()->create();
        $created_at = $this->faker->dateTime();
        $updated_at = $this->faker->dateTime();

        $response = $this->put(route('product-stock.update', $productStock), [
            'product_id' => $product->id,
            'stock_id' => $stock->id,
            'quantity' => $quantity,
            'prix_revient' => $prix_revient,
            'prix_vente' => $prix_vente,
            'user_id' => $user->id,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ]);

        $productStock->refresh();

        $response->assertRedirect(route('productStock.index'));
        $response->assertSessionHas('productStock.id', $productStock->id);

        $this->assertEquals($product->id, $productStock->product_id);
        $this->assertEquals($stock->id, $productStock->stock_id);
        $this->assertEquals($quantity, $productStock->quantity);
        $this->assertEquals($prix_revient, $productStock->prix_revient);
        $this->assertEquals($prix_vente, $productStock->prix_vente);
        $this->assertEquals($user->id, $productStock->user_id);
        $this->assertEquals($created_at, $productStock->created_at);
        $this->assertEquals($updated_at, $productStock->updated_at);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $productStock = ProductStock::factory()->create();

        $response = $this->delete(route('product-stock.destroy', $productStock));

        $response->assertRedirect(route('productStock.index'));

        $this->assertDeleted($productStock);
    }
}
