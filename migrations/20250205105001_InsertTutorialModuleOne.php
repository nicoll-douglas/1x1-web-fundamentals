<?php

declare(strict_types=1);

class InsertTutorialModuleOne
{
  private \PDO $pdo;

  public function __construct(\PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function up()
  {
    $sql = 'INSERT INTO tutorial_modules (number, name) 
    VALUES (1, "The Web")';
    $this->pdo->exec($sql);
    echo "Inserted first tutorial module.\n";
  }

  public function down()
  {
    $sql = 'DELETE FROM tutorial_modules WHERE name = "The Web" AND number = 1';
    $this->pdo->exec($sql);
    echo "Deleted first tutorial module.\n";
  }
}
