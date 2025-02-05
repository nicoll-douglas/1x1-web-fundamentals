<?php

require_once __DIR__ . "/../../../config/env.php";

putenv("COMPOSER_HOME=/var/www/.composer");

$secret = getenv("GITHUB_WEBHOOK_SECRET");
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];

$payload = file_get_contents('php://input');
$hash = 'sha1=' . hash_hmac('sha1', $payload, $secret);

if ($signature !== $hash) {
  http_response_code(403);
  exit;
}

$rootDirectory = __DIR__ . "/../../..";
chdir($rootDirectory);

$output = shell_exec("git pull origin main");
echo $output;

$output = shell_exec("composer install");
echo $output;

$output = shell_exec("composer dump-autoload");
echo $output;

$output = shell_exec("composer run migration:start");
echo $output;
