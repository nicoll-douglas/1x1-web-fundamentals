<?php

declare(strict_types=1);

require_once __DIR__ . "/Session.php";

class CsrfProtection
{
  /**
   * Provides a CSRF token and stores it in the session.
   * @return string The CSRF token.
   */
  public static function initiate(): string
  {
    Session::start();
    $token = bin2hex(random_bytes(16));
    $_SESSION["csrf_token"] = $token;
    return $token;
  }

  /**
   * Compares two CSRF tokens for validity.
   * @param mixed $supplied_token The token sent to the server.
   * @return bool True if the supplied token matches the current CSRF token, false otherwise.
   */
  public static function compareTokens(mixed $supplied_token): bool
  {
    if (!$supplied_token) return false;
    if (!is_string($supplied_token)) return false;
    Session::start();
    return $_SESSION["csrf_token"] === $supplied_token;
  }

  /**
   * Compares the current CSRF token with the token in the $_POST superglobal.
   * @return bool True if the tokens match, false otherwise.
   */
  public static function compareTokensDirectly(): bool
  {
    $token = $_POST["csrf_token"];
    return self::compareTokens($token);
  }
}
