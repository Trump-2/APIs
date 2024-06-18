<?php
$ch = curl_init();

$headers = [
  "Authorization: token YOUR_TOKEN",
  // "User-Agent:Trump-2"
];


curl_setopt_array($ch, [
  // Github API
  CURLOPT_URL => "https://api.github.com/user/starred/httpie/httpie",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => $headers,
]);

$response = curl_exec($ch);

$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// $content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

// $content_length = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

curl_close($ch);

echo $status_code, "\n";
// echo $content_type, "\n";
// echo $content_length, "\n";


echo $response;
