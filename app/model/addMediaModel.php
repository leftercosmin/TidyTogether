<?php

/*  intput looks like this: $media = [
      [
        "name" => "example.jpg",
        "size" => 12345,
        "source" => "public/uploads/1_123456789_example.jpg",
        "format" => "jpg"
      ],
      ...
    ];
*/
function addMediaModel(
  array $media,
  int $idPost,
): string {

  $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - addPostModel(): " . $db->connect_error;
  }

  foreach ($media as $file) {
    echo "executat\n";

    $statement =
      $db->prepare(
        'INSERT INTO Media (name, size, source, format, idPost)
      VALUES (?, ?, ?, ?, ?)'
      );
    if (!$statement) {
      return "error - addMediaModel(): failed to prepare SQL statement";
    }

    if (
      !$statement->bind_param(
        'ssssi',
        $file["name"],
        $file["size"],
        $file["source"],
        $file["format"],
        $idPost
      )
    ) {
      $statement->close();
      return "error - addMediaModel(): failed to bind parameters";
    }

    if (!$statement->execute()) {
      $statement->close();
      return "error - addMediaModel(): failed to execute SQL statement";
    }

    $statement->close();
  }

  return ""; // success
}
