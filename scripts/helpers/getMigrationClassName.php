<?php

declare(strict_types=1);

/**
 * Gets the migration's class name from the file.
 * @param string $filePath The file path of the migration file.
 * @return string The migration's class name.
 */
function getMigrationClassName(string $filePath): string
{
  $before = get_declared_classes();

  require_once $filePath;

  $after = get_declared_classes();

  $className = array_diff($after, $before);

  return reset($className);
}
