<?php

namespace Tests\Unit;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_can_get_product()
    {
        $order = Order::factory()->create();

        $response = $this->getJson(route('order', $order));

        $response
            ->assertStatus(200)
            ->assertJsonFragment(
                $order
                    ->makeHidden(['created_at', 'updated_at'])
                    ->toArray()
            );
    }
}
