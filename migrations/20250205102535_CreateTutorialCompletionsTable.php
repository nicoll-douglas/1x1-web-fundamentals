<?php

declare(strict_types=1);

class CreateTutorialCompletionsTable
{
  private \PDO $pdo;

  public function __construct(\PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function up()
  {
    $sql = "CREATE TABLE IF NOT EXISTS tutorial_completions (
    tutorial_number INT,
    module_number INT,
    user_id VARCHAR(255),
    PRIMARY KEY(tutorial_number, module_number, user_id),
    FOREIGN KEY(tutorial_number) REFERENCES tutorials(number) ON DELETE CASCADE,
    FOREIGN KEY(module_number) REFERENCES tutorial_modules(number) ON DELETE CASCADE,
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    $this->pdo->exec($sql);
    echo "Created tutorial_completions table.\n";
  }

  public function down()
  {
    $sql = "DROP TABLE IF EXISTS tutorial_completions";
    $this->pdo->exec($sql);
    echo "Dropped tutorial_completions table.\n";
  }
}
