<?php

/* returns a Zone instance
 * it has the following fields:
    id      BIGINT,
    name    VARCHAR,
    city    VARCHAR,
    country VARCHAR,
  * returns string on failure
 */
function addZoneModel(
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
