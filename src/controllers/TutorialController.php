<?php

declare(strict_types=1);

require_once __DIR__ . "/../models/Tutorial.php";
require_once __DIR__ . "/../middleware/Authentication.php";
require_once __DIR__ . "/../middleware/Session.php";
require_once __DIR__ . "/../middleware/Cache.php";
require_once __DIR__ . "/../middleware/CsrfProtection.php";
require_once __DIR__ . "/../db.php";

class TutorialController
{
  /**
   * Handles a request to get all tutorial completions for the current user.
   * @param $user_id The user's id.
   * @return array The rows returned from the database query or the file cache.
   * @throws PDOException If a database connection failed.
   */
  public static function handleGetCompletions(string $user_id): array
  {
    $cache = Cache::getTutorialCompletions($user_id);
    if ($cache) return $cache;

    $pdo = connectDB();
    $completions = Tutorial::getAllCompletions($user_id, $pdo);
    Cache::setTutorialCompletions($user_id, $completions);

    return $completions;
  }

  /**
   * Handles a request to get all tutorials.
   * @return array The rows returned from the database query or file cache.
   * @throws PDOException If a database connection failed.
   */
  public static function handleGetAll(): array
  {
    $cache = Cache::getTutorials();
    if ($cache) return $cache;

    $pdo = connectDB();
    $tutorials = Tutorial::getAll($pdo);
    Cache::setTutorials($tutorials);

    return $tutorials;
  }

  /**
   * Handles a request to update the tutorial completions for a user.
   * 
   * Echoes a json response to be handled by the client.
   */
  public static function handleSetCompletions()
  {
    // check auth and csrf token
    $user = Authentication::verify();
    if (!$user || !CsrfProtection::compareTokensDirectly()) {
      http_response_code(401);
      echo json_encode([
        "status" => "error",
        "message" => "Unauthorized."
      ]);
      exit;
    }

    // try db connection
    $pdo = null;
    try {
      $pdo = connectDB();
    } catch (PDOException $e) {
      http_response_code(500);
      echo json_encode([
        "status" => "error",
        "message" => "Server error."
      ]);
      exit;
    }

    // response scaffold
    $success_response = [
      "status" => "success",
      "tutorials_updated" => [],
      "tutorials_not_updated" => []
    ];

    // get the completions
    $completions = $_POST;
    unset($completions["csrf_token"]);

    // try to update for each
    foreach ($completions as $tid => $value) {
      $error_msg = self::validateTutorialCompletionUpdate($tid, $value);

      if ($error_msg) {
        http_response_code(400);
        echo json_encode([
          "status" => "error",
          "message" => $error_msg
        ]);
        exit;
      }

      $tut = new Tutorial($tid, $pdo);
      $success = false;

      if ($value === "1") {
        $success = $tut->markComplete($user["id"]);
      } elseif ($value === "0") {
        $success = $tut->markIncomplete($user["id"]);
      }

      if ($success) {
        $success_response["tutorials_updated"][] = $tid;
      } else {
        $success_response["tutorials_not_updated"][] = $tid;
      }
    }

    // invalidate the cache
    Cache::deleteTutorialCompletions($user["id"]);

    echo json_encode($success_response);
    exit;
  }

  /**
   * Validates whether a tutorial completion form data entry is valid.
   * @param string|int $tutorial_id The tutorial id (form data key).
   * @param mixed $value The new completion state for the tutorial id (form data value).
   * @return string|false An error message if not valid, false otherwise.
   */
  private static function validateTutorialCompletionUpdate(
    string|int $tutorial_id,
    mixed $value
  ): string|false {
    if (is_string($tutorial_id) || $tutorial_id <= 0) {
      return "Invalid tutorial id received.";
    }

    if ($value !== "1" && $value !== "0") {
      return "Invalid value received";
    }

    return false;
  }

  /**
   * Gets a tutorial's id, completion status, previous tutorial link and next tutorial link.
   * @param int $tutorial_number The number of the tutorial in the module.
   * @param int $module_number The module number of the tutorial.
   * @param ?bool $completions Whether to get the completion status for the current user.
   * @return array An array containing the data.
   * @throws PDOException If a database connection failed.
   */
  public static function getFragment(int $tutorial_number, int $module_number, bool $completions = false): array
  {
    $tutorials =
      $completions
      ? self::handleGetCompletions(USER["id"])
      : self::handleGetAll();

    for ($i = 0; $i < count($tutorials); $i++) {
      [
        "tutorial_number" => $tnum,
        "module_number" => $mnum,
        "tutorial_id" => $tid,
        "is_completed" => $compl
      ] = $tutorials[$i];

      if ($tnum === $tutorial_number && $mnum === $module_number) {
        $fragment = ["id" => $tid];
        if (isset($compl)) {
          $fragment["completed"] = $compl;
        }
        if (isset($tutorials[$i - 1])) {
          $fragment["previous"] = $tutorials[$i - 1]["tutorial_href"];
        }
        if (isset($tutorials[$i + 1])) {
          $fragment["next"] = $tutorials[$i + 1]["tutorial_href"];
        }
        return $fragment;
      }
    }
  }
}
