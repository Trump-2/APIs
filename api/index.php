<?php

require dirname(__DIR__) . "/vendor/autoload.php";

// 取得 URL，且根據我們需要的刪除其中的 query string
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$parts = explode("/", $path);

// print_r($parts);

$resource = $parts[2];

$id = $parts[3] ?? null;

// echo $resource, ', ', $id;

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

// 引入 class 所在的檔案
// 用 dirname(__DIR__) 來取得目前檔案所在資料夾的父資料夾路徑，組合成絕對路徑；用絕對路徑請求檔案是最安全的；
// require dirname(__DIR__) . "/src/TaskController.php";

$controller = new TaskController;

$controller->processRequest($_SERVER['REQUEST_METHOD'], $id);
