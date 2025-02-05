<?php

declare(strict_types=1);

class CreateUsersTable
{
  private \PDO $pdo;

  public function __construct(\PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function up()
  {
    $sql = "CREATE TABLE IF NOT EXISTS users (
    id VARCHAR(255) NOT NULL PRIMARY KEY,
    refresh_token TEXT,
    name TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $this->pdo->exec($sql);
    echo "Created users table.\n";
  }

  public function down()
  {
    $sql = "DROP TABLE IF EXISTS users";
    $this->pdo->exec($sql);
    echo "Dropped users table.\n";
  }
}
