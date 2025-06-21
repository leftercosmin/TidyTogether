<?php

$statusModel = "";

/**
 * displays the previous error
 * prepares statusModel for the last call in index.php
 */
function isError(mixed $returnedValue): bool
{
  global $statusModel;
  if (is_string($statusModel) && "" !== $statusModel) {
    alert($statusModel);
    $statusModel = "";
  }

  if (is_string($returnedValue)) {
    $statusModel = $returnedValue;
    return true;
  }

  return false;
}
