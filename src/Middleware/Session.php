<?php

declare(strict_types=1);

namespace App\Middleware;


/**
 * Middleware class to handle sessions.
 */
class Session
{
  /**
   * Frees all session variables and completely destroys the current session.
   */
  public static function destroy()
  {
    session_unset();
    session_destroy();
  }

  /**
   * Starts a session if not already started.
   * @return bool True if a new session was started, false otherwise.
   */
  public static function start(): bool
  {
    if (session_status() == PHP_SESSION_ACTIVE) return false;

    $domain = getenv("SESSION_COOKIE_DOMAIN");
    $lifetime = 60 * 60 * 24 * 7;

    ini_set("session.use_only_cookies", 1);
    ini_set("session.use_strict_mode", 1);
    ini_set("session.gc_maxlifetime", $lifetime);

    session_set_cookie_params([
      "lifetime" => $lifetime,
      "domain" => $domain,
      "path" => "/",
      "secure" => true,
      "httponly" => true,
    ]);

    session_start();

    $regenerate = function () {
      session_regenerate_id(true);
      $_SESSION["last_regeneration"] = time();
    };
    $last_regen = $_SESSION["last_regeneration"];

    if (!isset($last_regen)) {
      $regenerate();
      return true;
    }

    if (time() - $last_regen >= 60 * 30) {
      $regenerate();
    }

    return true;
  }
}
