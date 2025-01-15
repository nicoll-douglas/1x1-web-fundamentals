<?php

declare(strict_types=1);

/**
 * Model that represents a message.
 */
class Message
{
  /**
   * Inserts a message into the messages table.
   */
  public static function insertOne(PDO $pdo, string $msg)
  {
    $stmt = $pdo->prepare("INSERT INTO messages (message) VALUES (:message)");
    $stmt->bindParam(':message', $msg, PDO::PARAM_STR);
    $stmt->execute();
  }
}
