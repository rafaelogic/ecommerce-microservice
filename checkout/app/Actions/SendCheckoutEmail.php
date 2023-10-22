<?php

namespace App\Actions;

use App\Models\Order;
use Exception;

class SendCheckoutEmail
{
    public static function execute(Order $order)
    {
        $url = config('microservice.email').'/checkout-email';
        $order = $order->load('owner');
        $data = ['order' => $order->toArray()];
        
        // try {
        //     $response = Http::post('http://localhost:8083/api/v1/checkout-email');
        
        // } catch (\Throwable $th) {
        //     throw $th;
        // }

        $url = 'http://localhost:8083/api/v1/checkout-email';
        $headers = [
            "Content-Type: application/json",
        ];
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if ($httpCode == 200) {
            return $response;
        } else {
            throw new Exception(json_encode([
                'code' => curl_error($ch),
                'error' => $response
            ]));
        }

        curl_close($ch);
    }
}