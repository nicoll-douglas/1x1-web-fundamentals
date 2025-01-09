<?php

declare(strict_types=1);

/**
 * Model that represents the messages table.
 */
class Message
{
  public static function insertOne(PDO $pdo, string $msg)
  {
    $stmt = $pdo->prepare("INSERT INTO messages (message) VALUES (:message)");
    $stmt->bindParam(':message', $msg, PDO::PARAM_STR);
    $stmt->execute();
  }
}
