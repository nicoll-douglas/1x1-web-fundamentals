<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\FileCache;
use App\Models\Tutorial;
use App\Classes\View;

/**
 * Controller for the Tutorial model.
 */
class TutorialController
{
  /**
   * Attempts to retrieve the tutorial index.
   * @return View The view to display to the user.
   */
  public function index(): View
  {
    $successView = new View(filename: "/tutorials/index.php");

    $cache = new FileCache(FileCache::TUTORIAL_INDEX);
    $index = $cache->get();
    $tutorial = new Tutorial();

    if ($index) {
      $successView->appendData(["tutorialIndex" => $index]);
    } else {
      $index = $tutorial->getIndex();
      if (!$index) {
        require_once __DIR__ . "/../views/status/serverError.php";
        return $view;
      }
      $cache->set($index);
      $successView->appendData(["tutorialIndex" => $index]);
    }

    return $successView;
  }

  /**
   * Returns a view for the specified tutorial.
   * @param string $filename The name of the view file.
   * @param int $moduleNumber The module number of the tutorial.
   * @param int $tutorialNumber The number of the tutorial in the module.
   * @return View The view to display to the user.
   */
  public function get(string $filename, int $moduleNumber, int $tutorialNumber): View
  {
    $tutorial = new Tutorial(moduleNumber: $moduleNumber, number: $tutorialNumber);
    $prevHref = $tutorial->getPrevHref();
    $nextHref = $tutorial->getNextHref();

    $data = [
      "tutorialNumber" => $tutorialNumber,
      "moduleNumber" => $moduleNumber,
      "prev" => $prevHref ?: null,
      "next" => $nextHref ?: null,
    ];

    $view = new View(filename: $filename, data: $data);
    $row = $tutorial->get();
    if ($row) {
      $view->setTitle($row["name"]);
    }
    return $view;
  }
}
