<?php

require_once "model/helper/getZoneModel.php";
require_once "model/helper/addMediaModel.php";
require_once "model/helper/addMediaModel.php";

function addPostModel(
  string $userId,
  string|null $description,
  string $address,
  string $zone,
  string $city,
  string $country,
  array $media,
  string $tags,
): string {

  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - addPostModel(): " . $db->connect_error;
  }

  $resultZone = getZoneModel(
    $db,
    $zone,
    $city,
    $country
  );

  if (null === $resultZone) {
    $resultZone = addZoneModel(
      $db,
      $zone,
      $city,
      $country
    );
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
      $userId,
      $resultZone["id"],
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

  $resultPost = $statement->get_result();
  $statement->close();
  if (!$resultPost) {
    return "error - addPostModel(): failed to get result";
  }

  $row = $resultPost->fetch_assoc();
  if (false === $row) {
    return "error - addPostModel(): failed to fetch result";
  }

  addMediaModel($db, $media, $row["id"]);
  //addTags();
  return ""; // success
}