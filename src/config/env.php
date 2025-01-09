<?php

$env_file = __DIR__ . "/../../.env";

if (file_exists($env_file)) {
  $lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  foreach ($lines as $line) {
    if (strpos(trim($line), "#") === 0) {
      continue;
    }

    [$key, $value] = explode("=", $line, 2);
    $key = trim($key);
    $value = trim($value);

    putenv("$key=$value");
  }
} else {
  throw new RuntimeException("Missing .env");
}
