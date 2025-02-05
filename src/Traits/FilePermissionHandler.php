<?php

namespace App\Traits;

/**
 * Trait to allow for management of file permissions.
 */
trait FilePermissionHandler
{
  /**
   * Changes the group of a file or directory to the www-data group and sets 0770 permissions.
   * @param string $fileOrDir A file or directory.
   */
  private function giveCorrectPermissions(string $fileOrDir)
  {
    chgrp($fileOrDir, "www-data");
    chmod($fileOrDir, 0770);
  }
}
