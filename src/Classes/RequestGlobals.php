<?php

declare(strict_types=1);

namespace App\Classes;

use App\Classes\View;

/**
 * Container to store custom global variables needed throughout the runtime of the current request.
 */
class RequestGlobals
{
  /**
   * @var View The current view object.
   */
  public static View $view;
}
