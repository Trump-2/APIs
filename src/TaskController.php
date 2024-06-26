<?php

class TaskController
{
  public function __construct(private TaskGateway $gateway)
  {
  }

  public function processRequest(string $method, ?string $id): void
  {
    if ($id === null) {

      // 注意這裡所有的 request method 值都必須是大寫
      // 集合資源
      if ($method == 'GET') {

        echo "index";
      } elseif ($method == 'POST') {

        echo "create";
      } else {
        $this->respondMethodNotAllowed("GET, POST");
      }
    } else {
      // 單一資源
      switch ($method) {
        case "GET":
          echo "show $id";
          break;
        case "PATCH":
          echo "update $id";
          break;
        case "DELETE":
          echo "delete $id";
          break;
        default:
          $this->respondMethodNotAllowed("GET, PATCH, DELETE");
      }
    }
  }

  private function respondMethodNotAllowed(string $allowed_methods): void
  {
    // 對此資源不允許的 request method 添加適當的 status code 和「Allow」header
    http_response_code(405);
    header("Allow:$allowed_methods");
  }
}
