<?php

/** use this instead of util/writeConsole.php
 * @param string $data
 * @return bool
 */
function alert(string $data): bool
{
  if (!isset($data) || null == $data)
    return false;
  $output = $data;
  if (is_array($output))
    $output = implode(',', $output);
  $output = "\"" . $output . "\"";

  echo "<script>alert($output);</script>";
  sleep(2);
  return true;
}
