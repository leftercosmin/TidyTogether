<?php

require_once "model/helper/addZoneModel.php";
require_once "model/helper/getZoneModel.php";

/**
 * Summary of addPostModel
 * @param string $idUser
 * @param string|null $description
 * @param string $address
 * @param string $zone
 * @param string $city
 * @param string $country
 * @return int on success, the Post id
 * @return string on failure, the error message
 */
function addPostModel(
  string $idUser,
  string|null $description,
  string $address,
  string $zone,
  string $city,
  string $country,
): int|string {

  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - addPostModel(): " . $db->connect_error;
  }

  // zone updates, be aware - conditional insertion
  $idZone = addZoneModel(
    $db,
    $zone,
    $city,
    $country
  );

  if (!is_null($idZone) && is_string($idZone)) {
    return $idZone;
  }

  // actual work
  $statement =
    $db->prepare(
      'INSERT INTO Post (description, idUser, idZone, address)
      VALUES (?, ?, ?, ?)'
    );
  if (!$statement) {
    return "error - addPostModel(): failed to prepare SQL statement";
  }

  if (
    !$statement->bind_param(
      'siis',
      $description,
      $idUser,
      $idZone,
      $address
    )
  ) {
    $statement->close();
    return "error - addPostModel(): failed to bind parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - addPostModel(): failed to execute SQL statement";
  }

  $statement->close();

  if (is_string($$db->insert_id)) {
    alert("warning - addPostModel(): id is string");
  }
  return $db->insert_id;
}
