<?php // prints error status

define("CONN", "userSession");


// do not access this page manually
if (isset($_SESSION[CONN])) {
  header("Location: ../index.php");
  exit();
}

// base cases
if (!isset($_POST["email"]) || !isset($_POST["password"])) {
  exit("error: can not signup missing credentials");
}

$fname = $_POST["firstname"];
$lname = $_POST["lastname"];
$email = $_POST["email"];
$passw = $_POST["password"];
$pasAg = $_POST["passwordAgain"];

// basic input validation
if (is_null($email) || strlen($email) < 2) {
  exit("error: can not signup invalid credentials");
}

if (
  is_null($passw) ||
  strlen($passw) < 5 ||
  $passw != $pasAg
) {
  exit("error: passwords do not match");
}

$db = new mysqli(
  $_ENV['DB_HOSTNAME'],
  $_ENV['DB_USERNAME'],
  $_ENV['DB_HOSTNAME'],
  $_ENV['DB_DATABASE']
);

if ($db->connect_error) {
  $db->close();
  exit("error: " . $db->connect_error);
}

$statement =
  $db->prepare(
    'SELECT email FROM User WHERE email=?'
  );
$statement->bind_param('s', $email);
$statement->execute();
$result = $statement->get_result();

// not unique
if ($result->num_rows > 0) {
  $statement->close();
  $db->close();
  exit("error: email already registered");
}

// todo assign role

$passw = password_hash($passw, PASSWORD_DEFAULT);
$db->begin_transaction();
$statement =
  $db->prepare(
    'INSERT INTO
    User (email, password, fname, lname, role)
    VALUES (?, ?, ?, ?, ?)'
  );
$statement->bind_param(
  'ssss',
  $fname,
  $lname,
  $email,
  $passw,
  "civilian" // todo automate this
);
$statement->execute();
$db->commit();

$statement->close();
$db->close();

// todo big error
unset($_POST["email"]);
$_POST[PAGE] = "Login";
include_once "controller/homeController.php";
exit();
