<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Classes\View;
use App\Services\FileCache;
use App\Models\TutorialCompletion;
use App\Middleware\CsrfProtection;
use App\Validation\TutorialCompletionValidator;
use App\Models\Tutorial;

require_once __DIR__ . "/../helpers/getJsonBody.php";

/**
 * Controller for the TutorialCompletion model.
 */
class TutorialCompletionController
{
  /**
   * Attempts to retrieve the tutorial completion index for the user.
   * @return View The view to display to the user.
   */
  public static function index(): View
  {
    $user = $_SESSION["user"];
    if (!$user) {
      include __DIR__ . "/../views/status/unauthorized.php";
      return $view;
    }
    $userId = $user["id"];

    $successView = new View(filename: "/tutorials/completionIndex.php");

    $cache = new FileCache(
      FileCache::tutorialCompletionIndexFilename($userId)
    );
    $index = $cache->get();

    if ($index) {
      $successView->appendData(["completionsIndex" => $index]);
    } else {
      $completion = new TutorialCompletion(userId: $userId);
      $index = $completion->getIndex();
      if (!$index) {
        include __DIR__ . "/../views/status/serverError.php";
        return $view;
      }
      $cache->set($index);
      $successView->appendData(["completionsIndex" => $index]);
    }

    return $successView;
  }

  /**
   * Updates the tutorial completions for a user.
   * @return string|false A JSON string to respond with on successful encode, false otherwise.
   */
  public function update(): string|false
  {
    $body = getJsonBody();
    $validator = new TutorialCompletionValidator();
    $valid = $validator->validateRequestBody($body);

    if (!$valid) {
      http_response_code(400);
      return json_encode([
        "status" => "error",
        "message" => "Bad request"
      ]);
    }

    $user = $_SESSION["user"];
    if (!$user || !CsrfProtection::compareTokens($body["csrfToken"])) {
      http_response_code(401);
      return json_encode([
        "status" => "error",
        "message" => "Unauthorized."
      ]);
    }

    // instantiate model and request scaffold
    $completion = new TutorialCompletion(userId: $user["id"]);
    $successResponse = [
      "status" => "success",
      "tutorialsUpdated" => [],
      "tutorialsNotUpdated" => [],
      "invalidIds" => []
    ];


    // try to update for each
    foreach ($body["completions"] as [$tutorialId, $newValue]) {
      // validate the update
      $validator = new TutorialCompletionValidator();
      [
        "error" => $error,
        "values" => $values
      ] = $validator->validateUpate($tutorialId, $newValue);

      if ($error) {
        $successResponse["invalidIds"][] = $tutorialId;
        continue;
      }

      [$moduleNumber, $tutorialNumber] = $values;
      $completion->setModuleNumber($moduleNumber);
      $completion->setTutorialNumber($tutorialNumber);

      // make update depending on new value
      $success = $newValue === "1"
        ? $completion->insert()
        : $completion->delete();

      $successResponse[$success ? "tutorialsUpdated" : "tutorialsNotUpdated"][] = $tutorialId;
    }

    // invalidate the cache
    $cache = new FileCache(
      FileCache::tutorialCompletionIndexFilename($user["id"])
    );
    $cache->delete();
    return json_encode($successResponse);
  }

  /**
   * Returns a view for the specified tutorial completion.
   * @param string $filename The name of the view file relative to the views directory.
   * @param int $moduleNumber The module number of the tutorial.
   * @param int $tutorialNumber The number of the tutorial in the module.
   * @return View The view to display to the user.
   */
  public function get(string $filename, int $moduleNumber, int $tutorialNumber): View
  {
    $user = $_SESSION["user"];
    if (!$user) {
      include __DIR__ . "/../views/status/unauthorized.php";
      return $view;
    }
    $tutorial = new Tutorial(moduleNumber: $moduleNumber, number: $tutorialNumber);
    $completion = new TutorialCompletion($user["id"], $tutorialNumber, $moduleNumber);
    $prevHref = $tutorial->getPrevHref();
    $nextHref = $tutorial->getNextHref();
    $isCompleted = $completion->find();
    $data = [
      "tutorialNumber" => $tutorialNumber,
      "moduleNumber" => $moduleNumber,
      "prev" => $prevHref ?: null,
      "next" => $nextHref ?: null,
      "isCompleted" => $isCompleted
    ];
    $view = new View(filename: $filename, data: $data);
    $row = $tutorial->get();
    if ($row) {
      $view->setTitle($row["name"]);
    }
    return $view;
  }
}
