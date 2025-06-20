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
): array|string {

  $statement =
    $db->prepare(
      'INSERT INTO Zone (name, city, country) VALUES (?, ?, ?)'
    );
  if (!$statement) {
    return "error - addZoneModel(): failed to prepare SQL statement";
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
    return "error - addZoneModel(): failed to bind parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - addZoneModel(): failed to execute SQL statement";
  }

  $result = $statement->get_result();
  $statement->close();
  $row = $result->fetch_assoc();
  if (!$result || false === $row) {
    return "error - addZoneModel(): failed to fetch result";
  }

  return $row;
}
