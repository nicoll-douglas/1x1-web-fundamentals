<?php

declare(strict_types=1);

require_once __DIR__ . "/../models/Tutorial.php";
require_once __DIR__ . "/../middleware/Authentication.php";
require_once __DIR__ . "/../middleware/Session.php";
require_once __DIR__ . "/../middleware/Cache.php";
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
    // check auth
    $user = Authentication::verify();
    if (!$user) {
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

    // try to update for each
    foreach ($_POST as $tid => $value) {
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
   * Changes the group of a file or directory to the www-data group and sets 0770 perms.
   * @param string $file_or_dir A file or directory.
   */
  private static function givePerms(string $file_or_dir)
  {
    chgrp($file_or_dir, "www-data");
    chmod($file_or_dir, 0770);
  }
}
