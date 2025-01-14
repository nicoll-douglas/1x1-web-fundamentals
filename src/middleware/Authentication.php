<?php

declare(strict_types=1);

use Google\Auth\Cache\InvalidArgumentException;

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
   * Checks whether the user is authenticated and refreshes their tokens if necessary.
   * @return false|array False if not authenticated, the user's row in the table otherwise.
   */
  public static function verify(): false|array
  {
    // check for session
    Session::start();
    $user = $_SESSION["user"];
    if (!isset($user)) return false;

    // try to retrieve user
    $user_instance = null;
    try {
      $user_instance = new User($user["id"]);
    } catch (PDOException $e) {
      return false;
    }
    $row = $user_instance->find();
    if (!$row) return false;

    // get users tokens and api client
    $current_access_token = $user["access_token"];
    $current_refresh_token = $row["refresh_token"];
    $client = getAPIClient();

    // verify ip, revoke eveything otherwise
    if (!self::verifyIP()) {
      $client->revokeToken($current_access_token);
      $client->revokeToken($current_refresh_token);
      $user_instance->update(["refresh_token" => "NULL"]);
      Session::destroy();
      return false;
    };

    // check for good access token
    if (!$current_access_token) return false;
    $client->setAccessToken($current_access_token);
    if (!$client->isAccessTokenExpired()) return $row;

    // check for refresh token
    if (!$current_refresh_token) return false;

    // try to get and set access token with refresh token
    $client->fetchAccessTokenWithRefreshToken($current_refresh_token);
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

    // check for refresh token
    $new_refresh_token = $client->getRefreshToken();
    if (!$new_refresh_token) return $row;
    if ($new_refresh_token === $current_refresh_token) return $row;
    $client->revokeToken($current_refresh_token);
    $user_instance->update(["refresh_token" => $new_refresh_token]);

    return $row;
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
