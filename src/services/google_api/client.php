<?php
require __DIR__ . "/../../../vendor/autoload.php";
require_once __DIR__ . "/../../config/env.php";

$client = new Google\Client();
$client->setAuthConfig(__DIR__ . "/google_oauth_client_secret.json");
$client->setRedirectUri(getenv("GOOGLE_AUTH_REDIRECT_URI"));
$client->setAccessType("offline");
$client->addScope("profile");
