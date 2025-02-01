<?php

declare(strict_types=1);

namespace App\Models;

use App\Classes\Model;
use App\Exceptions\NonEmptyException;

/**
 * Model that interfaces with the tutorials table.
 */
class Tutorial extends Model
{
  private int $number;
  private int $moduleNumber;

  public function __construct(
    ?int $number = null,
    ?int $moduleNumber = null
  ) {
    parent::__construct();
    if ($number) {
      $this->number = $number;
    }
    if ($moduleNumber) {
      $this->moduleNumber = $moduleNumber;
    }
  }

  /**
   * Gets the tutorial from the tutorials table.
   * @return array|false The tutorial's row on success, false otherwise.
   */
  public function get(): array|false
  {
    $this->checkForAll();
    $sql = "SELECT * FROM tutorials WHERE module_number = :mod_num AND number = :tut_num";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":mod_num", $this->moduleNumber, \PDO::PARAM_INT);
    $stmt->bindValue(":tut_num", $this->number, \PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
  }

  /**
   * Gets the href for the next tutorial in the current module.
   * @throws NonEmptyException If the current module number or tutorial number is empty.
   * @return string|false False on failure, the href otherwise.
   */
  public function getNextHref(): string|false
  {
    return $this->getAdjacentHref(1);
  }

  /**
   * Gets the href for the previous tutorial in the current module.
   * @throws NonEmptyException If the current module number or tutorial number is empty.
   * @return string|false False on failure, the href otherwise.
   */
  public function getPrevHref(): string|false
  {
    return $this->getAdjacentHref(-1);
  }

  /**
   * Gets the href column value of an adjacent tutorial in the current module.
   * @param int $offset The offset, e.g 1 for the next row, -1 for the previous (recommended values).
   * @throws NonEmptyException If the current module number or tutorial number is empty.
   * @return string|false False of failure, the href otherwise
   */
  private function getAdjacentHref(int $offset)
  {
    $this->checkForAll();
    $sql = "SELECT href FROM tutorials WHERE module_number = :mod_num AND number = :tut_num";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":mod_num", $this->moduleNumber, \PDO::PARAM_INT);
    $stmt->bindValue(":tut_num", $this->number + $offset, \PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch();
    if ($row === false) return false;
    return $row["href"];
  }


  public function setNumber(int $value)
  {
    $this->number = $value;
  }

  public function setModuleNumber(int $value)
  {
    $this->moduleNumber = $value;
  }

  /**
   * Checks whether the current tutorial number is empty.
   * @throws NonEmptyException If it is empty.
   */
  private function checkForNumber()
  {
    if (empty($this->number)) {
      throw new NonEmptyException('$number');
    }
  }

  /**
   * Checks whether the current module number is empty.
   * @throws NonEmptyException If it is empty.
   */
  private function checkForModuleNumber()
  {
    if (empty($this->moduleNumber)) {
      throw new NonEmptyException('$moduleNumber');
    }
  }
  /**
   * Checks if either the current tutorial number or module number is empty.
   * @throws NonEmptyException If any of them are empty.
   */
  private function checkForAll()
  {
    $this->checkForNumber();
    $this->checkForModuleNumber();
  }

  /**
   * Retrieves a tutorial index.
   * @return array<array{
   *  module_name: string,
   *  module_number: int,
   *  tutorial_name: string,
   *  tutorial_href: string,
   *  tutorial_number: int,
   * }>|false False on failure, the rows from the query otherwise.
   */
  public function getIndex(): array
  {
    $sql = "
SELECT
  tm.name AS module_name,
  tm.number AS module_number,
  t.name AS tutorial_name,
  t.href AS tutorial_href,
  t.number AS tutorial_number
FROM
  tutorial_modules tm
LEFT JOIN
  tutorials t
ON
  tm.number = t.module_number
ORDER BY
  tm.number, t.number";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
}
