<?php

declare(strict_types=1);

namespace App\Services;

/**
 * Service class to interface with the local file cache.
 */
class FileCache
{
  /**
   * The directory name of the cache directory.
   */
  public const DIRNAME = __DIR__ . "/../../cache";
  /**
   * The filename in the cache that contains the tutorial index.
   */
  public const TUTORIAL_INDEX = self::DIRNAME . DIRECTORY_SEPARATOR . "tutorials.json";
  private string $filename;

  /**
   * Initialises the class fields.
   * @param string $filename The fully qualified a file in the cache.
   */
  public function __construct(string $filename)
  {
    $this->filename = $filename;
  }

  /**
   * Sets the value in the cache for the current filename.
   * @param mixed $value The value to write.
   * @return bool True if the file was written to, false otherwise.
   */
  public function set(mixed $value): bool
  {
    if (!self::createDir()) return false;

    $data = json_encode($value, JSON_PRETTY_PRINT);

    $bytesPut = file_put_contents($this->filename, $data);
    $this->setPermissions($this->filename);

    return $bytesPut === false ? false : true;
  }

  /**
   * Deletes the current file from the cache.
   * @return bool True if the operation succeeded, false otherwise.
   */
  public function delete(): bool
  {
    if (!self::existsDir()) return true;
    if (!file_exists($this->filename)) return true;
    return unlink($this->filename);
  }

  /**
   * Gets the contents of the current file in the cache.
   * @return mixed Depends on the data, so the data if it exists and could be read from the cache, null otherwise.
   */
  public function get()
  {
    if (!self::createDir()) return null;

    if (file_exists($this->filename)) {
      $data = file_get_contents($this->filename);
      if ($data) return json_decode($data, true);
    }

    return null;
  }

  /**
   * Changes the group of a file or directory to the www-data group and sets 0770 permissions.
   * @param string $fileOrDir A file or directory.
   */
  private function setPermissions(string $fileOrDir)
  {
    chgrp($fileOrDir, "www-data");
    chmod($fileOrDir, 0770);
  }

  /**
   * Creates the cache directory if it doesn't already exist.
   * @return bool True if it exists or was created, false if it failed to create.
   */
  private static function createDir(): bool
  {
    $created = true;
    if (!self::existsDir()) {
      $created = mkdir(self::DIRNAME);
      self::setPermissions(self::DIRNAME);
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
   * Gets the tutorial completion index filename in the cache for a user.
   * @param string $userId The user's ID.
   * @return string The fully qualified filename.
   */
  public static function tutorialCompletionIndexFilename(string $userId): string
  {
    return self::DIRNAME . DIRECTORY_SEPARATOR . "tutorial_completions_$userId.json";
  }
}
