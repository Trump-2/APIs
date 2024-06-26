<?php

class TaskGateway
{
  private PDO $conn;
  public function __construct(Database $database)
  {
    $this->conn = $database->getConnection();
  }

  public function getAll()
  {
    $sql = "SELECT *
            FROM task
            ORDER BY name";

    $stmt = $this->conn->query($sql);

    $data = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

      // 這個語法，代表將這個陣列元素的值轉換成 php 中的 boolean 類型
      $row['is_completed'] = (bool) $row['is_completed'];
      // 這個寫法是代表在 $data 陣列的結尾處添加一個元素，重要
      $data[] = $row;
    }

    return $data;

    // return $stmt->fetchAll(PDO::FETCH_ASSOC);

  }

  public function get(string $id): array|false
  {
    $sql = "SELECT *
            FROM task
            WHERE id = :id";

    $stmt = $this->conn->prepare($sql);

    $stmt->bindValue(":id", $id, PDO::PARAM_INT);

    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data != false) {
      $data['is_completed'] = (bool) $data['is_completed'];
    }

    return $data;
  }
}
