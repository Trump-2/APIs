<?php

class TaskController
{
  // 這個參數的語法代表將 TaskGateway class 的物件指派給這個 class 的 $gateway 屬性 ( 它會自動幫我創造該屬性，而不需手動宣告 )
  public function __construct(private TaskGateway $gateway)
  {
  }

  public function processRequest(string $method, ?string $id): void
  {
    if ($id === null) {

      // 注意這裡所有的 request method 值都必須是大寫
      // 集合資源
      if ($method == 'GET') {

        // 取得 task 資料表內所有的紀錄，作為 API 的一部分輸出；格式化為 JSON 格式
        echo json_encode($this->gateway->getAll());
      } elseif ($method == 'POST') {


        // 把 JSON 資料轉換成關聯陣列
        // 利用「類型轉換」將回傳值轉成 array，確保原始回傳值為 null 時，還是會得到 array
        $data = (array) json_decode(file_get_contents("php://input"), true);
        // var_dump($data);

        $id = $this->gateway->create($data);

        $this->respondCreated($id);
      } else {
        $this->respondMethodNotAllowed("GET, POST");
      }
    } else {

      $task = $this->gateway->get($id);
      if ($task === false) {

        $this->respondNotFound($id);
        return;
      }

      // 單一資源
      switch ($method) {
        case "GET":
          echo json_encode($task);
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

  private function respondNotFound(string $id): void
  {
    http_response_code(404);
    // 這行可有可無，如果有會更好
    echo json_encode(['message' => "Task with ID $id not found"]);
  }

  private function respondCreated(string $id): void
  {
    http_response_code(201);
    echo json_encode(['message' => "Task created", "id" => $id]);
  }
}
