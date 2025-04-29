<?php

declare(strict_types=1);

require_once __DIR__ . "/../../config/env.php";

/**
 * Connects to the database host.
 * @return \PDO The database connection.
 */
function connectDb(): \PDO
{
  echo "Connecting to database...\n";

  $dbHost = getenv("MYSQL_HOST");
  $dbName = getenv("MYSQL_DATABASE");
  $dbUser = getenv("MYSQL_USER");
  $dbPass = getenv("MYSQL_PASSWORD");

  try {
    $pdo = new \PDO(
      "mysql:host=$dbHost;dbname=$dbName",
      $dbUser,
      $dbPass
    );
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    echo "Successfully connected to database.\n";
    return $pdo;
  } catch (\PDOException $e) {
    $msg = $e->getMessage();
    die("Failed to connect to database: $msg\n");
  }
}
