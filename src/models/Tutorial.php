<?php

declare(strict_types=1);

require_once __DIR__ . "/../db.php";

/**
 * Model that represents tutorials.
 */
class Tutorial
{
  /**
   * @var int The tutorial's id
   */
  private int $id;
  /**
   * @var PDO The current database connection
   */
  private PDO $pdo;

  public function __construct(int $id, PDO $pdo)
  {
    $this->pdo = $pdo;
    $this->id = $id;
  }

  /**
   * Inserts the tutorial as completed into the tutorial_completions table for the user.
   * @param string $user_id The user's id.
   * @return bool True if the operation was successful, false otherwise.
   */
  public function markComplete(string $user_id): bool
  {
    $exists = $this->existsCompletion($user_id);
    if ($exists) return true;

    $stmt = $this->pdo->prepare(
      "INSERT INTO tutorial_completions (tutorial_id, user_id) VALUES (:tut_id, :user_id)"
    );
    $stmt->bindParam(":tut_id", $this->id, PDO::PARAM_INT);
    $stmt->bindParam("user_id", $user_id);

    try {
      $stmt->execute();
      return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
      return false;
    }
  }

  /**
   * Removes the completed tutorial from the tutorial_completions table for the user.
   * @param string $user_id The user's id.
   * @return bool True if the operation was successful, false otherwise.
   */
  public function markIncomplete(string $user_id): bool
  {
    $stmt = $this->pdo->prepare(
      "DELETE FROM tutorial_completions WHERE user_id = :user_id AND tutorial_id = :tut_id"
    );
    $stmt->bindParam(":tut_id", $this->id, PDO::PARAM_INT);
    $stmt->bindParam("user_id", $user_id);

    try {
      $stmt->execute();
      return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
      return false;
    }
  }

  /**
   * Checks whether the tutorial is completed for a user.
   * @param string $user_id The user's id.
   * @return bool True if an entry is in the tutorial_completions table, false otherwise.
   */
  private function existsCompletion(string $user_id): bool
  {
    $stmt = $this->pdo->prepare(
      "SELECT * FROM tutorial_completions WHERE user_id = :user_id AND tutorial_id = :tut_id"
    );
    $stmt->bindParam(":tut_id", $this->id, PDO::PARAM_INT);
    $stmt->bindParam("user_id", $user_id);
    $stmt->execute();
    return $stmt->rowCount() > 0;
  }

  /**
   * Retrieves and orders tutorial completions for a user along with tutorial information.
   * @param string $user_id The user's id.
   * @param PDO $pdo A pre-existing database connection.
   * @return array<array{
   *  module_name: string,
   *  module_number: int,
   *  tutorial_id: int,
   *  tutorial_name: string,
   *  tutorial_href: string,
   *  tutorial_number: int,
   *  is_completed: 1|0
   * }> The rows from the query.
   */
  public static function getAllCompletions(string $user_id, PDO $pdo): array
  {
    $sql = "
SELECT 
    tm.name AS module_name, 
    tm.number AS module_number, 
    t.id AS tutorial_id,
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
    tm.id = t.module_id
LEFT JOIN 
    tutorial_completions tc 
ON 
    t.id = tc.tutorial_id 
    AND tc.user_id = :user_id
ORDER BY 
    tm.number, t.number";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ":user_id" => $user_id
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Retrieves and orders tutorial information.
   * @param PDO $pdo A pre-existing database connection.
   * @return array<array{
   *  module_name: string,
   *  module_number: int,
   *  tutorial_id: int,
   *  tutorial_name: string,
   *  tutorial_href: string,
   *  tutorial_number: int,
   * }> The rows from the query.
   */
  public static function getAll(PDO $pdo): array
  {
    $sql = "
SELECT
  tm.name AS module_name,
  tm.number AS module_number,
  t.id AS tutorial_id,
  t.name AS tutorial_name,
  t.href AS tutorial_href,
  t.number AS tutorial_number
FROM
  tutorial_modules tm
LEFT JOIN
  tutorials t
ON
  tm.id = t.module_id
ORDER BY
  tm.number, t.number";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
