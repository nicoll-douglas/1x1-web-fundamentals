<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * The currently available layout filenames.
 * 
 * Filenames are relative to the templates directory.
 */
enum Layout: string
{
  case Main = "/mainLayout.php";
  case Basic = "/basicLayout.php";
}
