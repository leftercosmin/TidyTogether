<?php

/**
 * replace $files with $files
 * @param int $idUser
 * @param array $files
 * @return array<array>|null|string
 * @return string on error
 */
function processMediaModel(int $idUser, array|null $files): array|null|string
{
  // 4 means no files here uploaded
  if (is_null($files) || 4 === $files["error"][0]) {
    return null;
  }

  $media = [];

  $isWindows = substr(__DIR__, 0, 1) !== "/";
  $separator = $isWindows ? "\\" : "/";
  $uploadDir = getRoot() . "public$separator" . "uploads$separator";

  if (!is_writable($uploadDir)) {
    return "error - processMediaModel(): directory not writable.";
  }

  // for each file sent by the user
  // save it to local system (server)
  foreach ($files["tmp_name"] as $index => $oldPath) {

    if (!is_uploaded_file($oldPath)) {
      alert("warning - processMediaModel(): $oldPath ignored");
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
      alert("warning - processMediaModel(): file ignored - failed to move");
      continue;
    }

    $format = getFormat($newPath);
    if (!in_array($format, ["jpg", "png", "mp4", "webm"])) {
      alert("warning - processMediaModel(): file ignored - wrong format");
      continue;
    }

    $file = [];
    $file["name"] = $name;
    $file["size"] = $size;
    $file["source"] = $newPath;
    $file["format"] = $format;
    $media[] = $file;
  }

  exec("ls public/uploads", $os);

  $size = count($os);
  for ($i = 0; $i < $size; $i++) {
    alert($os[$i] . "\n");
  }

  return $media;
}
