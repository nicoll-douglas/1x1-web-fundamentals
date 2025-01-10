<?php

require_once __DIR__ . "/../config/env.php";

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

if (!isset($_SESSION["last_regeneration"])) {
  session_regenerate_id(true);
  $_SESSION["last_regeneration"] = time();
} else {
  if (time() - $_SESSION["last_regeneration"] >= 60 * 30) {
    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();
  }
}
