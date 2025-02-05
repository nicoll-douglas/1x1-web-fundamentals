<?php

declare(strict_types=1);

require_once __DIR__ . "/../helpers/connectDb.php";
require_once __DIR__ .  "/../helpers/migrationsDir.php";
require_once __DIR__ . "/../helpers/getMigrationClassName.php";

$pdo = connectDb();

echo "Getting previous migration...\n";
$stmt = $pdo->query("SELECT migration FROM migrations ORDER BY id DESC LIMIT 1");
$lastMigration = $stmt->fetchColumn();

if (!$lastMigration) {
  echo "No migrations to rollback.\n";
  exit;
}


$filePath = $migrationsDir . DIRECTORY_SEPARATOR . $lastMigration;
$className = getMigrationClassName($filePath);
require_once $filePath;
$migration = new $className($pdo);

echo "Rolling back previous migration...\n";
$migration->down();
$stmt = $pdo->prepare("DELETE FROM migrations WHERE migration = ?");
$stmt->execute([$lastMigration]);

echo "Rolled back migration: $lastMigration\n";
