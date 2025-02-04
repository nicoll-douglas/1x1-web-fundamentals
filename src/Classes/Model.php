<?php

declare(strict_types=1);

namespace App\Classes;

use App\Classes\Dbh;
use App\Exceptions\NonEmptyException;

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

  /**
   * Checks whether a class field is empty.
   * @param mixed $field The class field.
   * @param string $name The class field's name.
   * @throws NonEmptyException If it is
   */
  protected function checkForEmpty(mixed $field, string $name)
  {
    if (empty($field)) {
      throw new NonEmptyException($name);
    }
  }
}
