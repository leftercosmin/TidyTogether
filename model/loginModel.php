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

$statement =
  $db->prepare(
    'SELECT email, password, role FROM User WHERE email=?'
  );
$statement->bind_param('s', $email);
$statement->execute();
$result = $statement->get_result();
$statement->close();
$db->close();

if (!$result || 0 == $result->num_rows) {
  exit("error: can not log invalid credentials");
}

$row = $result->fetch_assoc();
if (!password_verify($passw, $row['password'])) {
  exit("error: can not log invalid credentials");
}

// session
$token = json_encode(
  ['email' => $email, 'username' => $row['role']]
);
session_start([
  'cookie_lifetime' => 10,
  'cookie_path' => '/',
  'cookie_secure' => isset($_SERVER['HTTPS']),
  'cookie_httponly' => true
]);
$_SESSION[CONN] = $token;
$_SESSION['lastLogin'] = time();

include_once "controller/homeController.php";
exit();
