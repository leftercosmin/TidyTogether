<?php

/** see util/alert.php
 * @deprecated the wasmer console does not respond to this call
 * @param string $data
 * @return bool
 */
function writeConsole(string $data): bool
{
  if (!isset($data) || null == $data)
    return false;
  $output = $data;
  if (is_array($output))
    $output = implode(',', $output);
  $output = "\"" . $output . "\"";

  echo "<script>console.log($output);</script>";
  return true;
}
