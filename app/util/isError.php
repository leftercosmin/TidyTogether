<?php

$statusModel = "";

/**
 * displays the previous error
 * prepares statusModel for the last call in index.php
 * @param mixed $returnedValue
 * @return void
 */
function isError(mixed $returnedValue): void
{
  global $statusModel;
  if (is_string($statusModel) && "" !== $statusModel) {
    alert($statusModel);
    $statusModel = "";
  }

  if (is_string($returnedValue)){
    $statusModel = $returnedValue;
  }
}
