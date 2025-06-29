<?php

$wasErrorThrown = false;

/**
 * displays the previous error
 * prepares statusModel for the last call in index.php
 */
function isError(mixed $returnedValue): bool
{
  global $wasErrorThrown;
  if (!is_null($returnedValue) && is_string($returnedValue)) {

    if (!str_starts_with($returnedValue, "error")) {
      return false;
    }

    alert($returnedValue);
    $wasErrorThrown = true;
    return true;
  }

  return false;
}
