<?php

namespace Guest\Foundations;

use Illuminate\Support\Facades\Http;

class PaymentCollection
{
    public static function pay($request)
    {

        $response = Http::accept('application/json')
            ->withHeaders([
                'authorization' => 'SGJNLTWBDT-JHKZB6WG29-2NK2WHZZLN',
                'content-type' => 'application/json',
            ])->post('https://secure.clickpay.com.sa/payment/request', [

                'profile_id' => 44217,
                'tran_type' => 'sale',
                'tran_class' => 'ecom',
                'cart_description' => 'Dummy Order 4696563498614784',
                'cart_id' => '897961dd-d91e-45a9-ac9e-d1b34d49bad9',
                'cart_currency' => 'SAR',
                'cart_amount' => $request->amount,
                'return' => 'none',
                "callback" => "https://portal.tiposmart.com/",
                'payment_token' => $request->get('token'),

                "customer_details" => [
                    "name" => "John Smith",
                    "email" => "jsmith@gmail.com",
                    "street1" => "404, 11th st, void",
                    "city" => "Dubai",
                    "state" => "DU",
                    "country" => "AE",
                    "ip" => $request->ip()
                ]
            ]);

        $data = json_decode($response->body(), true);

        dd($data);
    }
}
