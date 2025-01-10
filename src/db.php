<?php

require_once __DIR__ . "/config/env.php";

/**
 * Establishes a connection to the database.
 * @return PDO|false A PDO instance if successfully connected, false otherwise.
 */
function connectDB()
{
  $db_host = getenv("DB_HOST");
  $db_name = getenv("DB_NAME");
  $db_user = getenv("DB_USER");
  $db_pass = getenv("DB_PASS");

  try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  } catch (PDOException $e) {
    return false;
  }
}
