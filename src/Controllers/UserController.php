<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\Google\AppClient;
use App\Models\User;
use App\Middleware\Session;
use App\Middleware\CsrfProtection;
use App\Services\FileCache;
use App\Classes\View;
use App\Validation\UserValidator;

require_once __DIR__ . "/../helpers/getJsonBody.php";
require_once __DIR__ . "/../utils/hashWithSalt.php";

/**
 * Controller for the User model.
 */
class UserController
{
  /**
   * Handles Google OAuth redirection and logs the current user in.
   * @return View An feedback view for the user if not redirected once authenticated.
   */
  public function login(): View
  {
    $client = new AppClient();
    $accessToken = $client->relayAuthCode();
    if (!$accessToken) {
      require_once __DIR__ . "/../views/status/badRequest.php";
      return $view;
    }

    $client->setAccessToken($accessToken);
    $userInfo = $client->getUserInfo();
    if (!$userInfo) {
      require_once __DIR__ . "/../views/status/serverError.php";
      return $view;
    }

    try {
      $user = new User(id: $userInfo["id"]);
    } catch (\PDOException $e) {
      $client->revokeAllTokens();
      require_once __DIR__ . "/../views/status/serverError.php";
      return $view;
    }

    $ipSalt = bin2hex(random_bytes(16));
    $_SESSION["user"] = [
      "id" => $userInfo["id"],
      "accessToken" => $client->getAccessToken(),
      "ipHash" => hashWithSalt($_SERVER["REMOTE_ADDR"], $ipSalt),
      "ipSalt" => $ipSalt,
    ];

    $user->setName($userInfo["name"]);
    $newRefreshToken = $client->getRefreshToken();
    $user->setRefreshToken($newRefreshToken);

    $row = $user->find();
    if (!$row) {
      $user->insert();
      return $this->redirectToTutorialIndex();
    }

    $currentRefreshToken = $row["refresh_token"];
    if ($currentRefreshToken !== $newRefreshToken) {
      $client->revokeToken($currentRefreshToken);
    }

    $user->update(name: true, refreshToken: true);
    return $this->redirectToTutorialIndex();
  }

  /**
   * Logs the current user out and redirects to the home page.
   */
  public function logout()
  {
    $sessionUser = $_SESSION["user"];
    if (!isset($sessionUser)) {
      Session::destroy();
      return;
    };

    $user = new User(id: $sessionUser["id"]);
    $client = new AppClient();
    $client->revokeToken($sessionUser["accessToken"]);

    $row = $user->find();
    if ($row) {
      $client->revokeToken($row["refresh_token"]);
      $user->setRefreshToken(null);
      $user->update(refreshToken: true);
    }

    Session::destroy();
  }

  /**
   * Deletes the current user's account and data.
   * @return View A view to display to the user based on success status.
   */
  public function delete(): View
  {
    $body = getJsonBody();
    $validator = new UserValidator();
    $valid = $validator->validateDeleteRequestBody($body);
    if (!$valid) {
      require_once __DIR__ . "/../views/status/badRequest.php";
      return $view;
    }

    $sessionUser = $_SESSION["user"];
    if (!isset($sessionUser) || !CsrfProtection::compareTokens($body["csrfToken"])) {
      require_once __DIR__ . "/../views/status/unauthorized.php";
      return $view;
    }

    $user = new User(id: $sessionUser["id"]);
    $client = new AppClient();
    $client->revokeToken($sessionUser["accessToken"]);

    $row = $user->find();
    if ($row) {
      $client->revokeToken($row["refresh_token"]);
    }

    $user->delete();
    Session::destroy();

    $cache = new FileCache(
      FileCache::tutorialCompletionIndexFilename($sessionUser["id"])
    );
    $cache->delete();

    http_response_code(200);
    exit;
  }

  /**
   * Redirects to the tutorials index page.
   */
  private function redirectToTutorialIndex()
  {
    header("Location: /tutorials");
    exit;
  }
}
