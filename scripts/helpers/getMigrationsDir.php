<?php

declare(strict_types=1);

/**
 * Gets the migrations directory.
 * @return string The migrations directory.
 */
function getMigrationsDir(): string
{
  return __DIR__ . "/../../migrations";
}
