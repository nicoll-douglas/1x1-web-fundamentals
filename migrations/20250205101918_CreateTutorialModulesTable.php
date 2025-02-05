<?php

declare(strict_types=1);

class CreateTutorialModulesTable
{
  private \PDO $pdo;

  public function __construct(\PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function up()
  {
    $sql = "CREATE TABLE IF NOT EXISTS tutorial_modules (
    number INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
    )";
    $this->pdo->exec($sql);
    echo "Created tutorial_modules table.\n";
  }

  public function down()
  {
    $sql = "DROP TABLE IF EXISTS tutorial_modules";
    $this->pdo->exec($sql);
    echo "Dropped tutorial_modules table.\n";
  }
}
