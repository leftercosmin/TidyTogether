<?php

/**
 * replace $files with $files
 * @param int $idUser
 * @param array $files
 * @return array<array>|null
 */
function processMediaModel(int $idUser, array|null $files): array|null
{
  if (is_null($files) || empty($files)) {
    return null;
  }

  $media = [];
  $uploadDir = getRoot() . 'public/uploads/';

  // for each file sent by the user
  foreach ($files["tmp_name"] as $index => $oldPath) {

    // save it to local system (server)
    if (!is_uploaded_file($oldPath)) {
      alert("warning: not a valid uploaded file: $oldPath");
      continue;
    }

    if (!is_writable($uploadDir)) {
      alert("warning: upload directory is not writable.");
      continue;
    }

    $name = $files['name'][$index];
    $size = $files['size'][$index];
    $newPath = $uploadDir
      . $idUser . "_"
      . time() . "_"
      . basename($name);

    // change the path
    if (!move_uploaded_file($oldPath, $newPath)) {
      alert("error: file uploading");
      continue;
    }

    writeConsole($oldPath);
    writeConsole($newPath);
    $file = [];
    $file["name"] = $name;
    $file["size"] = $size;
    $file["source"] = $newPath;
    $file["format"] = getFormat($newPath);
    $media[] = $file;
  }

  return $media;
}
