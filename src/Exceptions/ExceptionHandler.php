<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * Class that contains the global exception handler method.
 */
class ExceptionHandler
{
  public static function handle(\Throwable $e)
  {
    include __DIR__ . "/../views/status/serverError.php";
    if (getenv("APP_ENV") === "development") {
      self::reportError($e);
    }
    $view->show();
  }

  private static function reportError(\Throwable $e)
  {
    echo "<pre>";
    echo "MESSAGE: " . $e->getMessage() . "\n\n";
    echo "LINE: " . $e->getLine() . "\n\n";
    echo "FILE: " . $e->getFile() . "\n\n";
    echo "STACK TRACE:\n\n";
    echo $e->getTraceAsString() . "\n\n";
    echo "CODE: " . $e->getCode();
    echo "</pre>";
  }
}
