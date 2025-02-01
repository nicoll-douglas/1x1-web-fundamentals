<?php

declare(strict_types=1);

namespace App\Enums;

enum Layout: string
{
  case Main = "/mainLayout.php";
  case Basic = "/basicLayout.php";
}
