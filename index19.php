<?php
require "API_keys.php";



$data = [
  'name' => 'Brad',
  'email' => 'brad@example.com'
];

// 透過 SDK 的方式來創造 customer
require __DIR__ . "/vendor/autoload.php";

// 創造 StripeClient 物件，並傳入 API key
$stripe = new \Stripe\StripeClient($for_stripe);

// 創造新的 customer，並回傳該 customer 物件
$customer = $stripe->customers->create($data);

echo $customer;


// 透過 cURL 的方式來創造 customer
/*
$ch = curl_init();

curl_setopt_array(
  $ch,
  [
    CURLOPT_URL => 'https://api.stripe.com/v1/customers',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERPWD => $for_stripe,
    CURLOPT_POSTFIELDS => http_build_query($data)
  ]
);

$response = curl_exec($ch);

curl_close($ch);

echo $response;
*/