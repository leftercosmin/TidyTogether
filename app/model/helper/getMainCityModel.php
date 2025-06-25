<?php

function getMainCityModel(int $id): string|null
{
  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - getMainCityModel(): " . $db->connect_error;
  }

  $sql = 'SELECT mainCity FROM User
            WHERE id=?';

  $statement = $db->prepare($sql);
  if (!$statement) {
    return "error - getMainCityModel(): failed to prepare SQL statement";
  }

  if (!$statement->bind_param('i', $id)) {
    $statement->close();
    return "error - getMainCityModel(): failed to bind parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - getMainCityModel(): failed to execute SQL statement";
  }

  $result = $statement->get_result();
  $statement->close();
  if (false === $result) {
    return "error - getMainCityModel(): failed to retrieve main city";
  }

  $arr = $result->fetch_assoc();
  return $arr['mainCity'];
}
