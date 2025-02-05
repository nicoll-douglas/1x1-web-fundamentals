<?php

declare(strict_types=1);

class CreateMessagesTable
{
  private \PDO $pdo;

  public function __construct(\PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function up()
  {
    $sql = "CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $this->pdo->exec($sql);
    echo "Created messages table.\n";
  }

  public function down()
  {
    $sql = "DROP TABLE IF EXISTS messages";
    $this->pdo->exec($sql);
    echo "Dropped messages table.\n";
  }
}
