<?php

class RefreshToken
{
  /**
   * Inserts a refresh token and associated user id into the refresh_tokens table.
   * @param PDO $pdo The database connection.
   * @param string $user_id The associated user id of the token.
   * @param string $refresh_token The refresh token.
   * @return int The number of rows added.
   */
  public static function insert(PDO $pdo, string $user_id, string $refresh_token): int
  {
    $stmt = $pdo->prepare(
      "INSERT INTO refresh_tokens (user_id, token) VALUES (:id, :token)"
    );
    $stmt->execute([
      ":id" => $user_id,
      ":token" => $refresh_token
    ]);
    return $stmt->rowCount();
  }

  /**
   * Finds a row in the refresh_tokens table from the associated user id.
   * @param PDO $pdo The database connection.
   * @param string $user_id The associated user id of the token.
   * @return array|null null if the row is not found, the user's row otherwise.
   */
  public static function find(PDO $pdo, string $user_id): array
  {
    $stmt = $pdo->prepare(
      "SELECT * FROM refresh_tokens WHERE user_id = :id"
    );
    $stmt->execute([
      ":id" => $user_id
    ]);

    $row = $stmt->fetch();
    return $row;
  }

  /**
   * Updates a refresh token for the associated user id in the refresh_tokens table.
   * @param PDO $pdo The database connection.
   * @param string $user_id The user_id whos token is to be updated.
   * @param string $new_token The new refresh token.
   * @return int The number of rows updated.
   */
  public static function update(PDO $pdo, string $user_id, string $new_token): int
  {
    $stmt = $pdo->prepare(
      "UPDATE refresh_tokens SET token = :token WHERE user_id = :id"
    );
    $stmt->execute([
      ":token" => $new_token,
      ":id" => $user_id
    ]);
    return $stmt->rowCount();
  }

  /**
   * Clears a refresh token for the associated user id.
   * @param PDO $pdo The database connection.
   * @param string $user_id The associated user id of the refresh token.
   * @return int The number of rows updated.
   */
  public static function clear(PDO $pdo, string $user_id): int
  {
    $stmt = $pdo->prepare(
      "UPDATE refresh_tokens SET token = NULL WHERE user_id = :id"
    );
    $stmt->execute([
      ":id" => $user_id
    ]);
    return $stmt->rowCount();
  }
}
