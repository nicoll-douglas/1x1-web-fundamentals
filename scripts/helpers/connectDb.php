<?php

declare(strict_types=1);

require_once __DIR__ . "/../../config/env.php";

/**
 * Connects to the database host.
 * @param bool $useName True to connect to the specific database, false otherwise.
 * @return \PDO The database connection.
 */
function connectDb(bool $useName = true): \PDO
{
  echo "Connecting to database...\n";

  $dbHost = getenv("DB_HOST");
  $dbName = getenv("DB_NAME");
  $dbUser = getenv("DB_USER");
  $dbPass = getenv("DB_PASS");
  $socket = '/var/run/mysqld/mysqld.sock';

  try {
    $pdo = new \PDO(
      "mysql:host=$dbHost;unix_socket=$socket" . ($useName ? ";dbname=$dbName" : ""),
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
