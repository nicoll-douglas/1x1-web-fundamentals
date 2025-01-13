<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../db.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/Session.php";
require_once __DIR__ . "/../services/google_api/client.php";
require_once __DIR__ . "/../utils/hashIP.php";

/**
 * Class that contains middleware functions pertaining to authentication.
 */
class Authentication
{
  /**
   * Checks whether the user is authenticated and refreshes their tokens.
   * @return bool True if authenticated, false otherwise.
   */
  public static function verify(): bool
  {
    // check for session
    Session::start();
    $user = $_SESSION["user"];
    if (!isset($user)) return false;

    // check for ip
    if (!self::verifyIP()) {
      self::revoke();
      Session::destroy();
      return false;
    };

    // check for good access token
    $current_access_token = $user["access_token"];
    $client = getAPIClient();
    $client->setAccessToken($current_access_token);
    if (!$client->isAccessTokenExpired()) return true;

    // try to get refresh token from database
    $user_instance = new User($user["id"]);
    $row = $user_instance->find();
    if (!$row || !$row["refresh_token"]) {
      Session::destroy();
      return false;
    };

    // try to get access token with refresh token
    $client->fetchAccessTokenWithRefreshToken($row["refresh_token"]);
    $new_access_token = $client->getAccessToken();
    if (!$new_access_token) {
      Session::destroy();
      return false;
    };
    if ($new_access_token === $current_access_token) {
      Session::destroy();
      return false;
    }
    $_SESSION["user"]["access_token"] = $new_access_token;

    // check for new refresh token
    $new_refresh_token = $client->getRefreshToken();
    if (!$new_refresh_token) return true;
    $current_refresh_token = $row["refresh_token"];
    if ($new_refresh_token === $current_refresh_token) return true;
    $client->revokeToken($current_refresh_token);
    $user_instance->update(["refresh_token" => $new_refresh_token]);

    return true;
  }

  /**
   * Revokes a user's OAuth tokens.
   * @param bool $access_only Whether to only revoke the access token.
   */
  public static function revoke(bool $access_only = false)
  {
    // check for session
    Session::start();
    $user = $_SESSION["user"];
    if (!isset($user)) return;

    // revoke access token
    $client = getAPIClient();
    $client->revokeToken($user["access_token"]);
    if ($access_only) return;

    // revoke refresh token
    $user_instance = new User($user["id"]);
    $row = $user_instance->find();
    if ($row) {
      $client->revokeToken($row["refresh_token"]);
      $user_instance->update(["refresh_token" => "NULL"]);
    }
  }

  /**
   * Verifies that the current IP matches the session's IP.
   */
  private static function verifyIP(): bool
  {
    $request_ip_hash = hashIP(
      $_SERVER["REMOTE_ADDR"],
      $_SESSION["user"]["ip_salt"]
    );
    $stored_ip_hash = $_SESSION["user"]["ip_hash"];
    return hash_equals($request_ip_hash, $stored_ip_hash);
  }
}
