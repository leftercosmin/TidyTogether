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
  $db = new mysqli(
    getenv('DB_HOST'),
    getenv('DB_USERNAME'),
    getenv('DB_PASSWORD'),
    getenv('DB_NAME'),
    getenv('DB_PORT'),
  );

  if ($db->connect_error) {
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
  $db->close();

  if (!$result) {
    exit("error: failed to retrieve posts");
  }

  $posts = [];
  while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
  }

  return $posts;
}
