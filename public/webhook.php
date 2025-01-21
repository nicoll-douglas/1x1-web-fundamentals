<?php

require_once __DIR__ . "/../src/config/env.php";

$secret = getenv("GITHUB_WEBHOOK_SECRET");
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];

$payload = file_get_contents('php://input');
$hash = 'sha1=' . hash_hmac('sha1', $payload, $secret);

if ($signature !== $hash) {
  http_response_code(403);
  exit;
}

exec('cd /var/www/jwf.nicolldouglas.dev && git pull origin main');
