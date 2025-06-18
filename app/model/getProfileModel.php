<?php

/* returns a Profile instance consisting of:
    id        BIGINT,
    email     VARCHAR,
    password  VARCHAR,
    fname     VARCHAR,
    lname     VARCHAR,
    role      ENUM,
    createdAt DATETIME,
    updatedAt DATETIME
  * returns string on failure
 */
function getProfile(int $id): array|string
{
  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - getProfile(): " . $db->connect_error;
  }

  $statement =
    $db->prepare('SELECT * FROM User WHERE id=?');
  if (!$statement) {
    return "error - getProfile(): failed to prepare SQL statement";
  }

  if (!$statement->bind_param('i', $id)) {
    $statement->close();
    return "error - getProfile(): failed to bind parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - getProfile(): failed to bind parameters";
  }

  $result = $statement->get_result();
  $statement->close();

  if (!$result || 1 !== $result->num_rows) {
    return "error - getProfile(): failed to retrieve profile";
  }

  $row = $result->fetch_assoc();
  if (false === $row) {
    return "error - getProfile(): failed to fetch profile";
  }

  return $row;
}
