<?php

class Database
{
  public function __construct(private string $host, private string $name, private string $user, private string $password, private string $port = "3306")
  {
  }

  public function getConnection(): PDO
  {
    $dsn = "mysql:host={$this->host};dbname={$this->name};charset=utf8;port={$this->port}";

    return new PDO($dsn, $this->user, $this->password, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_EMULATE_PREPARES => false, // 阻止從資料庫取得的值都變成字串
      PDO::ATTR_STRINGIFY_FETCHES => true // 阻止從資料庫取得的值都變成字串
    ]);
  }
}
