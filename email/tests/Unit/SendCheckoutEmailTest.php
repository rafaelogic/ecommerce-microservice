<?php

namespace Tests\Unit;

use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendCheckoutEmailTest extends TestCase
{
    public function test_can_send_checkout_email()
    {
        Mail::fake();

        Mail::assertNothingSent();

        $order = [
            'product_id' => 1,
            'status' => 'open',
            'user' => [
                'email' => 'user@test.com'
            ]
        ];

        $this->postJson(route('send.checkout-email', ['order' => $order]));

        Mail::assertSent(OrderPlaced::class, function ($mail) use ($order) {
            return $mail->hasTo($order['user']['email']) && $mail->order['product_id'] == $order['product_id'];
        });
    }
}
