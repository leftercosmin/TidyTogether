<?php

function printFiles(string $dir): string
{
  $ffs = scandir($dir);

  unset($ffs[array_search('.', $ffs, true)]);
  unset($ffs[array_search('..', $ffs, true)]);

  if (count($ffs) < 1)
    return "no files found";

  foreach ($ffs as $ff) {
    echo $ff . "\n";
    // if (is_dir($dir . '/' . $ff)) {
    //  listFolderFiles($dir . '/' . $ff);
    // }
  }

  return ""; // success
}
