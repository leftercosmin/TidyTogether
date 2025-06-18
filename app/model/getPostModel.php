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
 */
function getPost(int $id): array
{
  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    exit("error: " . $db->connect_error);
  }

  $statement =
    $db->prepare(
      'SELECT * FROM Post WHERE idUser=?'
    );
  $statement->bind_param('i', $id);
  $statement->execute();
  $result = $statement->get_result();
  $statement->close();

  if (!$result) {
    exit("error: failed to retrieve posts");
  }

  $posts = [];
  while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
  }

  return $posts;
}
