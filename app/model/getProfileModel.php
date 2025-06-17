<?php

/* returns a Profile instance consisting of:
    id        BIGINT,
    email     VARCHAR,
    password  VARCHAR,
    fname     VARCHAR,
    lname     VARCHAR,
    role      ENUM,
    createdAt DATETIME,
    updatedAt DATETIME
 */
function getProfile(int $id): array
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
      'SELECT * FROM User WHERE id=?'
    );
  $statement->bind_param('i', $id);
  $statement->execute();
  $result = $statement->get_result();
  $statement->close();
  $db->close();

  if (!$result || 1 !== $result->num_rows) {
    exit("error: failed to retrieve profile");
  }

  return $result->fetch_assoc();
}
