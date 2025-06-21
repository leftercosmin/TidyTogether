<?php

/* returns what the id of the Zone
 * or string on failure
 */
function addZoneModel(
  mysqli $db,
  string $zone,
  string $city,
  string $country
): int|string {

  // check existance
  $resultZone = getZoneModel(
    $db,
    $zone,
    $city,
    $country
  );

  if (!is_null($resultZone)) {
    if (is_string($resultZone)) {
      return $resultZone;
    }
    return $resultZone["id"];
  }

  // insert
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

  $statement->close();
  return $db->insert_id;
}
