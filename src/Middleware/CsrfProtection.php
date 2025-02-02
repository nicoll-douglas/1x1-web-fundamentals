<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Middleware\Session;

/**
 * Middleware class for CSRF protection.
 */
class CsrfProtection
{
  /**
   * Creates a CSRF token and stores it in the session for future use.
   * @return string The CSRF token for convenience.
   */
  public static function setToken(): string
  {
    $token = bin2hex(random_bytes(16));
    $_SESSION["csrfToken"] = $token;
    return $token;
  }

  /**
   * Compares the supplied CSRF token with current token for validity.
   * @param string $suppliedToken The token sent to the server.
   * @return bool True if the supplied token matches the current CSRF token, false otherwise.
   */
  public static function compareTokens(string $suppliedToken): bool
  {
    if (!$suppliedToken) return false;
    if (!is_string($suppliedToken)) return false;
    return $_SESSION["csrfToken"] === $suppliedToken;
  }
}
