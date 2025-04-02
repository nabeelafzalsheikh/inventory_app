<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProductController
 */
final class ProductControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get(route('products.index'));

        $response->assertOk();
        $response->assertViewIs('product.index');
        $response->assertViewHas('products');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('products.create'));

        $response->assertOk();
        $response->assertViewIs('product.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'store',
            \App\Http\Requests\ProductStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $product_name = fake()->word();
        $category_id = fake()->randomNumber();
        $sku = fake()->word();
        $price = fake()->randomFloat(/** decimal_attributes **/);
        $brand_id = fake()->randomNumber();
        $pieces = fake()->numberBetween(-10000, 10000);
        $status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('products.store'), [
            'product_name' => $product_name,
            'category_id' => $category_id,
            'sku' => $sku,
            'price' => $price,
            'brand_id' => $brand_id,
            'pieces' => $pieces,
            'status' => $status,
        ]);

        $products = Product::query()
            ->where('product_name', $product_name)
            ->where('category_id', $category_id)
            ->where('sku', $sku)
            ->where('price', $price)
            ->where('brand_id', $brand_id)
            ->where('pieces', $pieces)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $products);
        $product = $products->first();

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('product.id', $product->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.show', $product));

        $response->assertOk();
        $response->assertViewIs('product.show');
        $response->assertViewHas('product');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.edit', $product));

        $response->assertOk();
        $response->assertViewIs('product.edit');
        $response->assertViewHas('product');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'update',
            \App\Http\Requests\ProductUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $product = Product::factory()->create();
        $product_name = fake()->word();
        $category_id = fake()->randomNumber();
        $sku = fake()->word();
        $price = fake()->randomFloat(/** decimal_attributes **/);
        $brand_id = fake()->randomNumber();
        $pieces = fake()->numberBetween(-10000, 10000);
        $status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('products.update', $product), [
            'product_name' => $product_name,
            'category_id' => $category_id,
            'sku' => $sku,
            'price' => $price,
            'brand_id' => $brand_id,
            'pieces' => $pieces,
            'status' => $status,
        ]);

        $product->refresh();

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('product.id', $product->id);

        $this->assertEquals($product_name, $product->product_name);
        $this->assertEquals($category_id, $product->category_id);
        $this->assertEquals($sku, $product->sku);
        $this->assertEquals($price, $product->price);
        $this->assertEquals($brand_id, $product->brand_id);
        $this->assertEquals($pieces, $product->pieces);
        $this->assertEquals($status, $product->status);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('products.destroy', $product));

        $response->assertRedirect(route('products.index'));

        $this->assertModelMissing($product);
    }
}
