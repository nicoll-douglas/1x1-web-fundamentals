<?php

declare(strict_types=1);

namespace App\Controllers;

/**
 * Controller to handle webhook requests.
 */
class WebhookController
{
  /**
   * Handles a webhook request for the GitHub push event on the remote repo.
   */
  public function githubSync()
  {
    $secret = getenv("GITHUB_WEBHOOK_SECRET");
    $signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];

    $payload = file_get_contents('php://input');
    $hash = 'sha1=' . hash_hmac('sha1', $payload, $secret);

    if ($signature !== $hash) {
      http_response_code(403);
      exit;
    }

    $workingDirectory = $_SERVER["DOCUMENT_ROOT"] . "/..";

    exec(
      "cd $workingDirectory && git pull origin main && composer install && composer dump-autoload"
    );
  }
}
