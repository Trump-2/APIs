<?php

// 取得 URL，且根據我們需要的刪除其中的 query string
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$parts = explode("/", $path);

// print_r($parts);

$resource = $parts[2];

$id = $parts[3] ?? null;

echo $resource, ', ', $id;

echo $_SERVER['REQUEST_METHOD'], "\n";

// 如果不是我們想要請求的 URL，則回傳 404 status code
if ($resource != "tasks") {
  // 設定回傳 Http 版本、404 的 status code 和 reason phase；第一種方式
  // header("HTTP/1.1 404 Not Found!");
  // 和上面一樣
  // header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found!");

  // 第二種方式 ( 推薦 )
  http_response_code(404);
  exit;
}
