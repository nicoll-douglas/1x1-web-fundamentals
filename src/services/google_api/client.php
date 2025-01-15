<?php
require __DIR__ . "/../../../vendor/autoload.php";
require_once __DIR__ . "/../../config/env.php";

/**
 * Instatiates the Google API client with the necessary configuration.
 * @return Google\Client The Google API client.
 */
function getAPIClient()
{
  $client = new Google\Client();
  $client->setAuthConfig(__DIR__ . "/google_oauth_client_secret.json");
  $client->setRedirectUri(getenv("GOOGLE_AUTH_REDIRECT_URI"));
  $client->setAccessType("offline");
  $client->addScope("profile");
  return $client;
}
