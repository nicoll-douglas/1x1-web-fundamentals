<?php

require_once __DIR__ . "/../config/env.php";

/**
 * Class that contains middleware functions pertaining to sessions.
 */
class Session
{
  /**
   * Completely destroys the current session.
   */
  public static function destroy()
  {
    session_unset();
    session_destroy();
  }

  /**
   * Starts a session if not already started.
   */
  public static function start()
  {
    if (session_status() == PHP_SESSION_ACTIVE) return;

    $domain = getenv("APP_ENV") === "development" ? "localhost" : $_SERVER["HTTP_HOST"];
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
      return;
    }

    if (time() - $last_regen >= 60 * 30) {
      $regenerate();
    }
  }
}
