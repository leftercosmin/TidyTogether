<?php

function getMainCity(int $id): string
{
  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - getMainCity(): " . $db->connect_error;
  }

  $sql = 'SELECT mainCity FROM User
            WHERE id=?';

  $statement = $db->prepare($sql);
  if (!$statement) {
    return "error - getMainCity(): failed to prepare SQL statement";
  }

  if (!$statement->bind_param('i', $id)) {
    $statement->close();
    return "error - getMainCity(): failed to bind parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - getMainCity(): failed to execute SQL statement";
  }

  $result = $statement->get_result();
  $statement->close();
  if (false === $result) {
    return "error - getMainCity(): failed to retrieve main city";
  }

  $arr = $result->fetch_assoc();

  if($arr === null || !isset($arr['mainCity']) || $arr['mainCity'] === null) {
    return "";
  }

  return $arr['mainCity'];
}
