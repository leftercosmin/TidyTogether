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
    alert($returnedValue);
    $wasErrorThrown = true;
    return true;
  }

  return false;
}
