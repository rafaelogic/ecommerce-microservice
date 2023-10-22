<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_products()
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->getJson(route('products'));

        $response
            ->assertStatus(200)
            ->assertJsonCount(3);
            
        foreach ($products as $product) {
            $response->assertSee($product->name);
        }
    }

    public function test_can_get_product()
    {
        $product = Product::factory()->create();

        $response = $this->getJson(route('product', $product));

        $response
            ->assertStatus(200)
            ->assertJsonFragment(
                $product
                    ->makeHidden(['created_at', 'updated_at'])
                    ->toArray()
            );
    }
}
