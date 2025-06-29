<?php

function addCoordinateModel(
  string|null $address,
  float $lat,
  float $lon
): int|string {

  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - addCoordinateModel(): " . $db->connect_error;
  }

  $statement =
    $db->prepare(
      'INSERT INTO Coordinate (address, lat, lng)
      VALUES (?, ?, ?)'
    );
  if (!$statement) {
    return "error - addCoordinateModel(): failed to prepare SQL statement";
  }

  if (
    !$statement->bind_param(
      'sdd',
      $address,
      $lat,
      $lon
    )
  ) {
    $statement->close();
    return "error - addCoordinateModel(): failed to bind parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - addCoordinateModel(): failed to execute SQL statement";
  }

  $statement->close();

  if (is_string($db->insert_id)) {
    alert("warning - addCoordinateModel(): id is string");
  }
  return $db->insert_id;
}
