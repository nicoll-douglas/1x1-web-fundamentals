<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * Contains the global exception handler method.
 */
class ExceptionHandler
{
  /**
   * Shows a server error view.
   * 
   * In development it echoes information about the exception.
   * @param \Throwable $e The exception thrown.
   */
  public static function handle(\Throwable $e)
  {
    require __DIR__ . "/../views/status/serverError.php";
    if (getenv("APP_ENV") === "development") {
      self::reportError($e);
    }
    $view->show();
  }

  /**
   * Echoes an error report for the exception.
   * @param \Throwable $e The exception thrown.
   */
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
