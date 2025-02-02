<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * Exception class to be thrown when a class field is unexpectedly empty.
 */
class NonEmptyException extends \Exception
{
  /**
   * @param string $field The name of the class field.
   */
  public function __construct(string $field)
  {
    $message = "'$field' must be initialised to a non-empty value in this context.";
    parent::__construct($message);
  }
}
