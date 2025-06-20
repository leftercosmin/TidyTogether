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
function getProfileModel(int $id): array|string
{
  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - getProfileModel(): " . $db->connect_error;
  }

  $statement =
    $db->prepare('SELECT * FROM User WHERE id=?');
  if (!$statement) {
    return "error - getProfileModel(): failed to prepare SQL statement";
  }

  if (!$statement->bind_param('i', $id)) {
    $statement->close();
    return "error - getProfileModel(): failed to bind parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - getProfileModel(): failed to bind parameters";
  }

  $result = $statement->get_result();
  $statement->close();

  if (!$result || 1 !== $result->num_rows) {
    return "error - getProfileModel(): failed to retrieve profile";
  }

  $row = $result->fetch_assoc();
  if (false === $row) {
    return "error - getProfileModel(): failed to fetch profile";
  }

  return $row;
}
