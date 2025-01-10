<?php


require __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../models/RefreshToken.php";
require_once __DIR__ . "/session.php";
require __DIR__ . "/../services/google_api/client.php";

/**
 * Checks whether the user is authenticated.
 * @return Google\Client|null A Google API client instance loaded with the access token if authenticated, null otherwise.
 */
function checkAuth(): Google\Client | null
{
  global $client;
  $user = $_SESSION["user"];

  if (!isset($user)) return null;

  $client->setAccessToken($user["access_token"]);
  if (!$client->isAccessTokenExpired()) return $client;

  $pdo = connectDB();
  if (!$pdo) return null;

  $row = RefreshToken::find($pdo, $user["id"]);
  if (!$row) return null;
  if (!isset($row["token"]) || is_null($row["token"])) return null;

  $client->fetchAccessTokenWithRefreshToken($row["token"]);

  $_SESSION["user"]["access_token"] = $client->getAccessToken();

  $new_refresh_token = $client->getRefreshToken();
  if ($new_refresh_token && $new_refresh_token !== $row["token"]) {
    $client->revokeToken($row["token"]);
    RefreshToken::update($pdo, $user["id"], $new_refresh_token);
  }

  return $client;
}
