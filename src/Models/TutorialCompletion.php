<?php

declare(strict_types=1);

namespace App\Models;

use App\Classes\Model;
use App\Exceptions\NonEmptyException;

/**
 * Model to interface with tutorial_completions table.
 */
class TutorialCompletion extends Model
{
  private string $userId;
  private int $tutorialNumber;
  private int $moduleNumber;

  /**
   * Initialises the database connection and class fields.
   * @param string|null $useId The user ID for the tutorial completion.
   * @param string|null $tutorialNumber The tutorial's number for the tutorial completion.
   * @param string|null $moduleNumber The tutorial's module number for the tutorial completion.
   */
  public function __construct(
    ?string $userId = null,
    ?int $tutorialNumber = null,
    ?int $moduleNumber = null
  ) {
    parent::__construct();
    if ($userId) {
      $this->userId = $userId;
    }
    if ($tutorialNumber) {
      $this->tutorialNumber = $tutorialNumber;
    }
    if ($moduleNumber) {
      $this->moduleNumber = $moduleNumber;
    }
  }

  /**
   * Checks whether the current user ID is empty.
   * @throws NonEmptyException If the current user ID is empty.
   */
  private function checkForUserId()
  {
    if (empty($this->userId)) {
      throw new NonEmptyException('$userId');
    }
  }

  /**
   * Checks whether the current tutorial ID is empty.
   * @throws NonEmptyException If the current tutorial ID is empty.
   */
  private function checkForTutorialNumber()
  {
    if (empty($this->tutorialNumber)) {
      throw new NonEmptyException('$tutorialNumber');
    }
  }

  /**
   * Checks whether the current module number is empty.
   * @throws NonEmptyException If the current module number is empty.
   */
  private function checkForModuleNumber()
  {
    if (empty($this->moduleNumber)) {
      throw new NonEmptyException('$moduleNumber');
    }
  }

  /**
   * Checks whether the the current user ID, tutorial number or module number is empty.
   * @throws NonEmptyException If any of them is empty.
   */
  private function checkForAll()
  {
    $this->checkForUserId();
    $this->checkForTutorialNumber();
    $this->checkForModuleNumber();
  }

  public function setUserId(string $value)
  {
    if ($value) {
      $this->userId = $value;
    }
  }

  public function setTutorialNumber(int $value)
  {
    $this->tutorialNumber = $value;
  }

  public function setModuleNumber(int $value)
  {
    $this->moduleNumber = $value;
  }

  /**
   * Inserts a tutorial completion into the tutorial_completions table.
   * @throws NonEmptyException If any of the current user ID, tutorial number or module number is empty.
   * @return bool True if a row was inserted, false otherwise.
   */
  public function insert(): bool
  {
    $this->checkForAll();
    try {
      $stmt = $this->pdo->prepare(
        "INSERT IGNORE INTO tutorial_completions (tutorial_number, module_number, user_id) VALUES (:tut_num, :mod_num, $this->userId)"
      );
      $stmt->bindValue(":tut_num", $this->tutorialNumber, \PDO::PARAM_INT);
      $stmt->bindValue(":mod_num", $this->moduleNumber, \PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->rowCount() > 0;
    } catch (\PDOException $e) {
      return false;
    }
  }

  /**
   * Deletes a tutorial completion from the tutorial_completions table.
   * @throws NonEmptyException If any of the current user id, tutorial number or module number is empty.
   * @return bool True if the row was were deleted, false otherwise.
   */
  public function delete(): bool
  {
    $this->checkForAll();
    $stmt = $this->pdo->prepare(
      "DELETE FROM tutorial_completions WHERE user_id = $this->userId AND tutorial_number = :tut_num AND module_number = :mod_num"
    );
    $stmt->bindParam(":tut_num", $this->tutorialNumber, \PDO::PARAM_INT);
    $stmt->bindParam(":mod_num", $this->moduleNumber, \PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->rowCount() > 0;
  }

  /**
   * Checks for a tutorial completion.
   * @throws NonEmptyException If any of the current user ID, tutorial number or module number is empty.
   * @return bool False on failure or if a row is not found, true otherwise.
   */
  public function find(): bool
  {
    $this->checkForAll();
    $stmt = $this->pdo->prepare(
      "SELECT * FROM tutorial_completions WHERE user_id = $this->userId AND tutorial_number = :tut_num AND module_number = :mod_num"
    );
    $stmt->bindParam(":tut_num", $this->tutorialNumber, \PDO::PARAM_INT);
    $stmt->bindParam(":mod_num", $this->moduleNumber, \PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch();
    return !!$row;
  }

  /**
   * Retrives a tutorial completion index for a user.
   * @throws NonEmptyException If the current user id trying to be used is empty.
   * @return array<array{
   *  module_name: string,
   *  module_number: int,
   *  tutorial_name: string,
   *  tutorial_href: string,
   *  tutorial_number: int,
   *  is_completed: 1|0
   * }>|false false on failure, the rows from the query otherwise.
   */
  public function getIndex(): array
  {
    $this->checkForUserId();
    $sql = "
SELECT 
    tm.name AS module_name, 
    tm.number AS module_number,
    t.name AS tutorial_name, 
    t.href AS tutorial_href, 
    t.number AS tutorial_number, 
    CASE 
        WHEN tc.user_id IS NOT NULL THEN 1 
        ELSE 0 
    END AS is_completed
FROM 
    tutorial_modules tm
LEFT JOIN 
    tutorials t 
ON 
    tm.number = t.module_number
LEFT JOIN 
    tutorial_completions tc 
ON 
    t.number = tc.tutorial_number
    AND t.module_number = tc.module_number
    AND tc.user_id = :user_id
ORDER BY 
    tm.number, t.number";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(":user_id", $this->userId);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
}
