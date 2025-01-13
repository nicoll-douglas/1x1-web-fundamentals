<?php

declare(strict_types=1);

require_once __DIR__ . "/../db.php";

/**
 * Model that represents a user.
 */
class User
{
  private string $id;
  private PDO $pdo;

  public function __construct(string $id)
  {
    $this->id = $id;
    $this->pdo = connectDB();
  }

  /**
   * Inserts a user into the users table.
   * @param array $fields The fields of the user.
   * @return int The number of rows affected.
   */
  public function insert(array $fields)
  {
    $fields_list = [];
    $params_list = [];
    $params = [];

    foreach ($fields as $key => $value) {
      $fields_list[] = $key;
      $param = ":$key";
      $params_list[] = $param;
      $params[$param] = $value;
    }

    $sql =
      "INSERT INTO users ("
      . implode(", ", $fields_list)
      . ") VALUES ("
      . implode(", ", $params_list)
      . ")";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->rowCount();
  }

  /**
   * Finds the user from their id.
   * @return array|false false if the row is not found, the user's row otherwise.
   */
  public function find(): array|false
  {
    $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = $this->id");
    $stmt->execute();
    $row = $stmt->fetch();
    return $row;
  }

  /**
   * Updates a user based on their id.
   * @param array $fields Fields of the user to update.
   * @return int The number of rows affected.
   */
  public function update(array $fields): int
  {
    $sql = "UPDATE users SET ";
    $params = [];
    $updates = [];

    foreach ($fields as $key => $value) {
      $param = ":$key";
      $updates[] = "$key = $param";
      $params[":$key"] = $value;
    }
    $sql .= implode(", ", $updates);
    $sql .= " WHERE id = $this->id";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt->rowCount();
  }

  /**
   * Deletes a user based on their id.
   * @return int The number of rows affected.
   */
  public function delete(): int
  {
    $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = $this->id");
    $stmt->execute();
    return $stmt->rowCount();
  }
}
