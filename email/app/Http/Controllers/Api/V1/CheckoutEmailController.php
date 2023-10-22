<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Mail\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckoutEmailController extends Controller
{
    public function send(Request $request)
    {
        $order = $request->input('order');
        $email = $order['user']['email'];

        Mail::to($email)->send(new OrderPlaced($order));

        return response()->json(['message' => 'Email sent successfully']);
    }
}
