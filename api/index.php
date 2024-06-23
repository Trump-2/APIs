<?php

// 取得 URL，且根據我們需要的刪除其中的 query string
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$parts = explode("/", $path);

// print_r($parts);

$resource = $parts[2];

$id = $parts[3] ?? null;

echo $resource, ', ', $id;

echo $_SERVER['REQUEST_METHOD'];
