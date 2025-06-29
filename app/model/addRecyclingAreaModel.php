<?php

/**
 * inserts into the database
 * @param array $tags is never empty
 */
function addRecyclingAreaModel(
  array $tags,
  int $idUser,
  int $idCoordinate,
): string {

  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - addRecyclingAreaModel(): " . $db->connect_error;
  }

  alert("dada");

  $sql = "INSERT INTO RecyclingArea (idTag, idUser, idCoordinate)
    VALUES (?,?,?)";

  foreach ($tags as $tag) {
    $statement = $db->prepare($sql);
    if (!$statement) {
      return "error - addRecyclingAreaModel(): failed to prepare SQL statement";
    }

    if (
      !$statement->bind_param(
        'iii',
        $tag["id"],
        $idUser,
        $idCoordinate
      )
    ) {
      $statement->close();
      return "error - addRecyclingAreaModel(): failed to bind parameters";
    }

    if (!$statement->execute()) {
      $statement->close();
      return "error - addRecyclingAreaModel(): failed to execute SQL statement";
    }

    $statement->close();
  }

  return ""; // success
}
