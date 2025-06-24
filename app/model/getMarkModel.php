<?php

function getMarkModel(int $idPost): array|string
{
  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - getMarkModel(): " . $db->connect_error;
  }

  $sql = 'SELECT * FROM Mark
            JOIN Tag ON Mark.idTag = Tag.id
          WHERE idPost=?';
  $statement = $db->prepare($sql);
  if (!$statement) {
    return "error - getMarkModel(): failed to prepare SQL statement";
  }

  if (!$statement->bind_param('i', $idPost)) {
    $statement->close();
    return "error - getMarkModel(): failed to bind parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - getMarkModel(): failed to execute SQL statement";
  }

  $result = $statement->get_result();
  $statement->close();
  if (!$result) {
    return "error - getMarkModel(): failed to retrieve reports";
  }

  $marks = [];
  while ($row = $result->fetch_assoc()) {
    if (false === $row) {
      return "error - getMarkModel(): failed to fetch reports";
    }

    $marks[] = $row;
  }

  return $marks;
}
