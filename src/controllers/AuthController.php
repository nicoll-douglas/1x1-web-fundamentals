<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../models/RefreshToken.php";
require_once __DIR__ . "/../config/db.php";

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
    require_once __DIR__ . "/../middleware/session.php";

    if (isset($_GET["code"])) {
      require __DIR__ . "/../services/google_api/client.php";
      $token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);
      $client->setAccessToken($token);

      $oauth2 = new Google\Service\Oauth2($client);
      $user_info = $oauth2->userinfo->get();
      $user_id = $user_info["id"];

      $_SESSION["user"] = [
        "id" => $user_id,
        "access_token" => $token["access_token"]
      ];

      $pdo = connectDB();

      if ($pdo) {
        $row = RefreshToken::find($pdo, $user_id);
        $refresh_token = $token["refresh_token"];

        if ($row) {
          RefreshToken::update($pdo, $user_id, $refresh_token);
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

    http_response_code(500);
    return "Something went wrong.";
  }

  /**
   * Handles a logout request and redirects to the home page.
   */
  public static function handleLogout()
  {
    require_once __DIR__ . "/../middleware/session.php";

    $user = $_SESSION["user"];

    if (!isset($user)) {
      header("Location: /");
      exit;
    }
    require __DIR__ . "/../services/google_api/client.php";

    $client->revokeToken($user["access_token"]);
    $pdo = connectDB();

    if ($pdo) {
      $row = RefreshToken::find($pdo, $user["id"]);
      if ($row) {
        $client->revokeToken($row["refresh_token"]);
      }
      RefreshToken::clear($pdo, $user["id"]);
    }

    session_unset();
    session_destroy();

    header("Location: /");
    exit;
  }
}
