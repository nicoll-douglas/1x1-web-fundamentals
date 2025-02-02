<?php

declare(strict_types=1);

namespace App\Classes;

/**
 * Database handler class.
 */
class Dbh
{
  private string $dbHost;
  private string $dbName;
  private string $dbUser;
  private string $dbPass;

  /**
   * Loads database environment variables into the class.
   */
  protected function __construct()
  {
    $this->dbHost = getenv("DB_HOST");
    $this->dbName = getenv("DB_NAME");
    $this->dbUser = getenv("DB_USER");
    $this->dbPass = getenv("DB_PASS");
  }

  /**
   * Establishes a connection to the database.
   * @return \PDO A PDO instance if successfully connected.
   * @throws \PDOException If the function failed to connect to the database.
   */
  public function connectDB(): \PDO
  {
    $pdo = new \PDO(
      "mysql:host=$this->dbHost;dbname=$this->dbName",
      $this->dbUser,
      $this->dbPass
    );
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    return $pdo;
  }
}
