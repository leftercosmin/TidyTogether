<?php

require_once "model/helper/getSecretModel.php";

function addSecretModel(
  string $role,
  string $email,
  string|null $secret
): string {

  $check = getSecretModel($role, $secret);
  if (is_string($check)) {
    return $check; // either error or success as civilian
  }

  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - addSecretModel(): " . $db->connect_error;
  }

  $statement =
    $db->prepare(
      'UPDATE Secret SET email=? WHERE hashed=?'
    );
  if (!$statement) {
    return "error - addSecretModel(): failed to prepare SELECT statement";
  }

  if (!$statement->bind_param('ss', $email, $secret)) {
    $statement->close();
    return "error - addSecretModel(): failed to bind SELECT parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - addSecretModel(): failed to execute SELECT";
  }

  $statement->close();
  return ""; // success
}
