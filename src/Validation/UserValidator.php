<?php

declare(strict_types=1);

namespace App\Validation;

/**
 * Validator class for the User controller.
 */
class UserValidator
{
  /**
   * Validates a user DELETE request's body.
   * @param string $decodedJson The decoded JSON request body.
   * @return bool True if valid, false otherwise.
   */
  public function validateDeleteRequestBody(mixed $decodedJson): bool
  {
    if (!is_array($decodedJson)) {
      return false;
    }

    $csrfToken = $decodedJson["csrfToken"];

    if (!is_string($csrfToken)) {
      return false;
    }

    return true;
  }
}
