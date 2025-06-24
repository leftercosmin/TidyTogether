<?php

function processFnameModel(string $fname, int $id): string
{
  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - processFnameModel(): " . $db->connect_error;
  }

  $sql = 'UPDATE User SET fname=? WHERE id=?';
  $statement = $db->prepare($sql);
  if (!$statement) {
    return "error - processFnameModel(): failed to prepare SQL statement";
  }

  if (!$statement->bind_param('si', $fname, $id)) {
    $statement->close();
    return "error - processFnameModel(): failed to bind parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - processFnameModel(): failed to execute SQL statement";
  }

  $statement->close();
  return ""; // success
}
