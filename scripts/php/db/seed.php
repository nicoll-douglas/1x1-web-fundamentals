<?php

require_once __DIR__ . "/../../../config/env.php";
require_once __DIR__ . "/../../helpers/connectDb.php";
require_once __DIR__ . "/../../seeders/ImportTutorialsSeeder.php";
require_once __DIR__ . "/../../seeders/ImportTutorialModulesSeeder.php";

if (!isset($pdo)) {
  $pdo = connectDb();
} else {
  $dbName = getenv("DB_NAME");
  $pdo->exec("USE $dbName");
}

$seeder = new ImportTutorialModulesSeeder($pdo);
$filePath = __DIR__ . "/../../../data/tutorial_modules.json";
$seeder->importFromJson($filePath);

$seeder = new ImportTutorialsSeeder($pdo);
$filePath = __DIR__ . "/../../../data/tutorials.json";
$seeder->importFromJson($filePath);
