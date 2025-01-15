<?php

class Cache
{
  private const DIRNAME = __DIR__ . "/../../cache";

  /**
   * Creates the cache directory if it doesn't already exist.
   * @return bool True if it exists or was created, false if it failed to create.
   */
  private static function createDir()
  {
    $created = true;
    if (!self::existsDir()) {
      $created = mkdir(self::DIRNAME);
      self::givePerms(self::DIRNAME);
    }
    return $created;
  }

  /**
   * Checks if the cache directory exists.
   * @return bool True if it exists, false otherwise.
   */
  private static function existsDir(): bool
  {
    return is_dir(self::DIRNAME);
  }

  /**
   * Gets the user's tutorial completions from the cache.
   * @param string $user_id The user's id.
   * @return array|null The data if it exists and could be read from the cache, null otherwise.
   */
  public static function getTutorialCompletions(string $user_id): array|null
  {
    if (!self::createDir()) return null;

    $cache_file = self::tutorialCompletionsFilename($user_id);

    if (file_exists($cache_file)) {
      $data = file_get_contents($cache_file);
      if ($data) return json_decode($data, true);
    }

    return null;
  }

  /**
   * Sets the user's tutorial completions in the cache.
   * @param string $user_id The user's id.
   * @param array $completions The user's tutorial completions queried from the database.
   * @return bool True if the cache file was created, false otherwise.
   */
  public static function setTutorialCompletions(string $user_id, array $completions): bool
  {
    if (!self::createDir()) return false;

    $data = json_encode($completions, JSON_PRETTY_PRINT);
    $cache_file = self::tutorialCompletionsFilename($user_id);

    $put = file_put_contents($cache_file, $data);
    self::givePerms($cache_file);

    return $put === false ? false : true;
  }

  /**
   * Deletes a user's tutorial completions from the cache.
   * @param string $user_id The user's id.
   * @return bool True if the operation succeeded, false otherwise.
   */
  public static function deleteTutorialCompletions(string $user_id): bool
  {
    if (!self::existsDir()) return true;

    $cache_file = self::tutorialCompletionsFilename($user_id);
    if (!file_exists($cache_file)) return true;

    $success = unlink($cache_file);
    if ($success) return true;

    $success = unlink($cache_file);
    return $success;
  }

  /**
   * Gets the tutorial data from the cache.
   * @return array|null The data if it exists and could be read from the cache, null otherwise.
   */
  public static function getTutorials()
  {
    if (!self::createDir()) return null;

    $cache_file = self::tutorialsFilename();

    if (file_exists($cache_file)) {
      $data = file_get_contents($cache_file);
      if ($data) return json_decode($data, true);
    }

    return null;
  }

  /**
   * Sets the tutorial data in the cache.
   * @param array $tutorials The tutorial data queried from the database;
   * @return bool True if the cache file was created, false otherwise.
   */
  public static function setTutorials(array $tutorials)
  {
    if (!self::createDir()) return false;

    $data = json_encode($tutorials, JSON_PRETTY_PRINT);
    $cache_file = self::tutorialsFilename();

    $put = file_put_contents($cache_file, $data);
    self::givePerms($cache_file);

    return $put === false ? false : true;
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

  /**
   * Gets the tutorial completion filename in the cache for a user.
   * @param string $user_id The user's id.
   * @return string The filename.
   */
  private static function tutorialCompletionsFilename(string $user_id): string
  {
    return self::DIRNAME . DIRECTORY_SEPARATOR . "tutorial_completions_$user_id.json";
  }

  /**
   * Gets the tutorial data filename from the cache.
   * @return string The filename.
   */
  private static function tutorialsFilename()
  {
    return self::DIRNAME . DIRECTORY_SEPARATOR . "tutorials.json";
  }
}
