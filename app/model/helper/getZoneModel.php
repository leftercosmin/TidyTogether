<?php

/* returns a Zone instance
 * it has the following fields:
    id      BIGINT,
    name    VARCHAR,
    city    VARCHAR,
    country VARCHAR,
  * returns string on failure
 */
function getZoneModel(
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
    return "error - getZoneModel(): failed to prepare SQL statement";
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
    return "error - getZoneModel(): failed to bind parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - getZoneModel(): failed to execute SQL statement";
  }

  $result = $statement->get_result();
  $statement->close();
  $row = $result->fetch_assoc();
  if (!$result || false === $row) {
    return "error - getZoneModel(): failed to fetch result";
  }

  return $row;
}
