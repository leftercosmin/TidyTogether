<?php

/* returns an array of instances consisting of:
    id    BIGINT
    name  VARCHAR
    color ENUM
 * returns string on error
 */
function getTagModel(): array|string
{
  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - getTagModel(): " . $db->connect_error;
  }

  $result = $db->query('SELECT * FROM Tag');
  if (!$result) {
    return "error - getTagModel(): failed to execute SQL statement";
  }

  $tags = [];
  while ($row = $result->fetch_assoc()) {
    if (false === $row) {
      return "error - getTagModel(): failed to fetch result";
    }

    $tags[] = $row;
  }

  return $tags;
}
