<?php

declare(strict_types=1);

use App\Middleware\CsrfProtection;
use App\Controllers\TutorialCompletionController;
use App\Controllers\TutorialController;

/**
 * Creates a route handler function for a tutorial route.
 * @param string $viewFilename The filename of the corresponding view relative to the view directory.
 * @param int $moduleNumber The module number of the tutorial.
 * @param int $tutorialNumber The tutorial number in the module.
 * @return \Closure The route handler function.
 */
function tutorialRouteHandler(string $viewFilename, int $moduleNumber, int $tutorialNumber): \Closure
{
  return function () use ($viewFilename, $moduleNumber, $tutorialNumber) {
    if (USER) {
      CsrfProtection::setToken();
      $completionController = new TutorialCompletionController();
      $view = $completionController->get($viewFilename, $moduleNumber, $tutorialNumber);
      $view->script("/features/updateOneCompletion.js");
    } else {
      $tutorialController = new TutorialController();
      $view = $tutorialController->get($viewFilename, $moduleNumber, $tutorialNumber);
    }
    $view->show();
  };
}
