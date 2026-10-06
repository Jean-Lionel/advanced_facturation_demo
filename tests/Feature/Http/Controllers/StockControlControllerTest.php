<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use App\Models\StockControl;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\StockControlController
 */
class StockControlControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $stockControls = StockControl::factory()->count(3)->create();

        $response = $this->get(route('stock-control.index'));

        $response->assertOk();
        $response->assertViewIs('stockControl.index');
        $response->assertViewHas('stockControls');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('stock-control.create'));

        $response->assertOk();
        $response->assertViewIs('stockControl.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\StockControlController::class,
            'store',
            \App\Http\Requests\StockControlStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $product = Product::factory()->create();
        $old_quantity = $this->faker->randomFloat(/** double_attributes **/);
        $new_quantity = $this->faker->randomFloat(/** double_attributes **/);
        $sold_quantity = $this->faker->randomFloat(/** double_attributes **/);
        $price = $this->faker->randomFloat(/** double_attributes **/);
        $user = User::factory()->create();

        $response = $this->post(route('stock-control.store'), [
            'product_id' => $product->id,
            'old_quantity' => $old_quantity,
            'new_quantity' => $new_quantity,
            'sold_quantity' => $sold_quantity,
            'price' => $price,
            'user_id' => $user->id,
        ]);

        $stockControls = StockControl::query()
            ->where('product_id', $product->id)
            ->where('old_quantity', $old_quantity)
            ->where('new_quantity', $new_quantity)
            ->where('sold_quantity', $sold_quantity)
            ->where('price', $price)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $stockControls);
        $stockControl = $stockControls->first();

        $response->assertRedirect(route('stockControl.index'));
        $response->assertSessionHas('stockControl.id', $stockControl->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $stockControl = StockControl::factory()->create();

        $response = $this->get(route('stock-control.show', $stockControl));

        $response->assertOk();
        $response->assertViewIs('stockControl.show');
        $response->assertViewHas('stockControl');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $stockControl = StockControl::factory()->create();

        $response = $this->get(route('stock-control.edit', $stockControl));

        $response->assertOk();
        $response->assertViewIs('stockControl.edit');
        $response->assertViewHas('stockControl');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\StockControlController::class,
            'update',
            \App\Http\Requests\StockControlUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $stockControl = StockControl::factory()->create();
        $product = Product::factory()->create();
        $old_quantity = $this->faker->randomFloat(/** double_attributes **/);
        $new_quantity = $this->faker->randomFloat(/** double_attributes **/);
        $sold_quantity = $this->faker->randomFloat(/** double_attributes **/);
        $price = $this->faker->randomFloat(/** double_attributes **/);
        $user = User::factory()->create();

        $response = $this->put(route('stock-control.update', $stockControl), [
            'product_id' => $product->id,
            'old_quantity' => $old_quantity,
            'new_quantity' => $new_quantity,
            'sold_quantity' => $sold_quantity,
            'price' => $price,
            'user_id' => $user->id,
        ]);

        $stockControl->refresh();

        $response->assertRedirect(route('stockControl.index'));
        $response->assertSessionHas('stockControl.id', $stockControl->id);

        $this->assertEquals($product->id, $stockControl->product_id);
        $this->assertEquals($old_quantity, $stockControl->old_quantity);
        $this->assertEquals($new_quantity, $stockControl->new_quantity);
        $this->assertEquals($sold_quantity, $stockControl->sold_quantity);
        $this->assertEquals($price, $stockControl->price);
        $this->assertEquals($user->id, $stockControl->user_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $stockControl = StockControl::factory()->create();

        $response = $this->delete(route('stock-control.destroy', $stockControl));

        $response->assertRedirect(route('stockControl.index'));

        $this->assertDeleted($stockControl);
    }
}
