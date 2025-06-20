<?php

/* returns an array of Post instances
 * each instance has the following fields:
    id          BIGINT,
    description VARCHAR,
    status      ENUM,
    idUser      BIGINT,
    idZone      BIGINT,
    address     VARCHAR,
    createdAt   DATETIME,
    updatedAt
  * returns string on failure
 */
function getPostModel(int $id): array|string
{
  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - getPostModel(): " . $db->connect_error;
  }

  $statement =
    $db->prepare('SELECT * FROM Post WHERE idUser=?');
  if (!$statement) {
    return "error - getPostModel(): failed to prepare SQL statement";
  }

  if (!$statement->bind_param('i', $id)) {
    $statement->close();
    return "error - getPostModel(): failed to prepare SQL statement";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - getPostModel(): failed to execute SQL statement";
  }

  $result = $statement->get_result();
  $statement->close();

  if (!$result) {
    return "error - getPostModel(): failed to retrieve posts";
  }

  $posts = [];
  while ($row = $result->fetch_assoc()) {
    if (false === $row) {
      return "error - getPostModel(): failed to fetch posts";
    }

    $posts[] = $row;
  }

  return $posts;
}
