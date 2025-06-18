<?php

/* returns a Zone instance
 * it has the following fields:
    id      BIGINT,
    name    VARCHAR,
    city    VARCHAR,
    country VARCHAR,
  * returns string on failure
 */
function getZone(
  mysqli $db,
  string $zone,
  string $city,
  string $country
): array|string {

  $statement =
    $db->prepare(
      'SELECT id FROM Zone WHERE name=? AND city=? AND country=?'
    );
  if (!$statement) {
    return "error - getZone(): failed to prepare SQL statement";
  }

  if (
    !$statement->bind_param(
      'sss',
      $zone,
      $city,
      $country
    )
  ) {
    $statement->close();
    return "error - getZone(): failed to bind parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - getZone(): failed to execute SQL statement";
  }

  $result = $statement->get_result();
  $statement->close();
  $row = $result->fetch_assoc();
  if (!$result || false === $row) {
    return "error - getZone(): failed to fetch result";
  }

  return $row;
}

/* returns a Zone instance
 * it has the following fields:
    id      BIGINT,
    name    VARCHAR,
    city    VARCHAR,
    country VARCHAR,
  * returns string on failure
 */
function addZone(
  mysqli $db,
  string $zone,
  string $city,
  string $country
): string {

  $statement =
    $db->prepare(
      'INSERT INTO Zone (name, city, country) VALUES (?, ?, ?)'
    );
  if (!$statement) {
    return "error - addZone(): failed to prepare SQL statement";
  }

  if (
    !$statement->bind_param(
      'sss',
      $zone,
      $city,
      $country
    )
  ) {
    $statement->close();
    return "error - addZone(): failed to bind parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - addZone(): failed to execute SQL statement";
  }

  $result = $statement->get_result();
  $statement->close();
  $row = $result->fetch_assoc();
  if (!$result || false === $row) {
    return "error - addZone(): failed to fetch result";
  }

  return $row;
}

function addPost(
  string $userId,
  string|null $description,
  string $address,
  string $zone,
  string $city,
  string $country,
  string|null $media,
  string $tags,
): string {

  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - addPost(): " . $db->connect_error;
  }

  $result = getZone($db, $zone, $city, $country);
  if (null === $result) {
    $result = addZone($db, $zone, $city, $country);
  }

  // actual work
  $statement =
    $db->prepare(
      'INSERT INTO Post (description, idUser, idZone, address)
      VALUES (?, ?, ?, ?)'
    );
  if (!$statement) {
    return "error - addPost(): failed to prepare SQL statement";
  }

  if (
    !$statement->bind_param(
      'ssss',
      $description,
      $userId,
      $result["id"],
      $address
    )
  ) {
    $statement->close();
    return "error - addPost(): failed to bind parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - addPost(): failed to execute SQL statement";
  }

  $result = $statement->get_result();
  $statement->close();
  if (!$result) {
    return "error - addPost(): failed to get result";
  }

  $row = $result->fetch_assoc();
  if (false === $row) {
    return "error - addPost(): failed to fetch result";
  }

  //addMedia();
  //addTags();
  return ""; // success
}