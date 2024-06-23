<?php

class TaskController
{
  public function processRequest($method, $id)
  {
    if ($id === null) {

      // 注意這裡所有的 request method 值都必須是大寫
      // 集合資源
      if ($method == 'GET') {

        echo "index";
      } elseif ($method == 'POST') {

        echo "create";
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
      }
    }
  }
}
