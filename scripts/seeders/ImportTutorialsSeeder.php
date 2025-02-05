<?php

declare(strict_types=1);

class ImportTutorialsSeeder
{
  private \PDO $pdo;

  public function __construct(\PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function importFromJson($filePath)
  {
    $tutorials = json_decode(file_get_contents($filePath), true);

    $sql = "INSERT IGNORE INTO tutorials (number, name, href, module_number) 
    VALUES (:num, :name, :href, :mod_num)";

    $stmt = $this->pdo->prepare($sql);

    foreach ($tutorials as $tutorial) {
      $stmt->bindParam(":num", $tutorial["number"], \PDO::PARAM_INT);
      $stmt->bindParam(":name", $tutorial["name"]);
      $stmt->bindParam(":href", $tutorial["href"]);
      $stmt->bindParam(":mod_num", $tutorial["moduleNumber"], \PDO::PARAM_INT);
      $stmt->execute();
    }

    echo "Tutorials imported successfully from $filePath.\n";
  }
}
