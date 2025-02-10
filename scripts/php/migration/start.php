<?php

declare(strict_types=1);

require_once __DIR__ . "/../../helpers/connectDb.php";
require_once __DIR__ . "/../../helpers/migrationsDir.php";
require_once __DIR__ . "/../../helpers/getMigrationClassName.php";
require_once __DIR__ . "/../../../config/env.php";

if (!isset($pdo)) {
  $pdo = connectDb(false);
} else {
  $dbName = getenv("DB_NAME");
  $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbName");
  $pdo->exec("USE $dbName");
}

$sql = "CREATE TABLE IF NOT EXISTS migrations (
id INT PRIMARY KEY AUTO_INCREMENT,
migration VARCHAR(255) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$pdo->exec($sql);

echo "Getting applied migrations...\n";
$stmt = $pdo->query("SELECT migration FROM migrations");
$appliedMigrations = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo "Getting unapplied migrations...\n";
$migrationFiles = scandir($migrationsDir);
$newMigrations = array_diff($migrationFiles, ['.', '..']);
$newMigrations = array_filter($newMigrations, function ($file) use ($appliedMigrations) {
  return !in_array($file, $appliedMigrations);
});

echo "Running new migrations...\n";
$count = 0;
foreach ($newMigrations as $migrationFile) {
  $filePath = $migrationsDir . DIRECTORY_SEPARATOR . $migrationFile;

  $className = getMigrationClassName($filePath);

  require_once $filePath;
  $migration = new $className($pdo);

  $migration->up();

  $stmt = $pdo->prepare("INSERT INTO migrations (migration) VALUES (?)");
  $stmt->execute([$migrationFile]);

  $count++;
}

echo "Applied $count new migrations.\n";
echo "All necessary migrations applied successfully.\n";
