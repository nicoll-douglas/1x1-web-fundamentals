<?php

declare(strict_types=1);

require_once __DIR__ . "/../db.php";

class Tutorial
{
  private string $href;
  private PDO $pdo;

  public function __construct(string $href)
  {
    $this->pdo = connectDB();
    $this->href = $href;
  }

  public function markComplete(string $user_id): bool
  {
    $exists = $this->exists($user_id);
    if ($exists) return true;

    $stmt = $this->pdo->prepare(
      "INSERT INTO tutorial_completions (tutorial_href, user_id) VALUES (:href, :user_id)"
    );

    try {
      $stmt->execute([
        ":href" => $this->href,
        ":user_id" => $user_id
      ]);
      return true;
    } catch (PDOException $e) {
      return false;
    }
  }

  public function markIncomplete(string $user_id): bool
  {
    $exists = $this->exists($user_id);
    if (!$exists) return true;

    $stmt = $this->pdo->prepare(
      "DELETE FROM tutorial_completions WHERE user_id = :user_id AND tutorial_href = :href"
    );

    try {
      $stmt->execute([
        ":href" => $this->href,
        ":user_id" => $user_id
      ]);
      return true;
    } catch (PDOException $e) {
      return false;
    }
  }

  private function exists(string $user_id): bool
  {
    $stmt = $this->pdo->prepare(
      "SELECT * FROM tutorial_completions WHERE user_id = :user_id AND tutorial_href = :href"
    );
    $stmt->execute([
      ":user_id" => $user_id,
      ":href" => $this->href
    ]);
    return $stmt->rowCount() > 0;
  }

  public static function getAllCompletions(string $user_id, PDO $pdo = null): array
  {
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
    tm.id = t.module_id
LEFT JOIN 
    tutorial_completions tc 
ON 
    t.href = tc.tutorial_href 
    AND tc.user_id = :user_id
ORDER BY 
    tm.number, t.number";

    $conn = $pdo ?: connectDB();
    $stmt = $conn->prepare($sql);
    $stmt->execute([
      ":user_id" => $user_id
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getAll(PDO $pdo = null): array
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
  tm.id = t.module_id
ORDER BY
  tm.number, t.number";
    $conn = $pdo ?: connectDB();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
