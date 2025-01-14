<?php

function deleteRecursively($dir)
{
  if (!is_dir($dir)) {
    return false;
  }

  $files = array_diff(scandir($dir), array(".", ".."));

  foreach ($files as $file) {
    $file_path = $dir . DIRECTORY_SEPARATOR . $file;

    if (is_dir($file_path)) {
      deleteRecursively($file_path);
    } else {
      unlink($file_path);
    }
  }

  return rmdir($dir);
}

$cache_dir = __DIR__ . "/../cache";

deleteRecursively($cache_dir);
