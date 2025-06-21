<?php

function addMarksModel(int $idPost, array $marks): string
{
  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - addMarksModel(): " . $db->connect_error;
  }

  foreach ($marks as $tag) {

    $statement =
      $db->prepare(
        'INSERT INTO Mark (idTag, idPost) VALUES (?, ?)'
      );
    if (!$statement) {
      return "error - addMarksModel(): failed to prepare SQL statement";
    }

    if (
      !$statement->bind_param(
        'ii',
        $tag["id"],
        $idPost
      )
    ) {
      $statement->close();
      return "error - addMarksModel(): failed to bind parameters";
    }

    if (!$statement->execute()) {
      $statement->close();
      return "error - addMarksModel(): failed to execute SQL statement";
    }

    $statement->close();
  }

  return ""; // success
}

