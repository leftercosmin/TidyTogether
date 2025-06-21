<?php

/**
 * dangerous function! directly access $_POST and unset()
 * @return array<{name, color}>
 */
function processTagsModel(): array
{
  $marks = [];
  for ($i = 0; $i < 10; $i++) {
    if (!isset($_POST["postTag$i"])) {
      continue;
    }

    $tag = [];
    $tag["id"] = strtok($_POST["postTag$i"], "-");
    $tag["name"] = strtok("-");
    $tag["color"] = strtok("-");
    $marks[] = $tag;

    unset($_POST["postTag$i"]);
  }

  return $marks;
}
