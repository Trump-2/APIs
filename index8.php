<?php

require "API_keys.php";

$ch = curl_init();

$headers = [
  "Authorization: Client-ID $unsplash"
];

// 用來儲存每個獨立的 response header
$response_headers = [];

// 有 &（引用傳遞）：匿名函數會操作同一個 $response_headers 變量。對 $response_headers 的修改會直接影響外部的 $response_headers 變量。
// 無 &（值傳遞）：匿名函數會操作 $response_headers 的一個副本。對這個副本的修改不會影響外部的 $response_headers 變量。
// 必須透過【use ( &$response_headers )】的語法來將該陣列從 「父 scope」 傳進到函數中 ( 換句話說允許匿名函數在其作用域內使用並修改外部作用域的 $response_headers 變量 )，【&】代表【傳址】；
$header_callback = function ($curlhandle, $header) use (&$response_headers) {

  // 取得 header 的長度
  $len = strlen($header);

  // 變成 [ header 名稱, 它的值 ] 這樣的陣列
  $parts = explode(":", $header, 2);

  // 如果少於兩個部分 ( header 名稱和它的值 )，則代表此 header 是無效的
  if (count($parts) < 2) {
    return $len;
  }

  // 將 header 名稱作為 array 的 key，header 值作為元素值
  $response_headers[$parts[0]] = trim($parts[1]);


  // 官方文件中指出此 callback 必須回傳每個 header 的長度； 
  return $len;
};

// curl_setopt($ch, CURLOPT_URL, 'https://randomuser.me/api');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt_array($ch, [
  // CURLOPT_URL => "https://api.openweathermap.org/data/2.5/weather?lat=44.34&lon=10.99&appid={$openweathermap}",
  // CURLOPT_URL => "https://randomuser.me/api",
  CURLOPT_URL => "https://api.unsplash.com/photos/random",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => $headers,
  // CURLOPT_HEADER => true
  // 讓每個 header 都呼叫此 callback
  CURLOPT_HEADERFUNCTION => $header_callback
]);

$response = curl_exec($ch);

$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// $content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

// $content_length = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

curl_close($ch);

echo $status_code, "\n";
// echo $content_type, "\n";
// echo $content_length, "\n";

print_r($response_headers);

echo $response;