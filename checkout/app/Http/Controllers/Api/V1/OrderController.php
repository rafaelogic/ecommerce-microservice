<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\SendCheckoutEmail;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(OrderRequest $request)
    {
        $order = Order::create($request->validated());

        $response = SendCheckoutEmail::execute($order);

        if ($response->failed()) {
            return response()->json([
                'status' => 'failed',
                'error' => 'Unable to send order notification'
            ], 500);
        }
        
        return response()->json([
            'order' => new OrderResource($order),
            'messasge' => 'Successfully placed the order'
        ], 201);
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }
}
