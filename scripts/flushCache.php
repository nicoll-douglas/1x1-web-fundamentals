<?php

$filesRemoved = 0;
$dirsRemoved = 0;

function deleteRecursively($dir)
{
  global $filesRemoved;
  global $dirsRemoved;

  $files = array_diff(scandir($dir), array(".", ".."));

  foreach ($files as $file) {
    $file_path = $dir . DIRECTORY_SEPARATOR . $file;

    if (is_dir($file_path)) {
      deleteRecursively($file_path);
      $success = rmdir($file_path);
      $dirsRemoved += (int) $success;
    } else {
      $success = unlink($file_path);
      $filesRemoved += (int) $success;
    }
  }
}

$cache_dir = __DIR__ . "/../cache";
if (!file_exists($cache_dir)) {
  echo "Cache folder doesn't exist. Nothing to clear.\n";
  echo "Exiting...\n";
  exit;
};

echo "Clearing cache...\n";
deleteRecursively($cache_dir);
echo "Successfully deleted $filesRemoved files.\n";
echo "Successfully deleted $dirsRemoved directories.\n";
echo "Exiting...\n";
