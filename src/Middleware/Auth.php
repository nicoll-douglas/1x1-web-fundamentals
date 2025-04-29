<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Middleware\Session;
use App\Models\User;
use App\Services\Google\AppClient;

require_once __DIR__ . "/../utils/hashWithSalt.php";

/**
 * Middleware class for authentication.
 */
class Auth
{
  /**
   * Checks whether the user is authenticated and refreshes their tokens if necessary.
   * @return false|array False if not authenticated, the user's row in the table otherwise.
   */
  public static function verify(): false|array
  {
    // check for session
    if (!isset($_SESSION["user"])) return false;
    $sessionUser = $_SESSION["user"];

    // try to retrieve user
    try {
      $user = new User(id: $sessionUser["id"]);
    } catch (\PDOException $e) {
      return false;
    }

    $row = $user->find();
    if (!$row) return false;

    // get user's tokens and api client
    $currentAccessToken = $sessionUser["accessToken"];
    $currentRefreshToken = $row["refresh_token"];
    $client = new AppClient();

    // verify ip, revoke eveything otherwise
    if (!self::verifyIP()) {
      $client->revokeAllTokens();
      $user->setRefreshToken(null);
      $user->update(refreshToken: true);
      Session::destroy();
      return false;
    };

    // check for good access token
    if (!$currentAccessToken) return false;
    $client->setAccessToken($currentAccessToken);
    if (!$client->isAccessTokenExpired()) return $row;

    // check for refresh token
    if (!$currentRefreshToken) return false;

    // try to get and set access token with refresh token
    $client->fetchAccessTokenWithRefreshToken($currentRefreshToken);
    $newAccessToken = $client->getAccessToken();
    if (!$newAccessToken) {
      Session::destroy();
      return false;
    };
    if ($newAccessToken === $currentAccessToken) {
      Session::destroy();
      return false;
    }
    $_SESSION["user"]["accessToken"] = $newAccessToken;

    // check for refresh token
    $newRefreshToken = $client->getRefreshToken();
    if (!$newRefreshToken) return $row;
    if ($newRefreshToken === $currentRefreshToken) return $row;
    $client->revokeToken($currentRefreshToken);
    $user->setRefreshToken($newRefreshToken);
    $user->update(refreshToken: true);

    return $row;
  }

  /**
   * Verifies that the current IP matches the session's IP.
   * @return bool True if they match, false otherwise.
   */
  private static function verifyIP(): bool
  {
    $requestIpHash = hashWithSalt(
      $_SERVER["REMOTE_ADDR"],
      $_SESSION["user"]["ipSalt"]
    );
    $storedIpHash = $_SESSION["user"]["ipHash"];
    return hash_equals($requestIpHash, $storedIpHash);
  }
}
