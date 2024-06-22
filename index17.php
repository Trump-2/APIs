<?php

$ch = curl_init();

$headers = [
  "User-Agent:Trump-2"
];


curl_setopt_array($ch, [
  // Github API
  CURLOPT_URL => "https://api.github.com/gists/7b55442e2ce9ff89172c578e9c9720ad",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => $headers,
]);

$response = curl_exec($ch);


curl_close($ch);

$data = json_decode($response, true);

// 用在單一資源的資料顯示
print_r($data);

// 用在集合體資源的資料顯示
// foreach ($data as $gist) {
//   echo $gist['id'] . ' - ' . $gist['description'], "\n";
// }