<?php

declare(strict_types=1);

namespace App\Validation;

/**
 * Validator class for the TutorialCompletion controller.
 */
class TutorialCompletionValidator
{
  /**
   * Validates a completion from the request body trying to be updated.
   * @param mixed $tutorialId The "tutorial id" that should be a string of the form "X-Y", X being the module number and Y being the tutorial number.
   * @param mixed $newValue The "new value" that should be either of the strings "1" for insert or "0" for delete.
   * @return array{ error?: bool, values?: array<int, int> } Contains an error message if not valid, contains the module number and tutorial number otherwise.
   */
  public function validateUpate(
    mixed $tutorialId,
    mixed $newValue
  ): array {
    $errorResult = [
      "error" => true
    ];

    if (!is_string($tutorialId)) {
      return $errorResult;
    }

    $strings = explode("-", $tutorialId);
    if (count($strings) > 2) {
      return $errorResult;
    }
    [$moduleNumber, $tutorialNumber] = $strings;

    if (!ctype_digit($moduleNumber) || !ctype_digit($tutorialNumber)) {
      return $errorResult;
    }

    $moduleNumber = intval($moduleNumber);
    $tutorialNumber = intval($tutorialNumber);
    if ($moduleNumber <= 0 || $tutorialNumber <= 0) {
      return $errorResult;
    }

    if ($newValue !== "1" && $newValue !== "0") {
      return $errorResult;
    }

    return [
      "values" => [$moduleNumber, $tutorialNumber]
    ];
  }

  /**
   * Validates the structure of a decoded JSON request body for a tutorial completion update request.
   * @param mixed $decodedJson The decoded JSON body.
   * @return bool True if valid, false otherwise.
   */
  public function validateRequestBody(mixed $decodedJson): bool
  {
    if (!is_array($decodedJson)) {
      return false;
    }

    $csrfToken = $decodedJson["csrfToken"];
    $completions = $decodedJson["completions"];

    if (!is_string($csrfToken)) {
      return false;
    }

    if (!is_array($completions)) {
      return false;
    }

    return true;
  }
}
