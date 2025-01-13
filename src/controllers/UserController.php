<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../db.php";
require_once __DIR__ . "/../middleware/Session.php";
require_once __DIR__ . "/../middleware/Authentication.php";
require_once __DIR__ . "/../services/google_api/client.php";
require_once __DIR__ . "/../utils/hashIP.php";

/**
 * Controller that handles requests pertaining to authentication.
 */
class UserController
{
  /**
   * Handles the request to the OAuth redirect URI upon authentication with Google.
   * @return string An error message for the user if not redirected once authenticated.
   */
  public static function handleLogin()
  {
    if (isset($_GET["code"])) {
      // attempt to exchange for access token
      $client = getAPIClient();
      $token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);
      if (!$token) {
        http_response_code(500);
        return "Server Error. Something went wrong.";
      }

      // get user information
      $client->setAccessToken($token);
      $oauth2 = new Google\Service\Oauth2($client);
      $user_info = $oauth2->userinfo->get();

      // store user data in the session
      $ip_salt = bin2hex(random_bytes(16));
      Session::start();
      $_SESSION["user"] = [
        "id" => $user_info["id"],
        "access_token" => $client->getAccessToken(),
        "ip_hash" => hashIP($_SERVER["REMOTE_ADDR"], $ip_salt),
        "ip_salt" => $ip_salt,
      ];

      // set up fields to update/add for user
      $fields = [
        "name" => $user_info["name"],
      ];
      $new_refresh_token = $client->getRefreshToken();
      if ($new_refresh_token) {
        $fields["refresh_token"] = $new_refresh_token;
      }

      // retrieve user information
      $user_instance = new User($user_info["id"]);
      $row = $user_instance->find();

      // if user doesn't exist, insert fields
      if (!$row) {
        $fields["id"] = $user_info["id"];
        $user_instance->insert($fields);
        return self::redirectToTutorials();
      }

      // if refresh token different, revoke current
      $current_refresh_token = $row["refresh_token"];
      if ($current_refresh_token !== $new_refresh_token) {
        $client->revokeToken($current_refresh_token);
      }

      // update user
      $user_instance->update($fields);
      return self::redirectToTutorials();
    }

    // check for error message
    $error = $_GET["error"];
    if (isset($error)) {
      http_response_code(400);
      return "OAuth Error: $error";
    }

    // bad request
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

  /**
   * Handles the deletion of a user's account/data
   * @return string A message to display to the user based on success status.
   */
  public static function handleDelete(): string
  {
    // check for session
    Session::start();
    $user = $_SESSION["user"];
    if (!isset($user)) {
      http_response_code(400);
      return "Bad Request. Please login to delete your account.";
    }

    // delete user and session
    $user_instance = new User($user["id"]);
    $user_instance->delete();
    Authentication::revoke();
    Session::destroy();

    return "Data successfully deleted.";
  }

  /**
   * Redirects to the tutorials index page.
   */
  private static function redirectToTutorials()
  {
    header("Location: /tutorials/index.php");
    exit;
  }
}
