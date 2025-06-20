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
  mysqli $db,
  array $media,
  int $idPost,
): string {

  foreach ($media as $file) {
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

    $resultPost = $statement->get_result();
    $statement->close();
  }

  return ""; // success
}
