<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../models/RefreshToken.php";
require_once __DIR__ . "/../db.php";
require_once __DIR__ . "/../middleware/Session.php";
require_once __DIR__ . "/../middleware/Authentication.php";
require __DIR__ . "/../services/google_api/client.php";
require_once __DIR__ . "/../utils/hashIP.php";

/**
 * Controller that handles requests pertaining to authentication.
 */
class AuthController
{
  /**
   * Handles the redirect request upon authentication with Google.
   * @return string An error view if not redirected once authenticated.
   */
  public static function handleUserConsent()
  {
    if (isset($_GET["code"])) {
      global $client;
      Session::start();

      $token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);
      $client->setAccessToken($token);

      $oauth2 = new Google\Service\Oauth2($client);
      $user_info = $oauth2->userinfo->get();
      $user_id = $user_info["id"];
      $ip_salt = bin2hex(random_bytes(16));

      $_SESSION["user"] = [
        "id" => $user_id,
        "access_token" => $client->getAccessToken(),
        "ip" => hashIP($_SERVER["REMOTE_ADDR"], $ip_salt),
        "ip_salt" => $ip_salt,
        "name" => $user_info["name"]
      ];

      $refresh_token = $client->getRefreshToken();

      if ($refresh_token) {
        $pdo = connectDB();

        if (!$pdo) {
          Authentication::revoke(true);
          Session::destroy();
          http_response_code(500);
          return "Server Error. Something went wrong.";
        }

        $row = RefreshToken::find($pdo, $user_id);

        if ($row) {
          if ($row["token"] !== $refresh_token) {
            $client->revokeToken($row["token"]);
            RefreshToken::update($pdo, $user_id, $refresh_token);
          }
        } else {
          RefreshToken::insert($pdo, $user_id, $refresh_token);
        }
      }

      header("Location: /tutorials/index.php");
      exit;
    }

    $error = $_GET["error"];
    if (isset($error)) {
      http_response_code(400);
      return "OAuth Error: $error";
    }

    http_response_code(400);
    return "Bad request.";
  }

  /**
   * Handles a logout request and redirects to the home page.
   */
  public static function handleLogout()
  {
    Session::start();
    Authentication::revoke();
    Session::destroy();
    header("Location: /");
    exit;
  }
}
