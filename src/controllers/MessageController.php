<?php

declare(strict_types=1);

require_once __DIR__ . "/../models/Message.php";
require_once __DIR__ . "/../config/db.php";

/**
 * Controller that handles requests and operations pertaining to the message model.
 */
class MessageController
{

  /**
   * Handles the current request and returns a view.
   * @return string The view to be displayed to the user.
   */
  public static function handleRequest(): string
  {
    switch ($_SERVER["REQUEST_METHOD"]) {
      case "POST":
        return self::post();
      default:
        http_response_code(405);
        return "Method not allowed.";
    }
  }

  /**
   * Handles posting/creation of a message and returns a view.
   * @return string The view to be displayed to the user.
   */
  private static function post(): string
  {
    $msg = $_POST["message"];
    ["error" => $error, "success" => $msg] = self::validateMessage($msg);

    if ($error) {
      http_response_code(400);
      return $error;
    };

    $pdo = connectDB();

    if (!$pdo) {
      http_response_code(500);
      return "Server Error. Something went wrong :(.";
    }

    Message::insertOne($pdo, $msg);
    http_response_code(201);
    return "Successfully submitted. Thanks for the message!";
  }

  /**
   * Validates a message against the constraints.
   * @param string $msg The message to be validated.
   * @return array{ error?: string, success?:string} Contains an error message on error, or the cleansed message on success. 
   */
  private static function validateMessage($msg)
  {
    if (!isset($msg)) {
      return ["error" => "Message must not be empty!"];
    }

    if (!is_string($msg)) {
      return ["error" => "Message must be a string!"];
    }

    $msg = trim($msg);

    if (strlen($msg) > 255) {
      return ["error" => "Message must not exceed 255 characters!"];
    }

    return ["success" => $msg];
  }
}
