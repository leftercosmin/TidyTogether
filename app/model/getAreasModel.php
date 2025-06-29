<?php

/**
 * Summary of getAreasModel
 * @param (null) $userId retrieves all posted spots ever
 * @param int $userId retrives specific spots
 * @return string on failure
 * @return array on success
 {
  "1": { //? user
    "10": { //? coord
      "tags": [
        {
          "id": 1,
          "name": "Garbage",
          "color": "#ff0000"
        },
        {
          "id": 2,
          "name": "Smell",
          "color": "#00ff00"
        }
      ],
      "lat": 47.12,
      "lon": 27.58,
      "address": "Some Street, Some City"
    }
  }
 }
 */
function getAreasModel(int|null $userId): array|string
{
  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - getAreasModel(): " . $db->connect_error;
  }

  $sql = "SELECT *
    FROM RecyclingArea
    JOIN Tag ON RecyclingArea.idTag = Tag.id
    JOIN Coordinate ON RecyclingArea.idCoordinate = Coordinate.id
      GROUP BY idUser, idCoordinate, idTag;";
  if (!is_null($userId)) {
    $sql .= " HAVING idUser = ?";
  }

  $stmt = $db->prepare($sql);
  if (!$stmt) {
    return "error - getAreasModel(): failed to prepare SQL statement";
  }

  if (
    !is_null($userId) &&
    !$stmt->bind_param("i", $userId)
  ) {
    $stmt->close();
    return "error - getAreasModel(): failed to prepare SQL statement";
  }

  if (!$stmt->execute()) {
    $stmt->close();
    return "error - getAreasModel(): failed to execute SQL statement";
  }

  $res = $stmt->get_result();
  $stmt->close();
  if (!$res) {
    return "error - getAreasModel(): failed to retrieve posts";
  }

  $posts = []; // three dimensional
  while ($row = $res->fetch_assoc()) {
    if (false === $row) {
      return "error - getAreasModel(): failed to fetch posts";
    }

    $human = $row["idUser"];
    $coord = $row["idCoordinate"];

    $tag = [];
    $tag["id"] = $row["idTag"]; 
    $tag["name"] = $row["name"]; 
    $tag["color"] = $row["color"]; 
    
    $posts[$human][$coord]["tag"] = $tag;
    $posts[$human][$coord]["lat"] = $row["lat"];
    $posts[$human][$coord]["lon"] = $row["lng"];
    $posts[$human][$coord]["address"] = $row["address"];
  }

  return $posts;
}
