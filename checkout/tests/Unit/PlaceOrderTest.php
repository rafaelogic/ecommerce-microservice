<?php

namespace Tests\Unit;

use App\Enums\OrderStatusEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class PlaceOrderTest extends TestCase
{
    use RefreshDatabase; 

    public function test_can_place_order()
    {
        Http::fake();

        $orderStatus = OrderStatusEnum::OPEN;

        $user = User::factory()->create();

        $data = [
            'product_id' => 1,
            'user_id' => $user->id,
            'status' => $orderStatus
        ];

        // Use the user to place an order
        $response = $this->postJson(route('place.order', $data));

        // Assert the order was successfully created
        $response->assertStatus(Response::HTTP_CREATED); 
        $this->assertDatabaseHas('orders', $data);
    }

    public function test_order_validation()
    {
        Http::fake();

        $data = [
            'product_id' => '',
            'user_id' => 99999,
            'status' => 'Test'
        ];

        // Try to place an order with invalid data
        $response = $this->postJson(route('place.order', $data));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['product_id', 'user_id', 'status']);
    }
}
