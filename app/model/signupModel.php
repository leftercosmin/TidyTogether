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
  strlen($passw) < 4 ||
  $passw != $pasAg
) {
  exit("error: invalid password");
}

$db = new mysqli(
  getenv('DB_HOST'),
  getenv('DB_USERNAME'),
  getenv('DB_PASSWORD'),
  getenv('DB_NAME'),
  getenv('DB_PORT'),
);

if ($db->connect_error) {
  $db->close();
  exit("error: " . $db->connect_error);
}

$statement =
  $db->prepare(
    'SELECT email FROM User WHERE email=?'
  );
if (!$statement) {
  $db->close();
  exit("error: failed to prepare SELECT statement");
}

if (!$statement->bind_param('s', $email)) {
  $statement->close();
  $db->close();
  exit("error: failed to bind SELECT parameters");
}

if (!$statement->execute()) {
  $statement->close();
  $db->close();
  exit("error: failed to execute SELECT");
}

$result = $statement->get_result();
if (!$result) {
  $statement->close();
  $db->close();
  exit("error: failed to fetch result");
}

// not unique
if ($result->num_rows > 0) {
  $statement->close();
  $db->close();
  exit("error: email already registered");
}

// todo assign role

$passw = password_hash($passw, PASSWORD_DEFAULT);
if (!$passw) {
  $db->close();
  exit("error: failed to hash password");
}

// transaction
if (!$db->begin_transaction()) {
  exit("error: failed to begin transaction");
}

$statement =
  $db->prepare(
    'INSERT INTO
    User (email, password, fname, lname, role)
    VALUES (?, ?, ?, ?, ?)'
  );
if (!$statement) {
  $db->rollback();
  $db->close();
  exit("error: failed to prepare INSERT statement");
}

$role = 'civilian'; // todo automate this
$test = $statement->bind_param(
  'sssss',
  $email,
  $passw,
  $fname,
  $lname,
  $role
);

if (!$test) {
  exit("error: failed to bind to INSERT statement");
}

if (!$statement->execute()) {
  exit("error: failed to execute INSERT statement");
}

if (!$db->commit()) {
  exit("error: failed to commit");
}

if (!$statement->close()) {
  exit("error: failed to close the statement");
}

if (!$db->close()) {
  exit("error: failed to close the database");
}

unset($_POST);
$_POST[PAGE] = "Login";
