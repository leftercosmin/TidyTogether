<?php


/* a valid parameter could be the following
 * /opt/lampp/htdocs/TidyTogether/app/public/uploads/1_1750846665_scara.png 
 * should return "public/uploads/1_1750846665_scara.png"
 */
function getSourcePhoto(string $path): string
{
  $partition = substr(__DIR__, 0, 3);
  $isWindows = substr($partition, 0, 1) !== "/";
  $token = $isWindows ? "\\" : "/";

  $file = strtok($path, $token);

  $path = "";
  while ($file && $file !== "app") {
    $file = strtok($token);
  }

  $file = strtok($token);
  for (; $file; $file = strtok($token)) {
    $path .= "$file$token";
  }

  $count = strlen($path);
  return substr($path, 0, $count - 1);
}

echo getSourcePhoto("/opt/lampp/htdocs/TidyTogether/app/public/uploads/1_1750846665_scara.png");
