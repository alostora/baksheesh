<?php

namespace Guest\Foundations;

use Illuminate\Support\Facades\Http;

class PaymentCollection
{
    public static function pay($amount, $url)
    {

        return Http::withHeaders([
            'Authorization' =>  'SHJNLTWBRR-JHWJZ6BKJ2-6BDNRL29TZ',
            'Content-Type' => 'application/json'
        ])->post('https://secure.clickpay.com.sa/payment/request', [

            'profile_id' => '44638',
            'tran_type' => 'sale',
            'tran_class' => 'ecom',
            'cart_id' => '4244b9fd-c7e9-4f16-8d3c-4fe7bf6c48ca',
            'cart_description' => 'New Order',
            'cart_currency' => 'SAR',
            'cart_amount' => $amount,
            'callback' => $url,
            'return' => $url,
        ])->object();
    }

    public static function checkPayStatus($tran_ref)
    {

        return Http::withHeaders([
            'Authorization' =>  'SHJNLTWBRR-JHWJZ6BKJ2-6BDNRL29TZ',
            'Content-Type' => 'application/json'
        ])->post('https://secure.clickpay.com.sa/payment/query', [
            'profile_id' => '44638',
            'tran_ref' => $tran_ref,
        ])->object();
    }
}
