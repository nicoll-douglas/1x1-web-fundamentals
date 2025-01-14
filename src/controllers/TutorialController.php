<?php

declare(strict_types=1);

require_once __DIR__ . "/../models/Tutorial.php";
require_once __DIR__ . "/../middleware/Authentication.php";
require_once __DIR__ . "/../middleware/Session.php";
require_once __DIR__ . "/../db.php";

class TutorialController
{
  public static function handleSave() {}

  public static function handleGetCompletions(string $user_id)
  {
    $cache_file = __DIR__ . "/../../cache/tutorial_completions_$user_id.json";

    $dirname = dirname($cache_file);

    if (!is_dir($dirname)) {
      mkdir($dirname, 0760, true);
    }

    if (file_exists($cache_file)) {
      $data = file_get_contents($cache_file);
      if ($data) return json_decode($data, true);
    }

    $pdo = connectDB();
    $completions = Tutorial::getAllCompletions($user_id, $pdo);
    $data = json_encode($completions, JSON_PRETTY_PRINT);
    file_put_contents($cache_file, $data);

    return $completions;
  }

  public static function handleGetAll()
  {
    $cache_file = __DIR__ . "/../../cache/tutorials.json";

    $dirname = dirname($cache_file);

    if (!is_dir($dirname)) {
      mkdir($dirname, 0760, true);
    }

    if (file_exists($cache_file)) {
      $data = file_get_contents($cache_file);
      if ($data) return json_decode($data, true);
    }

    $pdo = connectDB();
    $tutorials = Tutorial::getAll($pdo);
    $data = json_encode($tutorials, JSON_PRETTY_PRINT);
    file_put_contents($cache_file, $data);

    return $tutorials;
  }
}
