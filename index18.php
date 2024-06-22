<?php
require "API_keys.php";
// 引入 Guzzle 中各種 class 來做使用
require __DIR__ . "/vendor/autoload.php";

// 產生 Client 物件
$client = new GuzzleHttp\Client;

// 對 endpoint 發出請求
$response = $client->request('GET', 'https://api.github.com/user/repos', [
  'headers' => [
    "Authorization" => "token $github",
    "User-Agent" => "Trump-2"
  ]
]);

// 取得 response 的 status code
echo $response->getStatusCode() . "\n";
// 取得 response 的所有 headers 或某個指令 header
echo $response->getHeader('content-type')[0] . "\n";
// 取得 response 的 body
echo substr($response->getBody(), 0, 200) . "...\n";