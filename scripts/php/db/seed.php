<?php

require_once __DIR__ . "/../../helpers/connectDb.php";
require_once __DIR__ . "/../../seeders/ImportTutorialsSeeder.php";
require_once __DIR__ . "/../../seeders/ImportTutorialModulesSeeder.php";

if (!isset($pdo)) {
  $pdo = connectDb();
}

$seeder = new ImportTutorialModulesSeeder($pdo);
$filePath = __DIR__ . "/../../../data/tutorial_modules.json";
$seeder->importFromJson($filePath);

$seeder = new ImportTutorialsSeeder($pdo);
$filePath = __DIR__ . "/../../../data/tutorials.json";
$seeder->importFromJson($filePath);
