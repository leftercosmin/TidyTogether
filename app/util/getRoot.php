<?php

function getRoot(): string
{
  $partition = substr(__DIR__, 0, 3);
  $isWindows = substr($partition, 0, 1) !== "/";
  $token = $isWindows ? "\\" : "/";

  $path = __DIR__;
  $file = strtok($path, $token);

  // assign the root directory
  $path = $isWindows ? "" : "/";

  while ($file && $file !== "app") {
    $path .= "$file$token";
    $file = strtok($token);
  }

  $path .= "app$token";
  return $path;
}
