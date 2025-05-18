<?php

define("USERS_CIVIL", 0);
define("USERS_SUPRV", 1);
define("USERS_AUTHR", 1);

// returns the User Type
function loginUser(): int
{
}

define("REGISTRATION_SUCCS", 0);
define("REGISTRATION_FAILR", 1);
define("REGISTRATION_FAILR_DATAB", 2);
define("REGISTRATION_FAILR_EMAIL", 3);
define("REGISTRATION_FAILR_PASSW", 4);

function registerUser(): int
{
  // base cases
  if (!isset($_POST["email"])) {
    return REGISTRATION_FAILR;
  }

  if (!isset($_POST["password"])) {
    return REGISTRATION_FAILR;
  }

  $fname = $_POST["firstname"];
  $lname = $_POST["lastname"];
  $email = $_POST["email"];
  $passw = $_POST["password"];
  $pasAg = $_POST["passwordAgain"];

  // basic input validation
  if (is_null($email) || strlen($email) < 2) {
    return REGISTRATION_FAILR_EMAIL;
  }

  if (
    is_null($passw) ||
    strlen($passw) < 5 ||
    $passw != $pasAg
  ) {
    return REGISTRATION_FAILR_PASSW;
  }

  $db = new mysqli(
    $_ENV['DB_HOSTNAME'],
    $_ENV['DB_USERNAME'],
    $_ENV['DB_HOSTNAME'],
    $_ENV['DB_DATABASE']
  );

  if ($db->connect_error) {
    return REGISTRATION_FAILR_DATAB;
  }

  $db->prepare('SELECT email FROM User WHERE email=?');
  $db->bind_param('', $email);
  $db->execute();
  $result = $db->get_result();

  // not unique
  if ($result->num_rows > 0) {
    $db->close();
    return REGISTRATION_FAILR_EMAIL;
  }

  $db->begin_transaction();
  $db->prepare('INSERT INTO User (email, password, fname, lname) VALUES (?, ?, ?, ?)');
  $db->bind_param('', $fname, $lname, $email, $passw);
  $db->execute();
  $db->commit();

  $db->close();
  return REGISTRATION_SUCCS;
}
