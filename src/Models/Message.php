<?php

declare(strict_types=1);

namespace App\Models;

use App\Classes\Model;
use App\Exceptions\NonEmptyException;

/**
 * Model to interface with the messages table.
 */
class Message extends Model
{
  private string $message;

  public function __construct(?string $message = null)
  {
    parent::__construct();
    if ($message) {
      $this->message = $message;
    }
  }

  /**
   * Inserts the message into the messages table.
   * @throws NonEmptyException If the message value trying to be inserted is empty.
   * @return bool True on successful insert, false otherwise.
   */
  public function insert(): bool
  {
    if (!$this->message) {
      throw new NonEmptyException('$message');
    };
    $stmt = $this->pdo->prepare("INSERT INTO messages (message) VALUES (:message)");
    $stmt->bindParam(':message', $this->message, \PDO::PARAM_STR);
    return $stmt->execute();
  }

  public function setMessage(string $value)
  {
    $this->message = $value;
  }
}
