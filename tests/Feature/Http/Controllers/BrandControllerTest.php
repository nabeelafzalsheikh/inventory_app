<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BrandController
 */
final class BrandControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $brands = Brand::factory()->count(3)->create();

        $response = $this->get(route('brands.index'));

        $response->assertOk();
        $response->assertViewIs('brand.index');
        $response->assertViewHas('brands');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('brands.create'));

        $response->assertOk();
        $response->assertViewIs('brand.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BrandController::class,
            'store',
            \App\Http\Requests\BrandStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $brand_name = fake()->word();

        $response = $this->post(route('brands.store'), [
            'brand_name' => $brand_name,
        ]);

        $brands = Brand::query()
            ->where('brand_name', $brand_name)
            ->get();
        $this->assertCount(1, $brands);
        $brand = $brands->first();

        $response->assertRedirect(route('brands.index'));
        $response->assertSessionHas('brand.id', $brand->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $brand = Brand::factory()->create();

        $response = $this->get(route('brands.show', $brand));

        $response->assertOk();
        $response->assertViewIs('brand.show');
        $response->assertViewHas('brand');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $brand = Brand::factory()->create();

        $response = $this->get(route('brands.edit', $brand));

        $response->assertOk();
        $response->assertViewIs('brand.edit');
        $response->assertViewHas('brand');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BrandController::class,
            'update',
            \App\Http\Requests\BrandUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $brand = Brand::factory()->create();
        $brand_name = fake()->word();

        $response = $this->put(route('brands.update', $brand), [
            'brand_name' => $brand_name,
        ]);

        $brand->refresh();

        $response->assertRedirect(route('brands.index'));
        $response->assertSessionHas('brand.id', $brand->id);

        $this->assertEquals($brand_name, $brand->brand_name);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $brand = Brand::factory()->create();

        $response = $this->delete(route('brands.destroy', $brand));

        $response->assertRedirect(route('brands.index'));

        $this->assertModelMissing($brand);
    }
}
