<?php

declare(strict_types=1);

class CreateTutorialsTable
{
  private \PDO $pdo;

  public function __construct(\PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function up()
  {
    $sql = "CREATE TABLE IF NOT EXISTS tutorials (
    number INT,
    href VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    module_number INT,
    PRIMARY KEY(number, module_number),
    FOREIGN KEY(module_number) REFERENCES tutorial_modules(number) ON DELETE CASCADE
    )";
    $this->pdo->exec($sql);
    echo "Created tutorials table.\n";
  }

  public function down()
  {
    $sql = "DROP TABLE IF EXISTS tutorials";
    $this->pdo->exec($sql);
    echo "Dropped tutorials table.\n";
  }
}
