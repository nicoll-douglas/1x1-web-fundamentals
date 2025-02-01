<?php

declare(strict_types=1);

namespace App\Validation;

/**
 * Validator class for the Message controller.
 */
class MessageValidator
{
  /**
   * Validates a message trying to be created.
   * @param mixed $msg The message to be validated.
   * @return array{ error?: string, success?:string } Contains an error message on error, or the sanitized message on success. 
   */
  public function validateCreate(mixed $msg): array
  {
    if (!isset($msg)) {
      return ["error" => "Message must not be empty!"];
    }

    if (!is_string($msg)) {
      return ["error" => "Message must be a string!"];
    }

    $sanitizedMessage = trim($msg);

    if (strlen($sanitizedMessage) > 255) {
      return ["error" => "Message must not exceed 255 characters!"];
    }

    return ["success" => $sanitizedMessage];
  }
}
