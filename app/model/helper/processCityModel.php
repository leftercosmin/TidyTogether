<?php

function processCityModel(string $city, int $id): string
{
  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - processCityModel(): " . $db->connect_error;
  }

  $sql = 'UPDATE User SET mainCity=? WHERE id=?';
  $statement = $db->prepare($sql);
  if (!$statement) {
    return "error - processCityModel(): failed to prepare SQL statement";
  }

  if (!$statement->bind_param('si', $city, $id)) {
    $statement->close();
    return "error - processCityModel(): failed to bind parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - processCityModel(): failed to execute SQL statement";
  }

  $statement->close();
  return ""; // success
}
