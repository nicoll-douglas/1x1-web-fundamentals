<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../db.php";
require_once __DIR__ . "/../models/RefreshToken.php";
require_once __DIR__ . "/Session.php";
require __DIR__ . "/../services/google_api/client.php";
require_once __DIR__ . "/../utils/hashIP.php";

/**
 * Class that contains middleware functions pertaining to authentication.
 */
class Authentication
{
  /**
   * Checks whether the user is authenticated and refreshes tokens.
   * @return Google\Client|null A Google API client instance loaded with the access token if authenticated, null otherwise.
   */
  public static function check(): Google\Client | null
  {
    Session::start();

    global $client;
    $user = $_SESSION["user"];

    // if no user, not auth'd
    if (!isset($user)) return null;

    // if request ip doesn't match current session ip, revoke auth and destroy session, not auth'd
    if (!self::verifyIP()) {
      self::revoke();
      Session::destroy();
      return null;
    };

    // if user's token is valid then they are auth'd
    $client->setAccessToken($user["access_token"]);
    if (!$client->isAccessTokenExpired()) return $client;

    // resort to refresh token
    $pdo = connectDB();
    if (!$pdo) {
      Session::destroy();
      return null;
    };
    $row = RefreshToken::find($pdo, $user["id"]);

    // if no refresh token, reset session, not auth'd
    if (!$row) {
      Session::destroy();
      return null;
    };
    if (!isset($row["token"]) || is_null($row["token"])) {
      Session::destroy();
      return null;
    };

    // attempt to refresh access token
    $client->fetchAccessTokenWithRefreshToken($row["token"]);
    $new_access_token = $client->getAccessToken() !== $user["access_token"];

    // if succeeded update token in the session
    if ($new_access_token) {
      $_SESSION["user"]["access_token"] = $client->getAccessToken();

      // if there's a new refresh token, revoke the old and store the new
      $new_refresh_token = $client->getRefreshToken();
      if ($new_refresh_token && $new_refresh_token !== $row["token"]) {
        $client->revokeToken($row["token"]);
        RefreshToken::update($pdo, $user["id"], $new_refresh_token);
      }
    }

    return $client;
  }

  /**
   * Revokes a user's OAuth tokens.
   * @param bool $access_only Whether to only revoke the access token.
   */
  public static function revoke(bool $access_only = false)
  {
    Session::start();
    $user = $_SESSION["user"];
    if (!isset($user)) return;

    global $client;

    $client->revokeToken($user["access_token"]);
    if ($access_only) return;

    $pdo = connectDB();

    if ($pdo) {
      $row = RefreshToken::find($pdo, $user["id"]);
      if ($row) {
        $client->revokeToken($row["token"]);
        RefreshToken::clear($pdo, $user["id"]);
      }
    }
  }

  private static function verifyIP(): bool
  {
    $request_ip_hash = hashIP(
      $_SERVER["REMOTE_ADDR"],
      $_SESSION["user"]["ip_salt"]
    );
    $stored_ip_hash = $_SESSION["user"]["ip"];
    return hash_equals($request_ip_hash, $stored_ip_hash);
  }
}
