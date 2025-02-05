<?php

declare(strict_types=1);

class ImportTutorialModulesSeeder
{
  private \PDO $pdo;

  public function __construct(\PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function importFromJson($filePath)
  {
    $modules = json_decode(file_get_contents($filePath), true);

    $sql = "INSERT IGNORE INTO tutorial_modules (number, name) 
    VALUES (:num, :name)";

    $stmt = $this->pdo->prepare($sql);

    foreach ($modules as $module) {
      $stmt->bindParam(":num", $module["number"], \PDO::PARAM_INT);
      $stmt->bindParam(":name", $module["name"]);
      $stmt->execute();
    }

    echo "Tutorial modules imported successfully from $filePath.\n";
  }
}
