<?php

/**
 * dangerous function! directly access $_POST and unset()
 * return never empty tag array!
 * 
 */
function processTagsAreaModel(): array
{
  $marks = [];
  for ($i = 0; $i < 10; $i++) {
    if (!isset($_POST["recyclingType$i"])) {
      continue;
    }

    $tag = [];
    $tag["id"] = strtok($_POST["recyclingType$i"], "-");
    $tag["name"] = strtok("-");
    $tag["color"] = strtok("-");
    $marks[] = $tag;

    unset($_POST["recyclingType$i"]);
  }

  if (count($marks) > 0)
    return $marks;

  // edge case
  $tag = [];
  $tag["id"] = 1;
  $tag["name"] = "organic";
  $tag["color"] = "green";
  $marks[] = $tag;
  return $marks;
}
