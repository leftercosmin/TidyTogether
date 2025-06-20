<?php

function getFormat(string $path): string
{
  $temp = strtok($path, ".");
  while ($temp) {
    $format = $temp;
    $temp = strtok(".");
  }

  return $format;
}
