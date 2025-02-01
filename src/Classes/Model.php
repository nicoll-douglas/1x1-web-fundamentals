<?php

declare(strict_types=1);

namespace App\Classes;

use App\Classes\Dbh;

/**
 * Base model class that extends the database handler class.
 */
abstract class Model extends Dbh
{
  protected \PDO $pdo;

  /**
   * Initialises the $pdo property to a database connection.
   * @throws PDOException If the database connection failed.
   */
  public function __construct()
  {
    parent::__construct();
    $this->pdo = $this->connectDB();
  }
}
