<?php

require_once __DIR__ . "/config/env.php";

/**
 * Establishes a connection to the database.
 * @return PDO A PDO instance if successfully connected, false otherwise.
 * @throws PDOException If the function failed to connect to the database.
 */
function connectDB(): PDO
{
  $db_host = getenv("DB_HOST");
  $db_name = getenv("DB_NAME");
  $db_user = getenv("DB_USER");
  $db_pass = getenv("DB_PASS");

  $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $pdo;
}
