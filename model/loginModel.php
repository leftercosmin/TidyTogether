<?php // prints user type

define("USER_CIVL", 0);
define("USER_SPRV", 1);
define("USER_AUTH", 2);

define("CONN", "userSession");


// do not access this page manually
if (isset($_SESSION[CONN])) {
  header("Location: ../index.php");
  exit();
}

// base cases
if (!isset($_POST["email"]) || !isset($_POST["password"])) {
  exit("error: can not log missing credentials");
}

$email = $_POST["email"];
$passw = password_hash($_POST["password"], PASSWORD_DEFAULT);

// database
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

$result =
  $db->prepare(
    'SELECT email, password, role FROM User WHERE email=?'
  );
$result->bind_param('s', $email);
$result->execute();
$result = $result->get_result();

if (!$result || 0 == $result->num_rows) {
  $result->close();
  $db->close();
  exit("error: can not log invalid credentials");
}

$row = $result->fetch_assoc();
if (!password_verify($passw, $row['password'])) {
  exit("error: can not log invalid credentials");
}

// todo set coockie/session conn role
// todo set role

$result->close();
$db->close();

// todo send to dashboard/reload/ create post http
