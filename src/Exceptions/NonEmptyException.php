<?php

declare(strict_types=1);

namespace App\Exceptions;

class NonEmptyException extends \Exception
{
  public function __construct(string $field)
  {
    $message = "'$field' must be initialised to a non-empty value in this context.";
    parent::__construct($message);
  }
}
