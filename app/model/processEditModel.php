<?php

require_once "model/helper/processFnameModel.php";
require_once "model/helper/processLnameModel.php";
require_once "model/helper/processCityModel.php";

function processEditModel(
  int $id,
  string|null $fname,
  string|null $lname,
  string|null $city
): string {

  if (!is_null($fname)) {
    processFnameModel($fname, $id);
  }

  if (!is_null($lname)) {
    processLnameModel($lname, $id);
  }

  if (!is_null($city)) {
    processCityModel($city, $id);
  }

  return ""; // success
}
