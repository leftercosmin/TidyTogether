<?php

function deleteAreaModel(int $coordId): string
{
  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - deleteAreaModel(): " . $db->connect_error;
  }

  $sql = "DELETE FROM Coordinate WHERE id=?";
  $stmt = $db->prepare($sql);
  if (!$stmt) {
    return "error - deleteAreaModel(): failed to prepare SQL statement";
  }

  if (!$stmt->bind_param("i", $coordId)) {
    $stmt->close();
    return "error - deleteAreaModel(): failed to prepare SQL statement";
  }

  if (!$stmt->execute()) {
    $stmt->close();
    return "error - deleteAreaModel(): failed to execute SQL statement";
  }

  $stmt->close();
  return ""; // success
}
