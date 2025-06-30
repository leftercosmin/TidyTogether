<?php

/**
 * Gets all recycling areas with their coordinates and tag information
 * @param int|null $cityId Optional city ID to filter by specific city
 * @return array|string Returns array of recycling areas or error string
 */
function getRecyclingAreaModel(?int $cityId = null): array|string
{
  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - getRecyclingAreaModel(): " . $db->connect_error;
  }

  $sql = "SELECT 
    ra.idTag, 
    ra.idUser, 
    ra.idCoordinate,
    ra.createdAt,
    c.lat, 
    c.lng,
    c.address,
    c.idCity,
    t.name as tagName,
    t.description as tagDescription,
    u.name as userName
  FROM RecyclingArea ra
  JOIN Coordinate c ON ra.idCoordinate = c.id
  JOIN Tag t ON ra.idTag = t.id
  JOIN User u ON ra.idUser = u.id";

  $params = [];
  $types = "";

  if ($cityId !== null) {
    $sql .= " WHERE c.idCity = ?";
    $params[] = $cityId;
    $types = "i";
  }

  $sql .= " ORDER BY ra.createdAt DESC";

  $statement = $db->prepare($sql);
  if (!$statement) {
    return "error - getRecyclingAreaModel(): failed to prepare SQL statement";
  }

  if (!empty($params)) {
    if (!$statement->bind_param($types, ...$params)) {
      $statement->close();
      return "error - getRecyclingAreaModel(): failed to bind parameters";
    }
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - getRecyclingAreaModel(): failed to execute SQL statement";
  }

  $result = $statement->get_result();
  $statement->close();
  
  if (!$result) {
    return "error - getRecyclingAreaModel(): failed to get result";
  }

  $recyclingAreas = [];
  while ($row = $result->fetch_assoc()) {
    $recyclingAreas[] = $row;
  }

  return $recyclingAreas;
}

/**
 * Gets recycling areas for a specific coordinate
 * @param int $idCoordinate The coordinate ID
 * @return array|string Returns array of recycling areas or error string
 */
function getRecyclingAreaByCoordinateModel(int $idCoordinate): array|string
{
  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - getRecyclingAreaByCoordinateModel(): " . $db->connect_error;
  }

  $sql = "SELECT 
    ra.idTag, 
    ra.idUser, 
    ra.idCoordinate,
    ra.createdAt,
    c.lat, 
    c.lng,
    c.address,
    c.idCity,
    t.name as tagName,
    t.description as tagDescription,
    u.name as userName
  FROM RecyclingArea ra
  JOIN Coordinate c ON ra.idCoordinate = c.id
  JOIN Tag t ON ra.idTag = t.id
  JOIN User u ON ra.idUser = u.id
  WHERE ra.idCoordinate = ?
  ORDER BY t.name";

  $statement = $db->prepare($sql);
  if (!$statement) {
    return "error - getRecyclingAreaByCoordinateModel(): failed to prepare SQL statement";
  }

  if (!$statement->bind_param('i', $idCoordinate)) {
    $statement->close();
    return "error - getRecyclingAreaByCoordinateModel(): failed to bind parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - getRecyclingAreaByCoordinateModel(): failed to execute SQL statement";
  }

  $result = $statement->get_result();
  $statement->close();
  
  if (!$result) {
    return "error - getRecyclingAreaByCoordinateModel(): failed to get result";
  }

  $recyclingAreas = [];
  while ($row = $result->fetch_assoc()) {
    $recyclingAreas[] = $row;
  }

  return $recyclingAreas;
}
