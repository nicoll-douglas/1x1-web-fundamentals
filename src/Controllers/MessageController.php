<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Message;
use App\Validation\MessageValidator;
use App\Classes\View;

/**
 * Controller for the Message model.
 */
class MessageController
{
  /**
   * Handles posting/creation of a message and returns a view.
   * @return View The view to be displayed to the user.
   */
  public function create(): View
  {
    $msg = $_POST["message"];
    $validator = new MessageValidator();
    ["error" => $errorMsg, "success" => $msg] = $validator->validateCreate($msg);

    if ($errorMsg) {
      require_once __DIR__ . "/../views/status/badRequest.php";
      return $view;
    };

    $message = new Message($msg);
    $success = $message->insert();

    if ($success) {
      require_once __DIR__ . "/../views/status/submitted.php";
      $view->setStatus(201);
      return $view;
    }

    require_once __DIR__ . "/../views/status/serverError.php";
    return $view;
  }
}
