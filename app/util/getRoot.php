<?php
function getRoot(): string
{
  $path = __DIR__;
  $file = strtok($path, "/");
  $path = "";

  while ($file && $file !== "app") {
    $path .= "$file/";
    $file = strtok("/");
  }

  $path .= "app/";
  return $path;
}
