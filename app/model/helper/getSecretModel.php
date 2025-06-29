<?php

function getSecretModel(
  string $role,
  string|null $secret
): array|string {

  if ("civilian" === $role) {
    if ("" !== $secret) {
      return "error - getSecretModel(): civilian inserted secret";
    }

    return ""; // all good mate
  }

  // TESTING
  return "";
  
  // ORIGINAL
  // it's guranteed: role=supervisor/authority - secret must be valid
  // if (is_null($secret) || "" === $secret) {
  //   return "error - getSecretModel(): null secret";
  // }

  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - getSecretModel(): " . $db->connect_error;
  }

  $statement =
    $db->prepare(
      'SELECT * FROM Secret WHERE hashed=?'
    );
  if (!$statement) {
    return "error - getSecretModel(): failed to prepare SELECT statement";
  }

  if (!$statement->bind_param('s', $secret)) {
    $statement->close();
    return "error - getSecretModel(): failed to bind SELECT parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - getSecretModel(): failed to execute SELECT";
  }

  $result = $statement->get_result();
  $statement->close();
  if (!$result) {
    return "error - getSecretModel(): failed to fetch result";
  }

  $row = $result->fetch_assoc();
  if (false === $row) {
    return "error - getSecretModel(): failed to fetch row";
  }

  // the secret does not exist
  if (is_null($row) || empty($row)) {
    return "error - getSecretModel(): invalid secret";
  }

  // the secret is already used by someone else
  if (!is_null($row["email"])) {
    return "error - getSecretModel(): wasted secret";
  }

  return $row; // success - the update can be done
}
