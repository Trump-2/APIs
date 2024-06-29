<?php

class ErrorHandler
{
  public static function handleError(int $errno, string $errstr, string $errfile, int $errline): void
  {
    // 傳入的參數要去看該 class 的文件說明
    // 其中第二個參數文件的示範中指定為 0
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
  }


  // 參數為內建的 Throwable class 的物件，該 class 有很多內建的方法可以用來自訂輸出的內容
  public static function handleException(Throwable $exception): void
  {
    http_response_code(500);

    // 將產生的 exception 內容格式化為 JSON 格式 ( 預設是用 html tag 來格式化 )
    echo json_encode([
      "code" => $exception->getCode(),
      "message" => $exception->getMessage(),
      "file" => $exception->getFile(),
      "line" => $exception->getLine()
    ]);
  }
}
