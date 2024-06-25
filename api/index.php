<?php

// 搭配 「type declarations」；啟用 「strict type checking」
declare(strict_types=1);

require dirname(__DIR__) . "/vendor/autoload.php";

// 設定通用的 exception handler
set_exception_handler("ErrorHandler::handleException");

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// 取得 URL，且根據我們需要的刪除其中的 query string
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$parts = explode("/", $path);

// print_r($parts);

$resource = $parts[2];

$id = $parts[3] ?? null;

// echo $resource, ', ', $id;

// echo $_SERVER['REQUEST_METHOD'], "\n";

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

// 設定 response 的 「content-type」 header 的內容
header("content-type:application/json; charset:UTF-8");

// $database = new Database("localhost", "api_db", "api_db_user", "1234");
$database = new Database($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_PORT']);


$controller = new TaskController;

$controller->processRequest($_SERVER['REQUEST_METHOD'], $id);
