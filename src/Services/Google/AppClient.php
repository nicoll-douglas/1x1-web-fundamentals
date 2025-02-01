<?php

declare(strict_types=1);

namespace App\Services\Google;

/**
 * Extends the Google API client with more app specific methods.
 */
class AppClient extends \Google\Client
{
  /**
   * Configures the client with the necessary app configuration.
   */
  public function __construct()
  {
    parent::__construct();
    $this->setAuthConfig(__DIR__ . "/../../../secrets/google_oauth_client_secret.json");
    $this->setRedirectUri(getenv("GOOGLE_AUTH_REDIRECT_URI"));
    $this->setAccessType("offline");
    $this->addScope("profile");
  }

  /**
   * Attemps to relay an auth code from the current request to Google in exchange for an access token.
   * @return false|array False on failure, the access token on success.
   */
  public function relayAuthCode(): false|array
  {
    if (!isset($_GET["code"])) return false;

    $token = $this->fetchAccessTokenWithAuthCode($_GET["code"]);
    if (!$token || $token["error"]) return false;

    return $token;
  }

  /**
   * Gets the current user's info, assuming an access token is loaded into the client.
   * @return \Google\Service\Oauth2\Userinfo|false The user's info on success or false on failure.
   */
  public function getUserInfo(): \Google\Service\Oauth2\Userinfo|false
  {
    try {
      $oauth2 = new \Google\Service\Oauth2($this);
      return $oauth2->userinfo->get();
    } catch (\Google\Service\Exception $e) {
      return false;
    }
  }

  /**
   * Revokes all current tokens loaded into the client.
   */
  public function revokeAllTokens()
  {
    $this->revokeToken($this->getAccessToken());
    $this->revokeToken($this->getRefreshToken());
  }
}
