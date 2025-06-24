<?php

function processLnameModel(string $lname, int $id): string
{
  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - processLnameModel(): " . $db->connect_error;
  }

  $sql = 'UPDATE User SET lname=? WHERE id=?';
  $statement = $db->prepare($sql);
  if (!$statement) {
    return "error - processLnameModel(): failed to prepare SQL statement";
  }

  if (!$statement->bind_param('si', $lname, $id)) {
    $statement->close();
    return "error - processLnameModel(): failed to bind parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - processLnameModel(): failed to execute SQL statement";
  }

  $statement->close();
  return ""; // success
}
