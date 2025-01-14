<?php

function deleteRecursively($dir)
{
  $files = array_diff(scandir($dir), array(".", ".."));

  foreach ($files as $file) {
    $file_path = $dir . DIRECTORY_SEPARATOR . $file;

    if (is_dir($file_path)) {
      deleteRecursively($file_path);
      rmdir($file_path);
    } else {
      unlink($file_path);
    }
  }
}

$cache_dir = __DIR__ . "/../cache";
if (!file_exists($cache_dir)) exit;

deleteRecursively($cache_dir);
