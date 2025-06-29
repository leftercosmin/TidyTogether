<?php

function getCoordinateModel(float $lat, float $lon): int|string
{
  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - getCoordinateModel(): " . $db->connect_error;
  }

  $statement =
    $db->prepare(
      'SELECT * FROM Coordinate
        WHERE lat=? AND lng=?'
    );
  if (!$statement) {
    return "error - getCoordinateModel(): failed to prepare SQL statement";
  }

  if (
    !$statement->bind_param(
      'dd',
      $lat,
      $lon
    )
  ) {
    $statement->close();
    return "error - getCoordinateModel(): failed to bind parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - getCoordinateModel(): failed to execute SQL statement";
  }

  $result = $statement->get_result();
  $statement->close();
  if (!$result) {
    return "error - getCoordinateModel(): failed to get result";
  }

  // not found
  if (0 == $result->num_rows) {
    return -1;
  }

  $row = $result->fetch_assoc();
  if (false === $row) {
    return "error - getCoordinateModel(): failed to fetch";
  }

  return $row["id"];
}
