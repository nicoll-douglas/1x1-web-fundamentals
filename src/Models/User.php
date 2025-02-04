<?php

declare(strict_types=1);

namespace App\Models;

use App\Classes\Model;
use App\Exceptions\NonEmptyException;

/**
 * Model to interface with the users table.
 */
class User extends Model
{
  private string $id;
  private ?string $refreshToken;
  private ?string $name;

  /**
   * Initialises the database connection and class fields.
   * @param string|null $id The user's ID.
   * @param string|null $refreshToken The user's refresh token.
   * @param string|null $name The users's name.
   */
  public function __construct(
    ?string $id = null,
    ?string $refreshToken = null,
    ?string $name = null
  ) {
    parent::__construct();
    if ($id) {
      $this->id = $id;
    }
    $this->refreshToken = $refreshToken;
    $this->name = $name;
  }

  /**
   * Inserts the user into the users table.
   * @throws NonEmptyException If the current user ID trying to be used is empty.
   * @return bool True on success, false on failure.
   */
  public function insert(): bool
  {
    $this->checkForId();
    $stmt = $this->pdo->prepare(
      "INSERT INTO users (id, name, refresh_token) VALUES (:id, :name, :token)"
    );
    $stmt->bindValue(":id", $this->id);
    $stmt->bindValue(
      ":name",
      $this->name ?: null,
      $this->name ? \PDO::PARAM_STR : \PDO::PARAM_NULL
    );
    $stmt->bindValue(
      ":token",
      $this->refreshToken ?: null,
      $this->refreshToken ? \PDO::PARAM_STR : \PDO::PARAM_NULL
    );
    return $stmt->execute();
  }

  /**
   * Finds the user from their ID.
   * @return array{ 
   *  id: string,
   *  name: string|null,
   *  refresh_token: string|null,
   *  created_at: string,
   *  updated_at: string
   * }|false false if the row is not found, the user's row otherwise.
   */
  public function find(): array|false
  {
    $this->checkForId();
    $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = $this->id");
    $stmt->execute();
    $row = $stmt->fetch();
    return $row;
  }

  /**
   * Updates a user in the users table.
   * @param bool $refreshToken Whether to set the user's refresh token.
   * @param bool $name Whether to set the user's name.
   * @throws NonEmptyException If the current user ID trying to be used is empty.
   * @return bool True on success, false on failure.
   */
  public function update(bool $refreshToken = false, bool $name = false): bool
  {
    $this->checkForId();
    $sql = "UPDATE users SET ";
    $setClauses = [];
    $params = [];

    if ($refreshToken) {
      $setClauses[] = "refresh_token = :token";
      $params[] = [
        ":token",
        $this->refreshToken ?: null,
        $this->refreshToken ? \PDO::PARAM_STR : \PDO::PARAM_NULL
      ];
    }

    if ($name) {
      $setClauses[] = "name = :name";
      $params[] = [
        ":name",
        $this->name ?: null,
        $this->name ? \PDO::PARAM_STR : \PDO::PARAM_NULL
      ];
    }

    if (empty($setClauses)) return false;

    $sql .= implode(", ", $setClauses);
    $sql .= " WHERE id = $this->id";
    $stmt = $this->pdo->prepare($sql);

    foreach ($params as $param) {
      $stmt->bindValue(...$param);
    }

    return $stmt->execute();
  }

  /**
   * Deletes a user from the users table.
   * @throws NonEmptyException If the current user ID trying to be used is empty.
   * @return bool True on success, false on failure.
   */
  public function delete(): bool
  {
    $this->checkForId();
    $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
    $stmt->bindValue(":id", $this->id);
    return $stmt->execute();
  }

  /**
   * Checks whether the current user ID is empty.
   * @throws NonEmptyException If the current user ID is empty.
   */
  private function checkForId()
  {
    $this->checkForEmpty($this->id, "id");
  }

  public function setId(string $value)
  {
    if ($value) {
      $this->id = $value;
    }
  }

  public function setRefreshToken(?string $value)
  {
    $this->refreshToken = $value;
  }

  public function getRefreshToken(): ?string
  {
    return $this->refreshToken;
  }

  public function setName(?string $value)
  {
    $this->name = $value;
  }

  public function getName(): ?string
  {
    return $this->name;
  }
}
