<?php

// todo
function processTagsModel(): void
{
  $tags = $_POST["postTag"] ?? [];
  if (is_array($tags)) {
    $tags = implode(',', $tags);
  }

  // return $tags;
}
