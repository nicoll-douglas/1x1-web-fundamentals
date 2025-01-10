<?php

require __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../models/RefreshToken.php";
require_once __DIR__ . "/session.php";
require_once __DIR__ . "/../services/google_api_client.php";

/**
 * Checks whether the user is authenticated.
 * @return Googl\Client|null A Google API client instance loaded with the access token if authenticated, null otherwise.
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

  $client->fetchAccessTokenWithRefreshToken($row["token"]);
  $_SESSION["user"]["access_token"] = $client->getAccessToken();

  return $client;
}
