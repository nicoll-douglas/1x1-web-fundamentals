<?php

declare(strict_types=1);

// super basic script to load .env variables

$envFile = __DIR__ . "/../../secrets/.env";

if (file_exists($envFile)) {
  $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  foreach ($lines as $line) {
    if (strpos(trim($line), "#") === 0) {
      continue;
    }

    [$key, $value] = explode("=", $line, 2);
    $key = trim($key);
    $value = trim($value);

    putenv("$key=$value");
  }
}
